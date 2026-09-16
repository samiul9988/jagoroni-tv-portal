<div class="col-xl-12">
    @if ($active)
        @empty(env('NOCAPTCHA_SITEKEY'))
            <p class="text-danger"><i>{{ __('jagoronitv::magz.your_captcha_is_not_yet_configured') }}</i></p>
        @else
            {!! NoCaptcha::display() !!}
        @endempty
    @endif
</div>
<div class="col-xl-12" style="margin-top:10px">
    @if ($active)
        @empty(env('NOCAPTCHA_SITEKEY'))
            <button type="button" class="btn btn-primary" disabled>{{ __('jagoronitv::magz.contact_button') }}</button>
        @else
            <button type="submit" class="btn btn-primary">{{ __('jagoronitv::magz.contact_button') }}</button>
        @endempty
    @else
        <button type="submit" class="btn btn-primary">{{ __('jagoronitv::magz.contact_button') }}</button>
    @endif
</div>
