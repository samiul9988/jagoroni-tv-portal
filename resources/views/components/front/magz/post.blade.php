@if ($active)
    @if ($layout == 'body')
        @if ($widgetData['layout_type'] == 'two-column')
            <x-post::two-column :widgetData="$widgetData" :page="$page" :layout="$layout" :widgetName="$widgetName" :localeId="$localeId"/>
        @elseif ($widgetData['layout_type'] == 'one-column')
            <x-post::one-column :widgetData="$widgetData" :page="$page" :layout="$layout" :widgetName="$widgetName" :localeId="$localeId"/>
        @endif
    @endif
@endif
