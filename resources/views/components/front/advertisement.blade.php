@if($advertisements->isNotEmpty())
    <div class="jtv-managed-ads jtv-managed-ads-{{ $position }}" aria-label="Advertisement">
        @foreach($advertisements as $advertisement)
            @php
                $style = collect([
                    $advertisement->width ? 'width:' . $advertisement->width . 'px' : null,
                    $advertisement->height ? 'height:' . $advertisement->height . 'px' : null,
                ])->filter()->implode(';');
            @endphp
            <div class="jtv-managed-ad" data-ad-position="{{ $position }}" @if($style) style="{{ $style }}" @endif>
                @if($advertisement->type === 'image' && $advertisement->image)
                    @if($advertisement->url)
                        <a href="{{ $advertisement->url }}" target="{{ $advertisement->target }}" @if($advertisement->target === '_blank') rel="noopener sponsored" @endif>
                    @endif
                    <img src="{{ asset('storage/' . $advertisement->image) }}" alt="{{ $advertisement->name }}" loading="lazy">
                    @if($advertisement->url)</a>@endif
                @elseif($advertisement->type === 'html')
                    {!! $advertisement->html !!}
                @endif
            </div>
        @endforeach
    </div>
@endif
