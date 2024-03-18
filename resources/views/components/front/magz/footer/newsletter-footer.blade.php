@if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
<h1 class="block-title">{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</h1>
@endif
<div class="block-body">
     @if($widgetData['description'] && Arr::exists($widgetData['description'], LaravelLocalization::getCurrentLocale()))
     <p>{{ $widgetData['description'][LaravelLocalization::getCurrentLocale()] }}</p>
     @endif
    <form class="newsletter">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-envelope"></i></span>
            <input type="email" name="email" class="form-control email" placeholder="{{ __('dhakawatch::magz.your_mail') }}" aria-label="email" aria-describedby="basic-addon1">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary white">{{ __('dhakawatch::magz.subscribe') }}</button>
        </div>
    </form>
</div>
