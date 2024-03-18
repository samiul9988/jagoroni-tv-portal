<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\Request;
use Illuminate\Support\{Arr, Collection};
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class AnalyticController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function __invoke(Request $request)
    {
        $day                    = $request->session()->has('session_device_analytics') ? session('session_device_analytics') : 7;
        $day_visitor_pageviews  = $request->session()->has('session_visitor_pageview_analytics') ? session('session_visitor_pageview_analytics') : 7;
        $day_most_visited_pages = $request->session()->has('session_most_visited_pages') ? session('session_most_visited_pages') : 7;
        $day_browser_used       = $request->session()->has('session_browser_used') ? session('session_browser_used') : 7;
        $day_operating_system   = $request->session()->has('session_browser_used') ? session('session_browser_used') : 7;
        $day_sessions_country   = $request->session()->has('session_country') ? session('session_country') : 7;

        $label_day                       = $this->label($request->session()->has('session_device_analytics'), $day);
        $label_day_visitor               = $this->label($request->session()->has('session_visitor_pageview_analytics'), $day_visitor_pageviews);
        $label_day_most_visited_pages    = $this->label($request->session()->has('session_most_visited_pages'), $day_most_visited_pages);
        $label_day_browser_used          = $this->label($request->session()->has('session_browser_used'), $day_browser_used);
        $label_day_operating_system_used = $this->label($request->session()->has('session_browser_used'), $day_browser_used);
        $label_day_sessions_country      = $this->label($request->session()->has('session_country'), $day_sessions_country);

        $devices             = Arr::collapse($this->fetchTopDevice(Period::days($day)));
        $number_devices      = $devices ? count($devices) : 12;
        $col                 = 12 / $number_devices;
        $pageviews_this_year = $this->pageViewsThisYear();
        $visitors_this_year  = $this->visitorsThisYear();
        $pageviews           = $this->pageViews(Period::days($day_visitor_pageviews));
        $visitors            = $this->visitors(Period::days($day_visitor_pageviews));
        $mostVisited         = Analytics::fetchMostVisitedPages(Period::days($day_most_visited_pages), 8);
        $topBrowsers         = $this->fetchTopBrowsers(Period::days($day_browser_used), 8);
        $topOperatingSystem  = $this->fetchTopOperatingSystem(Period::days($day_operating_system), 8);
        $topCountry          = $this->fetchTopCountry(Period::days($day_sessions_country), 8);

        return view('admin.analytics.index', compact(
            'label_day_visitor',
            'label_day',
            'label_day_visitor',
            'devices',
            'col',
            'pageviews_this_year',
            'visitors_this_year',
            'pageviews',
            'visitors',
            'mostVisited',
            'topBrowsers',
            'topOperatingSystem',
            'topCountry',
            'label_day_most_visited_pages',
            'label_day_browser_used',
            'label_day_operating_system_used',
            'label_day_sessions_country'
        ));
    }

    /**
     * @param $session
     * @param $day
     * @return string
     */
    public function label($session, $day)
    {
        $label = __('in_7_days');
        if ($session) {
            if ($day == 0) {
                $label = __('today');
            } else if ($day == 1) {
                $label = __('yesterday');
            } else if ($day == 7) {
                $label = __('in_7_days');
            } else if ($day == 28) {
                $label = __('in_28_days');
            } else if ($day == 90) {
                $label = __('in_90_days');
            }
        }

        return $label;
    }

    /**
     * @param Period $period
     * @return Collection
     */
    public function fetchTopDevice(Period $period, int $maxResults = 10, int $offset = 0)
    {
        $response = Analytics::get(
            $period,
            ['activeUsers'],
            ['deviceCategory'],
            $maxResults,
            [],
            $offset,
        );

        return collect($response ?? [])->map(function (array $deviceRow) {
            return [$deviceRow['deviceCategory'] => $deviceRow['activeUsers']];
        });
    }

    /**
     * @return mixed
     */
    public function visitorsThisYear()
    {
        $startDate        = Carbon::now()->startOfYear();
        $endDate          = Carbon::now();
        $period_this_year = Period::create($startDate, $endDate);
        return $this->fetchTotalVisitorsAndPageViews($period_this_year)->sum('activeUsers');
    }

    /**
     * @return mixed
     */
    public function pageViewsThisYear()
    {
        $startDate        = Carbon::now()->startOfYear();
        $endDate          = Carbon::now();
        $period_this_year = Period::create($startDate, $endDate);
        return $this->fetchTotalVisitorsAndPageViews($period_this_year)->sum('screenPageViews');
    }

    /**
     * @param Period $period
     * @return mixed
     */
    public function visitors(Period $period)
    {
        return $this->fetchTotalVisitorsAndPageViews($period)->sum('activeUsers');
    }

    /**
     * @param Period $period
     * @return mixed
     */
    public function PageViews(Period $period)
    {
        return $this->fetchTotalVisitorsAndPageViews($period)->sum('screenPageViews');
    }

    /**
     * @param Period $period
     * @return mixed
     */
    public function fetchTotalVisitorsAndPageViews(Period $period)
    {
        return Analytics::fetchTotalVisitorsAndPageViews($period);
    }

    /**
     * @param Period $period
     * @param int $maxResults
     * @return Collection
     */
    public function fetchTopOperatingSystem(Period $period, int $maxResults = 10, int $offset = 0)
    {
        $response = Analytics::get(
            $period,
            ['activeUsers'],
            ['operatingSystem', 'operatingSystemVersion'],
            $maxResults,
            [],
            $offset,
        );

        $topOSs = collect($response ?? [])->map(function (array $osRow) {
            return [
                'os' => $osRow['operatingSystem'],
                'version' => $osRow['operatingSystemVersion'],
                'users' => (int)$osRow['activeUsers'],
            ];
        });

        if ($topOSs->count() <= $maxResults) {
            return $topOSs;
        }

        return $this->summarizeTopOperatingSystem($topOSs, $maxResults);
    }

    /**
     * @param Collection $topOSs
     * @param int $maxResults
     * @return Collection
     */
    protected function summarizeTopOperatingSystem(Collection $topOSs, int $maxResults)
    {
        return $topOSs
            ->take($maxResults - 1)
            ->push([
                'os' => 'Others',
                'version' => '-',
                'sessions' => $topOSs->splice($maxResults - 1)->sum('activeUsers'),
            ]);
    }

    public function fetchTopBrowsers(Period $period, int $maxResults = 10, int $offset = 0)
    {
        $response = Analytics::get(
            $period,
            ['activeUsers'],
            ['browser'],
            $maxResults,
            [],
            $offset,
        );

        $topBrowsers = collect($response ?? [])->map(function (array $row) {
            return [
                'browser' => $row['browser'],
                'users' => (int)$row['activeUsers'],
            ];
        });

        if ($topBrowsers->count() <= $maxResults) {
            return $topBrowsers;
        }

        return $this->summarizeTopBrowser($topBrowsers, $maxResults);
    }
    
    /**
     * summarizeTopBrowser
     *
     * @param  mixed $topCountrys
     * @param  mixed $maxResults
     * @return Collection
     */
    protected function summarizeTopBrowser(Collection $topCountrys, int $maxResults): Collection
    {
        return $topCountrys
            ->take($maxResults - 1)
            ->push([
                'browser' => 'Others',
                'users' => $topCountrys->splice($maxResults - 1)->sum('activeUsers'),
            ]);
    }

    /**
     * @param Period $period
     * @param int $maxResults
     * @return Collection
     */
    public function fetchTopCountry(Period $period, int $maxResults = 10, int $offset = 0)
    {
        $response = Analytics::get(
            $period,
            ['activeUsers'],
            ['country'],
            $maxResults,
            [],
            $offset,
        );

        $topCountrys = collect($response ?? [])->map(function (array $countryRow) {
            return [
                'country' => $countryRow['country'],
                'users' => (int)$countryRow['activeUsers'],
            ];
        });

        if ($topCountrys->count() <= $maxResults) {
            return $topCountrys;
        }

        return $this->summarizeTopCountry($topCountrys, $maxResults);
    }

    /**
     * @param Collection $topCountrys
     * @param int $maxResults
     * @return Collection
     */
    protected function summarizeTopCountry(Collection $topCountrys, int $maxResults): Collection
    {
        return $topCountrys
            ->take($maxResults - 1)
            ->push([
                'country' => 'Others',
                'sessions' => $topCountrys->splice($maxResults - 1)->sum('sessions'),
            ]);
    }


}
