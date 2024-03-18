<?php

namespace App\Helpers;

use Illuminate\Support\{Carbon, Collection};
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\{OrderBy, Period};

Class AnalyticHelper
{
    /**
     * @return mixed
     */
    public static function fetchOnlineUsers()
    {
        $analytics = Analytics::fetchUserTypes(Period::days(1));

        return $analytics->last(function ($value, $key) {
            return $value['activeUsers'];
        });
    }

    /**
     * fetchTopOperatingSystem
     *
     * @param  mixed $period
     * @param  mixed $maxResults
     * @param  mixed $offset
     * @return void
     */
    public static function fetchTopOperatingSystem(Period $period, int $maxResults = 10, int $offset = 0)
    {
        return Analytics::get(
            $period,
            ['screenPageViews'],
            ['operatingSystem', 'operatingSystemVersion'],
            $maxResults,
            [],
            $offset,
        );
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
                'sessions' => $topOSs->splice($maxResults - 1)->sum('sessions'),
            ]);
    }

    /**
     * @param Period $period
     * @param int $maxResults
     * @return Collection
     */
    public static function fetchTopCountry(Period $period, int $maxResults = 10, int $offset = 0)
    {
        $response =  Analytics::get(
            $period,
            ['screenPageViews'],
            ['country'],
            $maxResults,
            [],
            $offset,
        );

        $topCountrys = collect($response['rows'] ?? [])->map(function (array $countryRow) {
            return [
                'country' => $countryRow[0],
                'sessions' => (int)$countryRow[1],
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
    protected function summarizeTopCountry(Collection $topCountrys, int $maxResults)
    {
        return $topCountrys
            ->take($maxResults - 1)
            ->push([
                'country' => 'Others',
                'sessions' => $topCountrys->splice($maxResults - 1)->sum('sessions'),
            ]);
    }

    /**
     * @return mixed
     */
    public static function fetchTotalVisitors()
    {
        $startDate = Carbon::create(2020, 01, 01, 0, 0, 0);
        $period = Period::create($startDate, Carbon::now());
        return Analytics::fetchTotalVisitorsAndPageViews($period)->sum('visitors');
    }

    /**
     * @param Period $period
     * @return mixed
     */
    public static function fetchTotalPageViews(Period $period)
    {
        return Analytics::fetchTotalVisitorsAndPageViews($period)->sum('pageViews');
    }

    /**
     * @return mixed
     */
    public static function visitorsThisYear()
    {
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now();
        $period = Period::create($startDate, $endDate);
        return Analytics::fetchTotalVisitorsAndPageViews($period)->sum('activeUsers');
    }

    /**
     * @return mixed
     */
    public static function pageViewsThisYear()
    {
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now();
        $period = Period::create($startDate, $endDate);
        return Analytics::fetchTotalVisitorsAndPageViews($period)->sum('screenPageViews');
    }

    /**
     * @param Period $period
     * @return mixed
     */
    // public static function fetchTotalVisitorsAndPageViews(Period $period)
    // {
    //     return Analytics::fetchTotalVisitorsAndPageViews($period);
    // }
    
    /**
     * fetchTotalVisitorsAndPageViews
     *
     * @param  mixed $period
     * @param  mixed $maxResults
     * @param  mixed $offset
     * @return void
     */
    public static function fetchTotalVisitorsAndPageViews(Period $period, int $maxResults = 20, int $offset = 0)
    {
        return Analytics::get(
            $period,
            ['activeUsers', 'screenPageViews'],
            ['date'],
            $maxResults,
            [
                OrderBy::dimension('date', true),
            ],
            $offset,
        );
    }

    /**
     * @param Period $period
     * @return Collection
     */
    public static function fetchTopDevice(Period $period, int $maxResults = 10, int $offset = 0)
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

    public static function getTopDevice(Period $period, int $maxResults = 10, int $offset = 0)
    {
        
        $response =  Analytics::get(
            $period,
            ['activeUsers'],
            ['deviceCategory'],
            $maxResults,
            [],
            $offset,
        );

        return collect($response ?? [])->map(function (array $deviceRow) {
            return [
                'value' => $deviceRow['activeUsers'],
                'name' => $deviceRow['deviceCategory']
            ];
        });
    }

    /**
     * @param Period $period
     * @return array[]
     */
    public static function fetchUserTypes(Period $period)
    {
        return Analytics::fetchUserTypes($period);
    }

    /**
     * @param Period $period
     * @return mixed
     */
    public static function newVisitors(Period $period)
    {
        $response = Analytics::fetchUserTypes($period);
        return empty($response->count()) ? 0 : $response[0]['activeUsers'];
    }

    /**
     * @param Period $period
     * @return mixed
     */
    public static function visitors(Period $period)
    {
        return Analytics::fetchTotalVisitorsAndPageViews($period)->sum('activeUsers');
    }

    /**
     * @param Period $period
     * @return mixed
     */
    public static function PageViews(Period $period)
    {
        // return $this->fetchTotalVisitorsAndPageViews($period)->sum('screenPageViews');
        return Analytics::fetchTotalVisitorsAndPageViews($period)->sum('screenPageViews');
    }

    /**
     * @param Period $period
     * @return Collection
     */
    public static function fetchVisitors(Period $period, int $maxResults = 10, int $offset = 0)
    {
        $response =  Analytics::get(
            $period,
            ['screenPageViews'],
            ['deviceCategory'],
            $maxResults,
            [],
            $offset,
        );

        return collect($response['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'date' => Carbon::createFromFormat('Ymd', $dateRow[0]),
                'visitors' => (int)$dateRow[1],
            ];
        });
    }

    /**
     * @param $session
     * @param $day
     * @return string
     */
    public static function label($session, $day)
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
     * getLabel
     *
     * @param  mixed $day
     * @return void
     */
    public static function getLabel($day)
    {
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

        return $label;
    }
}