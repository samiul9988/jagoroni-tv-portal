<x-mail::message>
{{ $opening_comment_subscibe }}

{{ __('mail.from') }}: {{ $responder->name }}

{{ __('mail.comment') }}:

{!! $responder->comment !!}

<x-mail::button :url="$comment_url">
{{ __('button.reply') }}
</x-mail::button>

---

{{ $note_comment_subscribe }}

<x-mail::button :url="$comment_unsubscribe_url">
{{ __('button.unsubscribe') }}
</x-mail::button>

</x-mail::message>
