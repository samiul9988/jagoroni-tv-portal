<script>
    function sessionByDevice(day) {
        $.ajax({
            url: "{{ route('device.analytics') }}",
            method: "GET",
            data: {
                'periode': day
            }
        }).done(function (data) {
            console.log(data.data);
            let deviceChart = echarts.init(document.getElementById('deviceChart'));
            let option = {
                tooltip: {
                    show: true
                },
                series: [
                    {
                        type: 'pie',
                        data: data.data
                    }
                ],
                color: ['#27ae60', '#7CD6FD', '#018786', '#C9C9C9']
            }
            deviceChart.setOption(option, true);

            $('#labelPeriodDevice').html(data.period);

            $('#labelData').html('');

            var arrs =[];
            $.each(data.data, function( i, v ) {
                arrs.push(`<div class="col-lg col-${data.col}">`+
                    `<div class="description-block">` +
                        `<h5 class="description-header">${v.value}</h5>` +
                        `<span class="description-text">${v.name}</span>` +
                    `</div>` +
                `</div>`); 
            });

            $.each(arrs, function( key, val ) {
                $('#labelData').append(val);
            });
        });
    }

    function visitorPageView(day) {
        $.ajax({
            url: "{{ route('visitorpageview.analytics') }}",
            method: "GET",
            data: {
                'periode': day
            }
        }).done(function (data) {
            console.log(data);
            let visitorPageView = echarts.init(document.getElementById('visitorPageView'));
            const colors = ['#27ae60', '#7CD6FD'];
            option = {
                color: colors,
                tooltip: {
                    show: true,
                },
                legend: {
                    bottom: -5
                },
                grid: {
                    top: 60,
                    bottom: 70
                },
                xAxis: [
                    {
                        type: 'category',
                        axisTick: {
                            alignWithLabel: true
                        },
                        data: data.chart.labels
                    }
                ],
                yAxis: [
                    {
                        type: 'value'
                    }
                ],
                series: [
                    {
                        name: 'Visitors',
                        type: 'line',
                        data: data.datasets[0]['values']
                    },
                    {
                        name: 'PageViews',
                        type: 'line',
                        data: data.datasets[1]['values']
                    }
                ]
            }
            visitorPageView.setOption(option, true);

            $('#labelPeriodVPV').html(data.period);

            $('.pageviews').find('.description-header').html(data.total.totalPageViews);
            $('.visitors').find('.description-header').html(data.total.totalVisitors);

        });
    }

    
</script>
@if(env('ANALYTICS_PROPERTY_ID'))
    @can('read-analytics')
        @if(\App\Helpers\SettingHelper::check_connection())
            @if(\App\Helpers\SettingHelper::checkCredentialFileExists())
                <!-- Charting library -->
                <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
                <!-- Chartisan -->
                <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
                <script>
                    const chart = new Chartisan({
                        el: '#visitorPageView',
                        url: '{{ route('visitor_pageview_chart') }}',
                        hooks: new ChartisanHooks()
                            .colors(['#27ae60', '#7CD6FD'])
                            .tooltip()
                            .datasets('line')
                            .legend({ bottom: 0 })
                    });

                    

                    @empty($devices)
                    const deviceChart = new Chartisan({
                        el: '#deviceChart',
                        data: {
                            "chart": {
                                "labels": ["Device"]
                            },
                            "datasets": [{
                                "name": "Device Category",
                                "values": [0]
                            }]
                        },
                        hooks: new ChartisanHooks()
                            .colors(['#C9C9C9'])
                            .axis(false)
                            .tooltip()
                            .datasets('pie')
                    });
                    @else
                    const deviceChart = new Chartisan({
                        el: '#deviceChart',
                        url: '{{ route('device_chart') }}',
                        hooks: new ChartisanHooks()
                            .colors(['#27ae60', '#7CD6FD', '#018786', '#C9C9C9'])
                            .axis(false)
                            .tooltip()
                            .datasets('pie')
                    });
                    @endempty

                    
                </script>
            @endif
        @endif
    @endcan
@endif
