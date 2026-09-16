@inject('themeHelper', 'App\Helpers\ThemeHelper')

<div class="row mt-5">
    @foreach($dataSection as $widgetName => $widgetData)
        <div class="col-lg-3 col-md-6 col-sm-12">
            <x-dynamic-component :component="$themeHelper->getComponentName($widgetName)" page="home" layout="body" :widgetName="$widgetName" :widgetData="$widgetData" :localeId="$localeId"/>
        </div>
    @endforeach
</div>
