<?php

namespace App\View\Components\Front\Magz\PostCarousel;

use App\Services\ArticleService;
use Illuminate\View\Component;

class VerticalSlider extends Component
{
    public $widgetData, $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ArticleService $articleService, $template, $page, $layout, $type, $section, $widgetName, $widgetData)
    {
        if ($type == 'section') {
            $this->posts = $articleService->dynamicQuery($template, $page, $layout, $widgetName, $type, null, $section);
        } else {
            $this->posts = $articleService->dynamicQuery($template, $page, $layout, $widgetName);
        }

        $this->widgetData = $widgetData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.magz.post-carousel.vertical-slider');
    }
}
