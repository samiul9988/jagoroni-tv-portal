<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ChartResource;
use Illuminate\Http\Request;
use Illuminate\Support\{Arr, Str};
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\{OrderBy, Period};

class ChartController extends Controller
{
    /**
     * @param Request $request
     * @return ChartResource
     */
    public function showTotalVisitorsAndPageViews(Request $request)
    {
        $totalVP = $this->fetchTotalVisitorsAndPageViews(Period::days(7));
        $dates_VP = $totalVP->map(function ($item) {
            return $item['date']->format('d M');
        });

        $visitors_VP = $totalVP->pluck('activeUsers');
        $pageViews_VP = $totalVP->pluck('screenPageViews');

        $chart = [
            'chart' => [
                'labels' => Arr::flatten($dates_VP),
                'extra' => null
            ],

            'datasets' => [
                [
                    'name' => 'Visitors',
                    'values' => Arr::flatten($visitors_VP),
                    'extra' => null,
                ],
                [
                    'name' => 'PageViews',
                    'values' => Arr::flatten($pageViews_VP),
                    'extra' => null,
                ]
            ]
        ];

        return new ChartResource($chart);
    }

    
    /**
     * showDevice
     *
     * @return void
     */
    public function showDevice()
    {

        $devices = $this->fetchDeviceCategory(Period::days(7));

        $type_devices = collect($devices)->map(function (array $item) {
            return Str::ucfirst(array_keys($item)[0]);
        });

        $result_devices = collect($devices)->map(function (array $item) {
            return (int) array_values($item)[0];
        });

        $chart = [
            'chart' => [
                'labels' => Arr::flatten($type_devices),
                'extra' => null
            ],

            'datasets' => [
                [
                    'name' => 'Device Category',
                    'values' => Arr::flatten($result_devices),
                    'extra' => null,
                ]
            ]
        ];

        return new ChartResource($chart);
    }

    /**
     * @param Period $period
     * @return mixed
     */
    public function fetchTotalVisitorsAndPageViews(Period $period, int $maxResults = 10, int $offset = 0)
    {
        return Analytics::get(
            $period,
            ['activeUsers', 'screenPageViews'],
            ['date'],
            $maxResults,
            [
                OrderBy::dimension('date', false),
            ],
            $offset,
        );
    }

    /**
     * @param Period $period
     * @return mixed
     */
    public function fetchDeviceCategory(Period $period, int $maxResults = 10, int $offset = 0)
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
            return [$deviceRow['deviceCategory'] => $deviceRow['activeUsers']];
        });
    }
}
