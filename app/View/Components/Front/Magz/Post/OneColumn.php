<?php

namespace App\View\Components\Front\Magz\Post;

use App\Helpers\LocalizationHelper;
use App\Services\ArticleService;
use Illuminate\View\Component;

class OneColumn extends Component
{
    public $posts, $widgetData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ArticleService $articleService, $page, $layout, $widgetName, $widgetData, $localeId)
    {
        $this->posts = $articleService->dynamicQuery($page, $layout, $widgetName, $widgetData, $localeId);
        $this->widgetData = $widgetData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.magz.post.one-column');
    }
}
