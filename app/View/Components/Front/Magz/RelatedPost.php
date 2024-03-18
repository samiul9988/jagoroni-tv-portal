<?php

namespace App\View\Components\Front\Magz;

use App\Helpers\LocalizationHelper;
use App\Services\ArticleService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class RelatedPost extends Component
{
    public $active, $countRelatedPost, $relatedPosts, $mainPostTitle, $widgetData, $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ArticleService $articleService, $mainPostTitle, $post, $page, $layout, $widgetName, $widgetData)
    {
        /** @var object Post */
        $this->posts            = $articleService->relatedPosts($post, $widgetData);
        $this->countRelatedPost = count( $this->posts);
        $this->active           = $widgetData['active'] == 'true' ?? true;
        $this->mainPostTitle    = $mainPostTitle;
        $this->widgetData       = $widgetData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.front.magz.related-post');
    }
}
