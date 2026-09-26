<?php

namespace App\Http\Controllers;

use App\Models\{Post, Term};
use App\Services\PostService;
use Hashids\Hashids;
use App\Helpers\{SeoHelper, SettingHelper};
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SearchController extends Controller
{
    private $postService;

    /**
     * __construct
     *
     * @param  mixed $postService
     * @return void
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request)
    {
        $hashids = new Hashids();
        $keyword = trim((string) $request->get('q', ''));
        $division = trim((string) $request->get('division', ''));
        $district = trim((string) $request->get('district', ''));
        $upazila = trim((string) $request->get('upazila', ''));

        $query = $this->postService->postQuery();

        $query_search = $query;

        if ($keyword !== '') {
            $query_search->where(function ($query) use ($keyword) {
                $query->where('post_title', 'like', "%{$keyword}%")
                    ->orWhere('post_content', 'like', "%{$keyword}%")
                    ->orWhere('post_image', 'like', "%{$keyword}%")
                    ->orWhereHas('terms', function ($query) use ($keyword) {
                        $query->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        $location = collect([$upazila, $district, $division])
            ->first(fn ($value) => $value !== '');

        if ($division !== '') {
            $query_search->where('division', $division);
        }

        if ($district !== '') {
            $query_search->where('district', $district);
        }

        if ($upazila !== '') {
            $query_search->where('upazila', $upazila);
        }

        // Time filter (24h / 7 days / 30 days / all time).
        $period = (string) $request->get('period', 'all');
        $since = ['day' => now()->subDay(), 'week' => now()->subDays(7), 'month' => now()->subDays(30)][$period] ?? null;
        if ($since) {
            $query_search->where('created_at', '>=', $since);
        } else {
            $period = 'all';
        }

        // Category counts reflect keyword + location + time, so tabs show how many results each has.
        $allCategories = Term::category()->currentLanguage()->get();
        $categoryCounts = $allCategories->map(function ($term) use ($query_search) {
            $term->result_count = (clone $query_search)->whereHas('terms', fn ($q) => $q->where('terms.id', $term->id))->count();

            return $term;
        })->filter(fn ($term) => $term->result_count > 0)->sortByDesc('result_count')->values();
        $totalBeforeCategory = (clone $query_search)->count();

        $categorySlug = trim((string) $request->get('category', ''));
        $activeCategory = $categorySlug !== '' ? $allCategories->firstWhere('slug', $categorySlug) : null;
        if ($activeCategory) {
            $query_search->whereHas('terms', fn ($q) => $q->where('terms.id', $activeCategory->id));
        } else {
            $categorySlug = '';
        }

        $posts       = $query_search->paginate(6);
        $countResults  = $posts->total();

        $sidebarLatest = Post::query()->article()->publish()->latest()->take(5)->get();
        $popularTags = Term::tag()->currentLanguage()->withCount('posts')->orderByDesc('posts_count')->take(10)->get();
        $locationLabel = collect([$division, $district, $upazila])
            ->filter()
            ->implode(' / ');
        $searchLabel = collect([$keyword, $locationLabel])
            ->filter()
            ->implode(' — ');

        if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') {
            $attr = ($posts->currentPage() == 1) ? "" : __('jagoronitv::magz.page')." " . $posts->currentPage() . " - ";
            $seoTitle = "$attr " . __('jagoronitv::magz.latest_news') . " - " . config('settings.site_name');
        } else {
            $attr = ($posts->currentPage() == 1) ? "" : " - ".__('jagoronitv::magz.page')." " . $posts->currentPage();
            $seoTitle = config('settings.site_name') . " - " .__('jagoronitv::magz.latest_news') ." $attr";
        }

        SeoHelper::getPage('search', $seoTitle);

        return view(SettingHelper::activeTheme('page/search'), compact(
            'posts',
            'keyword',
            'division',
            'district',
            'upazila',
            'location',
            'searchLabel',
            'countResults',
            'categoryCounts',
            'totalBeforeCategory',
            'categorySlug',
            'period',
            'sidebarLatest',
            'popularTags',
            'hashids'));
    }
}
