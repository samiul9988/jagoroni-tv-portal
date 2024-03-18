@if ($active)
    @if ($layout == 'body')
        @if ($widgetData['layout_type'] == 'two-column')
            <x-audio::two-column :page="$page" :layout="$layout" :widgetName="$widgetName" :widgetData="$widgetData" :localeId="$localeId"/>
        @elseif ($widgetData['layout_type'] == 'one-column')
            <x-audio::one-column :page="$page" :layout="$layout" :widgetName="$widgetName" :widgetData="$widgetData" :localeId="$localeId"/>
        @endif
    @endif
@endif
