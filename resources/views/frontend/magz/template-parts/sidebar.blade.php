<div class="col-lg-3 sidebar jtv-single-sidebar" id="sidebar">
    <x-front-advertisement :position="$advertisementPosition ?? 'sidebar_right'" />
    @php
        $sidebarAdWidget = collect($sidebar)->first(function ($widgetData, $widgetName) {
            return str_starts_with($widgetName, 'ads_sidebar');
        });
        $sidebarAdWidgetName = collect($sidebar)->keys()->first(function ($widgetName) {
            return str_starts_with($widgetName, 'ads_sidebar');
        });
    @endphp
    @if(isset($categorySidebarMode) && $categorySidebarMode)
        @inject('categoryPostHelper', 'App\Helpers\PostHelper')
        <div class="jtv-category-news-panel">
            <div class="jtv-category-news-tabs">
                <button type="button" class="is-active" data-category-tab="latest">সর্বশেষ</button>
                <button type="button" data-category-tab="read">পঠিত</button>
            </div>
            <div class="jtv-category-news-list is-active" data-category-panel="latest">
                @foreach($latestPosts as $latestPost)
                    <article class="jtv-category-news-item">
                        <a href="{{ $categoryPostHelper::getUriPost($latestPost) }}">
                            <img src="{{ $categoryPostHelper::showThumbnail($latestPost, 100) }}" alt="{{ $latestPost->post_title }}">
                            <span>{{ $latestPost->post_title }}</span>
                        </a>
                    </article>
                @endforeach
            </div>
            <div class="jtv-category-news-list" data-category-panel="read">
                @foreach($mostReadPosts as $readPost)
                    <article class="jtv-category-news-item">
                        <a href="{{ $categoryPostHelper::getUriPost($readPost) }}">
                            <img src="{{ $categoryPostHelper::showThumbnail($readPost, 100) }}" alt="{{ $readPost->post_title }}">
                            <span>{{ $readPost->post_title }}</span>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    @endif
    @foreach($sidebar as $widgetName => $widgetData)
        @if(isset($categorySidebarMode) && $categorySidebarMode && $widgetName === 'post')
            @continue
        @endif
        @if ($widgetData['active'] == 'true')
        <x-dynamic-component :component="$themeHelper->getComponentName($widgetName)" page="home" layout="sidebar" :widgetName="$widgetName" :widgetData="$widgetData" :localeId="$localeId"/>
        @endif
    @endforeach
    @if(($page ?? null) === 'single-post' && $sidebarAdWidgetName && $sidebarAdWidget && ($sidebarAdWidget['active'] ?? 'false') == 'true')
        <div class="jtv-single-sidebar-bottom-ad">
            <x-dynamic-component :component="$themeHelper->getComponentName($sidebarAdWidgetName)" page="home" layout="sidebar" :widgetName="$sidebarAdWidgetName" :widgetData="$sidebarAdWidget" :localeId="$localeId"/>
        </div>
    @endif
</div>
