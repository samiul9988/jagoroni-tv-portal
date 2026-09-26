<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Sends contact-form messages (and the admin "test email") through the SMTP account
 * saved under Admin → Contact Settings, independent of the site-wide .env mailer.
 */
class ContactMailService
{
    public function isConfigured(): bool
    {
        return filled(config('settings.mail_host')) && filled(config('settings.mail_port')) && filled($this->recipient());
    }

    public function recipient(): ?string
    {
        return config('settings.contact_mail_to') ?: config('settings.site_email');
    }

    public function password(): ?string
    {
        $stored = config('settings.mail_password');
        if (!$stored) {
            return null;
        }

        try {
            return Crypt::decryptString($stored);
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function useSmtp(): void
    {
        $encryption = config('settings.mail_encryption');

        config([
            'mail.mailers.contact_smtp' => [
                'transport' => 'smtp',
                'host' => config('settings.mail_host'),
                'port' => (int) config('settings.mail_port'),
                'encryption' => in_array($encryption, ['tls', 'ssl'], true) ? $encryption : null,
                'username' => config('settings.mail_username') ?: null,
                'password' => $this->password(),
                'timeout' => 15,
            ],
        ]);
    }

    private function from(): array
    {
        $address = config('settings.mail_from_address') ?: config('settings.mail_username') ?: $this->recipient();

        return [$address, config('settings.mail_from_name') ?: config('settings.site_name')];
    }

    /** Mail a submitted contact message to the site owner. Returns false (and logs) on failure. */
    public function sendContact(Contact $contact): bool
    {
        if (!$this->isConfigured()) {
            return false;
        }

        $this->useSmtp();
        [$fromAddress, $fromName] = $this->from();
        $lines = [
            'Name: ' . $contact->name,
            'Email: ' . $contact->email,
            'Phone: ' . ($contact->phone ?: '-'),
            'Subject: ' . ($contact->subject ?: '-'),
            '',
            $contact->message,
        ];

        try {
            Mail::mailer('contact_smtp')->raw(implode("\n", $lines), function ($message) use ($contact, $fromAddress, $fromName) {
                $message->to($this->recipient())
                    ->from($fromAddress, $fromName)
                    ->replyTo($contact->email, $contact->name)
                    ->subject('[' . config('settings.site_name') . '] ' . ($contact->subject ?: 'New contact message'));
            });

            return true;
        } catch (\Throwable $e) {
            Log::warning('Contact mail failed: ' . $e->getMessage());

            return false;
        }
    }

    /** Sends a test message; returns null on success or the error text. */
    public function sendTest(string $to): ?string
    {
        if (blank(config('settings.mail_host')) || blank(config('settings.mail_port'))) {
            return 'SMTP host and port are not saved yet.';
        }

        $this->useSmtp();
        [$fromAddress, $fromName] = $this->from();

        try {
            Mail::mailer('contact_smtp')->raw('This is a test email from your website contact settings. If you can read it, SMTP works.', function ($message) use ($to, $fromAddress, $fromName) {
                $message->to($to)->from($fromAddress, $fromName)->subject('SMTP test - ' . config('settings.site_name'));
            });

            return null;
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
}
