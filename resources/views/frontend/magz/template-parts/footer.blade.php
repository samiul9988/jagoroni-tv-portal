@inject('themeHelper', 'App\Helpers\ThemeHelper')

<div class="container-md">
    @if($footerActive)
    <div class="row">
        @foreach($footer as $index => $column)
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                @foreach($column as $widgetName => $widgetData)
                    @if ($widgetData['active'] == 'true')
                    <div class="block mb-5">
                        <x-dynamic-component :component="$themeHelper->getComponentName($widgetName)" :page="$page" layout="footer" :column="$column" :widgetName="$widgetName" :widgetData="$widgetData" :localeId="$localeId"/>
                    </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="copyright border-top-0 mt-0">
                @include('frontend.magz.inc._credit-footer')
            </div>
        </div>
    </div>
</div>
