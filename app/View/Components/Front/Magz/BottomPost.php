<?php

namespace App\View\Components\Front\Magz;

use App\Services\ArticleService;
use Illuminate\View\Component;

class BottomPost extends Component
{
    public object $posts;
    public $widgetData, $count, $autoPlay;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ArticleService $articleService, $widgetData, $localeId)
    {
        $this->posts      = $articleService->dynamicQuery('home', 'body', 'bottom_post', $widgetData, $localeId);
        $this->widgetData = $widgetData;
        $this->count      = count($this->posts);
        $this->autoPlay   = $widgetData['carousel_autoplay'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.magz.bottom-post');
    }
}
