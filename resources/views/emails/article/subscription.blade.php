<x-mail::message>
# {{ $title }}

@if($img)
![{{ $img }}]({{ asset('storage/images/' . $img) }})
@endif

{!! $content !!}

<x-mail::button :url="$url">
{{ $button_article_subscribe }}
</x-mail::button>

---

{!! $closing_article_subscribe !!}.
</x-mail::message>
