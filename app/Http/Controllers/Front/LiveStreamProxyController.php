<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\LiveStream;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

/**
 * Proxies the admin-configured HLS stream through our own HTTPS domain.
 *
 * The stream server (mediamtx at an http:// IP) can't be played directly
 * from an https:// page — browsers block it as mixed content. There's no
 * TLS cert for a bare IP, so instead we fetch the playlist/segments here
 * server-side (no browser, no mixed-content rule) and re-serve them from
 * our own https:// origin, rewriting the playlist's internal links to stay
 * on the proxy.
 *
 * The origin also serves low-latency HLS (partial segments, blocking
 * reload). We deliberately strip those LL-HLS tags from the rewritten
 * playlist so hls.js falls back to plain polling — avoids holding PHP-FPM
 * workers open for the origin's long-poll reloads, at the cost of a couple
 * extra seconds of latency, which doesn't matter for a news stream.
 */
class LiveStreamProxyController extends Controller
{
    private const LL_HLS_TAG_PREFIXES = [
        '#EXT-X-PART-INF',
        '#EXT-X-SERVER-CONTROL',
        '#EXT-X-PART:',
        '#EXT-X-PRELOAD-HINT',
        '#EXT-X-SKIP',
    ];

    public function stream(Request $request, string $path = 'index.m3u8')
    {
        $origin = $this->originBase();
        if (!$origin) {
            abort(404);
        }

        $url = $origin.'/'.ltrim($path, '/');
        $query = $request->getQueryString();
        // Blocking-reload / delta-update params only make sense against the
        // real LL-HLS origin; we strip the LL-HLS tags on our side, so drop
        // them here too rather than making the origin hang waiting for a
        // part we'll never expose.
        if ($query) {
            parse_str($query, $params);
            unset($params['_HLS_msn'], $params['_HLS_part'], $params['_HLS_skip']);
            $query = http_build_query($params);
        }
        if ($query) {
            $url .= '?'.$query;
        }

        try {
            $upstream = Http::withOptions(['allow_redirects' => true])
                ->timeout(8)
                ->get($url);
        } catch (\Throwable $e) {
            abort(502);
        }

        if ($upstream->failed()) {
            abort($upstream->status() ?: 502);
        }

        $contentType = $upstream->header('Content-Type') ?: 'application/octet-stream';
        $isPlaylist = str_contains($contentType, 'mpegurl') || str_ends_with(strtolower($path), '.m3u8');

        $body = $isPlaylist ? $this->rewritePlaylist($upstream->body()) : $upstream->body();
        $outType = $isPlaylist ? 'application/vnd.apple.mpegurl' : $contentType;

        return response($body, 200)
            ->header('Content-Type', $outType)
            ->header('Cache-Control', 'no-cache')
            ->header('Access-Control-Allow-Origin', '*');
    }

    private function originBase(): ?string
    {
        $streamUrl = LiveStream::current()->stream_url;
        if (!$streamUrl) {
            return null;
        }

        // e.g. http://103.73.226.202:8888/stream/index.m3u8 -> http://103.73.226.202:8888/stream
        return rtrim(preg_replace('#/[^/]*$#', '', $streamUrl), '/');
    }

    private function rewritePlaylist(string $body): string
    {
        $lines = preg_split('/\r?\n/', $body);
        $out = [];

        foreach ($lines as $line) {
            if ($this->isLowLatencyTag($line)) {
                continue;
            }

            $line = preg_replace_callback('/URI="([^"]+)"/', function ($m) {
                return 'URI="'.$this->proxify($m[1]).'"';
            }, $line);

            if ($line !== '' && $line[0] !== '#') {
                $line = $this->proxify($line);
            }

            $out[] = $line;
        }

        return implode("\n", $out);
    }

    private function isLowLatencyTag(string $line): bool
    {
        foreach (self::LL_HLS_TAG_PREFIXES as $prefix) {
            if (str_starts_with($line, $prefix)) {
                return true;
            }
        }

        return false;
    }

    private function proxify(string $uri): string
    {
        if (preg_match('#^https?://#i', $uri)) {
            return $uri;
        }

        return route('live.stream.proxy', ['path' => ltrim(explode('?', $uri)[0], '/')])
            .(str_contains($uri, '?') ? '?'.explode('?', $uri, 2)[1] : '');
    }
}
