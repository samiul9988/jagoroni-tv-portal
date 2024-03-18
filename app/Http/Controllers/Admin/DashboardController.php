<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\{AnalyticHelper, SettingHelper,UtlHelper};
use App\Http\Controllers\Controller;
use App\Models\{Contact,Language};
use App\Services\{PageService,PermissionService,PostService,RoleService,TermService,UserService};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\Request;
use Illuminate\Support\{Arr, Carbon};
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{
    protected $postService,
        $pageService,
        $termService,
        $userService,
        $roleService,
        $permissionService,
        $language,
        $contact;

    /**
     * @param PostService $postService
     * @param PageService $pageService
     * @param TermService $termService
     * @param UserService $userService
     * @param RoleService $roleService
     * @param PermissionService $permissionService
     * @param Language $language
     * @param Contact $contact
     */
    public function __construct(PostService       $postService,
                                PageService       $pageService,
                                TermService       $termService,
                                UserService       $userService,
                                RoleService       $roleService,
                                PermissionService $permissionService,
                                Language          $language,
                                Contact           $contact
    )
    {
        $this->postService = $postService;
        $this->pageService =  $pageService;
        $this->termService = $termService;
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
        $this->language = $language;
        $this->contact = $contact;

    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable|Application|Factory|View
     */
    public function __invoke(Request $request)
    {
        //variable for analytics
        $activeUsers         = null;
        $mostVisited         = null;
        $topBrowsers         = null;
        $topOperatingSystem  = null;
        $topCountry          = null;
        $devices             = null;
        $new_visitors        = null;
        $visitors_this_year  = null;
        $pageviews           = null;
        $pageviews_this_year = null;
        $visitors            = null;
        $col                 = null;
        $day                 = null;
        $label_day           = null;
        $label_day_visitor   = null;

        $arrCount = [
            'post'        => $this->postService->postCount(),
            'page'        => $this->pageService->pageCount(),
            'gallery'     => $this->postService->galleryCount(),
            'category'    => $this->termService->categoryCount(),
            'tag'         => $this->termService->tagCount(),
            'user'        => $this->userService->userCount(),
            'role'        => $this->roleService->roleCount(),
            'permission'  => $this->permissionService->permissionCount(),
            'language'    => UtlHelper::count($this->language),
            'contact'     => UtlHelper::count($this->contact)
        ];

        $count = (object)$arrCount;

        //if internet is available data will be displayed otherwise it will be null
        $connection = false;
        if (SettingHelper::check_connection()) {
            if (env('ANALYTICS_PROPERTY_ID')) {

                $day = $request->session()->has('session_device_analytics') ? session('session_device_analytics') : 7;
                $day_visitor_pageviews = $request->session()->has('session_visitor_pageview_analytics') ? session('session_visitor_pageview_analytics') : 7;

                $label_day = AnalyticHelper::label($request->session()->has('session_device_analytics'), $day);
                $label_day_visitor = AnalyticHelper::label($request->session()->has('session_visitor_pageview_analytics'), $day_visitor_pageviews);

                //display analytics
                $connection          = true;
                $activeUsers         = AnalyticHelper::fetchOnlineUsers();
                $mostVisited         = Analytics::fetchMostVisitedPages(Period::days($day), 8, 0);
                $topBrowsers         = Analytics::fetchTopBrowsers(Period::days($day), 8);
                $topOperatingSystem  = AnalyticHelper::fetchTopOperatingSystem(Period::days($day), 8);
                $topCountry          = AnalyticHelper::fetchTopCountry(Period::days($day), 8);
                $visitors_this_year  = AnalyticHelper::visitorsThisYear();
                $pageviews_this_year = AnalyticHelper::pageViewsThisYear();
                $new_visitors        = AnalyticHelper::newVisitors(Period::days(7));
                $visitors            = AnalyticHelper::visitors(Period::days($day_visitor_pageviews));
                $pageviews           = AnalyticHelper::pageViews(Period::days($day_visitor_pageviews));
                $devices             = Arr::collapse(AnalyticHelper::fetchTopDevice(Period::days($day)));
                $num_col             = $devices ? count($devices) : 12;
                $col                 = 12 / $num_col;
            }
        }

        $endDate = Carbon::today();

        $startDate = Carbon::today()->subDays(7)->startOfDay();

        UtlHelper::update(config('retenvi.version'));

        return view('admin.dashboard',
            compact('activeUsers',
                'mostVisited',
                'topBrowsers',
                'topOperatingSystem',
                'topCountry',
                'visitors_this_year',
                'pageviews_this_year',
                'visitors',
                'pageviews',
                'connection',
                'devices',
                'col',
                'day',
                'label_day',
                'label_day_visitor',
                'new_visitors',
                'count'
            ));
    }


}
