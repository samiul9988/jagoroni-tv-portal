<?php

namespace App\View\Components\Front\Magz\Footer;

use App\Helpers\LocalizationHelper;
use App\Services\ArticleService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class PostFooter extends Component
{
    public $posts, $widgetData;
    
    /**
     * __construct
     *
     * @param  mixed $articleService
     * @param  mixed $page
     * @param  mixed $widgetName
     * @param  mixed $widgetData
     * @return void
     */
    public function __construct(ArticleService $articleService, $page, $widgetName, $widgetData, $localeId)
    {
        $this->posts = $articleService->dynamicQuery($page, 'footer', $widgetName, $widgetData, $localeId);
        $this->widgetData = $widgetData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.front.magz.footer.post-footer');
    }
}
