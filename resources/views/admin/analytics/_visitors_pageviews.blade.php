<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ __('title.visitor_&_pageview') }}</h3>
        <div class="card-tools">
            <div class="btn-group">
                <button id="labelPeriodVPV" type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                    {{ $label_day_visitor }}
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu" id="session_by_device">
                    <a href="javascript:;" class="dropdown-item choice" onclick="visitorPageView(0);">{{ __('today') }}</a>
                    <a href="javascript:;" class="dropdown-item choice" onclick="visitorPageView(1);">{{ __('yesterday') }}</a>
                    <a href="javascript:;" class="dropdown-item choice" onclick="visitorPageView(7);">{{ __('last_7_days') }}</a>
                    <a href="javascript:;" class="dropdown-item choice" onclick="visitorPageView(28);">{{ __('last_28_days') }}</a>
                    <a href="javascript:;" class="dropdown-item choice" onclick="visitorPageView(90);">{{ __('last_90_days') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div id="visitorPageView" style="height: 300px;"></div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-3 col-6 pageviewyear">
                <div class="description-block border-right">
                    <h5 class="description-header">{{ $pageviews_this_year }}</h5>
                    <span class="description-text">{{ __('pageviews') }} ({{ \Carbon\Carbon::now()->year }})</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6 visitoryear">
                <div class="description-block border-right vy">
                    <h5 class="description-header">{{ $visitors_this_year }}</h5>
                    <span class="description-text">{{ __('visitors') }} ({{ \Carbon\Carbon::now()->year }})</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6 pageviews">
                <div class="description-block border-right">
                    <h5 class="description-header">{{ $pageviews }}</h5>
                    <span class="description-text">{{ __('pageviews') }}</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6 visitors">
                <div class="description-block">
                    <h5 class="description-header">{{ $visitors }}</h5>
                    <span class="description-text">{{ __('visitors') }}</span>
                </div>
                <!-- /.description-block -->
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
