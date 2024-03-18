<?php

namespace App\View\Components\Front\Magz;

use App\Services\ArticleService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class Headline extends Component
{
    public $posts, $active, $autoPlay;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ArticleService $articleService, $widgetName, $widgetData, $localeId)
    {
        $this->posts    = $articleService->dynamicQuery('home', 'body', $widgetName, $widgetData, $localeId);
        $this->active   = $widgetData['active'] == 'true' ? true : false;
        $this->autoPlay = $widgetData['carousel_autoplay'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.front.magz.headline');
    }
}
