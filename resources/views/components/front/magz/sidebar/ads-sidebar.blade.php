@if ($active)
@if ($widgetData['ad_type'] == "image")
   <x-ads::image :page="$page" :layout="$layout" :widgetName="$widgetName" :widgetData="$widgetData"/>
@elseif ($widgetData['ad_type'] == "script")
   <x-ads::script :page="$page" :layout="$layout" :widgetName="$widgetName" :widgetData="$widgetData"/>
@else
   <x-ads::google-adsense :page="$page" :layout="$layout" :widgetName="$widgetName" :widgetData="$widgetData"/>
@endif
@endif
