<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ContactMailService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class ContactSettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.contact-settings.edit', [
            'hasPassword' => filled(config('settings.mail_password')),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'site_phone' => ['nullable', 'string', 'max:60'],
            'site_email' => ['nullable', 'email', 'max:190'],
            'contact_hours' => ['nullable', 'string', 'max:120'],
            'street' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:120'],
            'state' => ['nullable', 'string', 'max:120'],
            'postal_code' => ['nullable', 'string', 'max:30'],
            'country' => ['nullable', 'string', 'max:120'],
            'contact_map_embed' => ['nullable', 'string', 'max:3000'],
            'contact_mail_to' => ['nullable', 'email', 'max:190'],
            'mail_host' => ['nullable', 'string', 'max:190'],
            'mail_port' => ['nullable', 'integer', 'min:1', 'max:65535'],
            'mail_encryption' => ['nullable', 'in:tls,ssl,none'],
            'mail_username' => ['nullable', 'string', 'max:190'],
            'mail_password' => ['nullable', 'string', 'max:190'],
            'mail_from_address' => ['nullable', 'email', 'max:190'],
            'mail_from_name' => ['nullable', 'string', 'max:190'],
        ]);

        $map = $this->normalizeMap((string) ($data['contact_map_embed'] ?? ''));
        if ($map === false) {
            return back()->withInput()->withErrors(['contact_map_embed' => 'Could not turn this into a map. Paste a Google Maps link (share / maps.app.goo.gl / full URL), the iframe embed code, or just the address.']);
        }
        $data['contact_map_embed'] = $map;

        $values = collect($data)->except('mail_password')->all();
        // Blank password = keep the saved one.
        if (filled($data['mail_password'] ?? null)) {
            $values['mail_password'] = Crypt::encryptString($data['mail_password']);
        }
        if ($request->boolean('clear_password')) {
            $values['mail_password'] = '';
        }

        foreach ($values as $key => $value) {
            // The settings table can hold the same key more than once (the site reads the LAST row),
            // so update every row of that key; new keys are created under the "contact" group.
            if (Setting::where('key', $key)->exists()) {
                Setting::where('key', $key)->update(['value' => (string) $value]);
            } else {
                Setting::create(['group' => 'contact', 'key' => $key, 'value' => (string) $value]);
            }
        }
        Cache::forget('settings');

        return redirect()->route('contact-settings.edit')->withSuccess('Contact settings saved.');
    }

    /**
     * Turns whatever the admin pasted into an embeddable map URL:
     * iframe code, an /maps/embed URL, a Google Maps / share.google / goo.gl short link, or a plain address.
     * Returns '' for empty input and false when nothing usable could be built.
     *
     * @return string|false
     */
    private function normalizeMap(string $input)
    {
        $input = trim($input);
        if ($input === '') {
            return '';
        }

        // Pasted <iframe src="…">.
        if (preg_match('/src\s*=\s*["\']([^"\']+)["\']/i', $input, $m)) {
            $input = html_entity_decode($m[1]);
        }

        // Already an embeddable address.
        if (preg_match('~^https://(www\.)?google\.[a-z.]+/maps/embed~i', $input) || preg_match('~[?&]output=embed~i', $input)) {
            return $input;
        }

        // Plain text (an address) instead of a link.
        if (!preg_match('~^https?://~i', $input)) {
            return $this->embedFromQuery($input);
        }

        $final = $this->followRedirects($input) ?: $input;
        $decoded = urldecode($final);

        // /maps/place/<Name>/@lat,lng,zoom
        if (preg_match('~/maps/place/([^/@?]+)/?@(-?\d+\.\d+),(-?\d+\.\d+)~', $decoded, $m)) {
            return $this->embedFromQuery($m[2] . ',' . $m[3] . '(' . str_replace('+', ' ', $m[1]) . ')');
        }
        // @lat,lng anywhere
        if (preg_match('~@(-?\d+\.\d+),(-?\d+\.\d+)~', $decoded, $m)) {
            return $this->embedFromQuery($m[1] . ',' . $m[2]);
        }
        // ?q=… or /maps/place/<Name> or /maps/search/<Name>
        if (preg_match('~[?&]q=([^&]+)~', $decoded, $m)) {
            return $this->embedFromQuery(str_replace('+', ' ', $m[1]));
        }
        if (preg_match('~/maps/(?:place|search)/([^/@?]+)~', $decoded, $m)) {
            return $this->embedFromQuery(str_replace('+', ' ', $m[1]));
        }

        return false;
    }

    private function embedFromQuery(string $query): string
    {
        return 'https://maps.google.com/maps?q=' . rawurlencode($query) . '&z=15&output=embed';
    }

    /** Follows short-link redirects (share.google, maps.app.goo.gl, goo.gl/maps) and returns the final URL. */
    private function followRedirects(string $url): ?string
    {
        try {
            $final = $url;
            $response = \Illuminate\Support\Facades\Http::timeout(10)
                ->withHeaders(['User-Agent' => 'Mozilla/5.0 (compatible; SiteMapResolver/1.0)'])
                ->withOptions([
                    'allow_redirects' => ['max' => 8, 'track_redirects' => true],
                    'on_stats' => function (\GuzzleHttp\TransferStats $stats) use (&$final) {
                        $final = (string) $stats->getEffectiveUri();
                    },
                ])
                ->get($url);

            // Some short links land on a page whose HTML holds the real maps URL.
            $body = $response->body();
            if (!preg_match('~/maps/|@-?\d+\.\d+,-?\d+\.\d+~', $final) && preg_match('~https://www\.google\.[a-z.]+/maps/[^"\'\s<\\\\]+~', $body, $m)) {
                $final = html_entity_decode($m[0]);
            }

            return $final;
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function test(Request $request, ContactMailService $mailer): RedirectResponse
    {
        $request->validate(['test_to' => ['required', 'email']]);

        $error = $mailer->sendTest($request->input('test_to'));

        return $error
            ? back()->with('error', 'Test email failed: ' . $error)
            : back()->withSuccess('Test email sent to ' . $request->input('test_to') . '. Check the inbox (and spam).');
    }
}
