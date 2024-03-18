<aside>
    <div class="aside-body">
        <form class="newsletter">
            <div class="icon">
                <!-- <i class="ion-ios-email-outline"></i> -->
                <svg id="newsletter" width="100px" viewBox="0 0 70.5 47">
                <path d="M0,0v47h70.5V0H0z M35.3,25.7L5.4,2.9h59.8L35.3,25.7z M2.9,44.1V4.8l21.1,16.1L11.6,35.1l0.4,0.4l14.5-12.8l8.8,6.7
                    l8.8-6.7l14.5,12.8l0.4-0.4L46.4,20.9L67.6,4.8v39.3H2.9z"/>
                </svg>
            </div>
            @if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
            <div class="title text-center">{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</div>
            @else
            <div class="title text-center">{{ __('dhakawatch::magz.newsletter') }}</div>
            @endif
            <div class="input-group">
                <input type="email" name="email" class="form-control email" placeholder="{{ __('dhakawatch::magz.your_mail') }}">
                <div class="input-group-btn">
                    <button class="btn btn-primary" aria-label="email-submit"><i class="fa-regular fa-paper-plane"></i></button>
                </div>
            </div>
            @if($widgetData['description'] && Arr::exists($widgetData['description'], LaravelLocalization::getCurrentLocale()))
            <p>{{ $widgetData['description'][LaravelLocalization::getCurrentLocale()] }}</p>
            @else 
            <p>{{ __('dhakawatch::magz.newsletter_description') }}</p>
            @endif
        </form>
    </div>
</aside>
