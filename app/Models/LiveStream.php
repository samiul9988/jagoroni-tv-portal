<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveStream extends Model
{
    protected $fillable = [
        'title', 'stream_type', 'stream_url', 'embed_code', 'poster', 'viewers_label',
        'youtube_url', 'facebook_url', 'website_url', 'cta_title', 'cta_text', 'is_live',
    ];

    protected $casts = ['is_live' => 'boolean'];

    public const TYPES = [
        'youtube' => 'YouTube (live or video link)',
        'facebook' => 'Facebook video / live link',
        'hls' => 'HLS stream (.m3u8)',
        'mp4' => 'Direct video file (.mp4)',
        'embed' => 'Custom embed code (iframe)',
    ];

    /** The single settings row used by the public live page. */
    public static function current(): self
    {
        return static::first() ?? new static(['is_live' => false]);
    }

    public function getPosterUrlAttribute(): ?string
    {
        return $this->poster ? asset('storage/' . $this->poster) : null;
    }

    /** Embeddable iframe URL for YouTube / Facebook links, or null. */
    public function getIframeUrlAttribute(): ?string
    {
        $url = trim((string) $this->stream_url);
        if ($url === '') {
            return null;
        }

        if ($this->stream_type === 'youtube') {
            if (preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?(?:.*&)?v=|embed/|live/|shorts/))([\w-]{11})~', $url, $m)) {
                return 'https://www.youtube.com/embed/' . $m[1] . '?autoplay=1&mute=1&rel=0';
            }
            return null;
        }

        if ($this->stream_type === 'facebook') {
            return 'https://www.facebook.com/plugins/video.php?href=' . urlencode($url) . '&show_text=false&autoplay=true&mute=1';
        }

        return null;
    }
}
