<x-mail::message>
# {{ $title_mail_subscription }}

<x-mail::button :url="$url">
{{ $button_subscribe }}
</x-mail::button>

{{ $body_subscribe }}

{{ $closing }},<br>
{{ config('settings.site_name') }}
</x-mail::message>
