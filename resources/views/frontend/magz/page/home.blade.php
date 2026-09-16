@extends('frontend.magz.index')

@inject('themeHelper', 'App\Helpers\ThemeHelper')

@section('content')
<section class="home top">
    <div class="container-md">
        <div class="row">
            @if($sidebarPosition === "left" AND $sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
            <div class="col-lg-9 col-md-12 col-sm-12 col">
                @php $renderedIndex = 0; @endphp
                <div class="jtv-home-stream">
                @foreach($body as $widgetName => $widgetData)
                    @if($widgetName != 'bottom_post')
                        @if (Arr::first(Str::of($widgetName)->explode('-')) == 'section')
                            @if ($widgetData['active'] == 'true')
                            @php $renderedIndex++; @endphp
                            <div class="jtv-widget-block jtv-widget-section @if($renderedIndex === 1) jtv-widget-lead @endif">
                                <x-dynamic-component :component="$themeHelper->getComponentName($widgetName)" page="home" layout="body" :widgetName="$widgetName" :widgetData="$widgetData['widget']" :localeId="$localeId"/>
                            </div>
                            @endif
                        @else
                            @if ($widgetData['active'] == 'true')
                            @php $renderedIndex++; @endphp
                            <div class="jtv-widget-block @if($renderedIndex === 1) jtv-widget-lead @endif">
                                <x-dynamic-component :component="$themeHelper->getComponentName($widgetName)" page="home" layout="body" :widgetName="$widgetName" :widgetData="$widgetData" :localeId="$localeId"/>
                            </div>
                            @endif
                        @endif
                    @endif
                @endforeach
                </div>
            </div>
            @if($sidebarPosition === "right" AND $sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
        </div>
    </div>
</section>

@if($bottomPostActive)
    <x-bottom-post :widgetData="$bottomPost" :localeId="$localeId"/>
@endif

@endsection

@push('scripts')
    <script>
        let $target_end=$(".best-of-the-week");
    </script>
@endpush
