@extends('adminlte::page')

@section('title', __('title.dashboard'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <h1 class="sr-only">{{ __('title.dashboard') }}</h1>
@stop

@section('plugins.Flag', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="jtv-admin-dashboard">
        <section class="jtv-dashboard-welcome">
            <div>
                <span class="jtv-dashboard-eyebrow"><i class="fas fa-chart-line"></i> Jagoroni TV Admin</span>
                <h2>ড্যাশবোর্ড</h2>
                <p>আপনার সংবাদ প্ল্যাটফর্মের সব গুরুত্বপূর্ণ তথ্য এক নজরে দেখুন।</p>
            </div>
            <a class="jtv-dashboard-live" href="{{ url('/live-tv') }}" target="_blank" rel="noopener">
                <span class="jtv-live-dot"></span> লাইভ সাইট দেখুন <i class="fas fa-arrow-up-right-from-square"></i>
            </a>
        </section>

        <div class="jtv-dashboard-stats">
        @can('read-posts')
            <a class="jtv-dashboard-stat stat-green" href="{{ route('posts.index') }}">
                <span class="jtv-stat-icon"><i class="fas fa-newspaper"></i></span><span><small>সংবাদ</small><strong>{{ $count->post }}</strong><em><i class="fas fa-arrow-up"></i> প্রকাশিত কনটেন্ট</em></span>
            </a>
        @endcan
        @can('read-pages')
            <a class="jtv-dashboard-stat stat-red" href="{{ route('pages.index') }}">
                <span class="jtv-stat-icon"><i class="fas fa-copy"></i></span><span><small>পেজ</small><strong>{{ $count->page }}</strong><em>সক্রিয় পেজ</em></span>
            </a>
        @endcan
        @can('read-categories')
            <a class="jtv-dashboard-stat stat-teal" href="{{ route('categories.index') }}">
                <span class="jtv-stat-icon"><i class="fas fa-tags"></i></span><span><small>ক্যাটাগরি</small><strong>{{ $count->category }}</strong><em>বিষয়ভিত্তিক বিভাগ</em></span>
            </a>
        @endcan
        @can('read-tags')
            <a class="jtv-dashboard-stat stat-orange" href="{{ route('tags.index') }}">
                <span class="jtv-stat-icon"><i class="fas fa-thumbtack"></i></span><span><small>ট্যাগ</small><strong>{{ $count->tag }}</strong><em>সংবাদ ট্যাগ</em></span>
            </a>
        @endcan
        @can('read-users')
            <a class="jtv-dashboard-stat stat-purple" href="{{ route('users.index') }}">
                <span class="jtv-stat-icon"><i class="fas fa-users"></i></span><span><small>ইউজার</small><strong>{{ $count->user }}</strong><em>নিবন্ধিত ইউজার</em></span>
            </a>
        @endcan
        @can('read-contacts')
            <a class="jtv-dashboard-stat stat-blue" href="{{ route('contacts.index') }}">
                <span class="jtv-stat-icon"><i class="fas fa-envelope"></i></span><span><small>যোগাযোগ</small><strong>{{ $count->contact }}</strong><em>নতুন বার্তা</em></span>
            </a>
        @endcan
        @can('read-galleries')
            <a class="jtv-dashboard-stat stat-violet" href="{{ route('galleries.index') }}">
                <span class="jtv-stat-icon"><i class="fas fa-images"></i></span><span><small>গ্যালারি</small><strong>{{ $count->gallery }}</strong><em>মিডিয়া গ্যালারি</em></span>
            </a>
        @endcan
        </div>

        <div class="jtv-dashboard-columns">
            <section class="jtv-dashboard-panel jtv-recent-panel">
                <div class="jtv-panel-heading"><h3><i class="fas fa-newspaper"></i> সাম্প্রতিক সংবাদ</h3><a href="{{ route('posts.index') }}">সব দেখুন <i class="fas fa-arrow-right"></i></a></div>
                <div class="jtv-recent-list">
                    @forelse($recentPosts as $post)
                        <a class="jtv-recent-item" href="{{ route('posts.edit', $post->id) }}">
                            <span class="jtv-recent-thumb"><i class="fas fa-file-lines"></i></span>
                                <span class="jtv-recent-copy"><strong>{{ \Illuminate\Support\Str::limit(strip_tags($post->post_title), 70) }}</strong><small><i class="far fa-clock"></i> {{ optional($post->created_at)->diffForHumans() }} <span>•</span> প্রকাশিত</small></span>
                            <i class="fas fa-chevron-right jtv-recent-arrow"></i>
                        </a>
                    @empty
                        <div class="jtv-empty-state">এখনও কোনো সংবাদ প্রকাশিত হয়নি।</div>
                    @endforelse
                </div>
            </section>
            <section class="jtv-dashboard-panel jtv-quick-panel">
                <div class="jtv-panel-heading"><h3><i class="fas fa-bolt"></i> দ্রুত অ্যাকশন</h3></div>
                <div class="jtv-quick-grid">
                    @can('add-posts')<a href="{{ route('posts.create') }}"><i class="fas fa-plus"></i><span>নতুন সংবাদ</span></a>@endcan
                    @can('read-galleries')<a href="{{ route('galleries.index') }}"><i class="fas fa-image"></i><span>মিডিয়া আপলোড</span></a>@endcan
                    @can('add-categories')<a href="{{ route('categories.index') }}"><i class="fas fa-tag"></i><span>ক্যাটাগরি ম্যানেজ</span></a>@endcan
                    @can('read-contacts')<a href="{{ route('contacts.index') }}"><i class="fas fa-inbox"></i><span>বার্তা দেখুন</span></a>@endcan
                </div>
            </section>
        </div>

    @if(env('ANALYTICS_PROPERTY_ID'))
        @can('read-analytics')
            @if(\App\Helpers\SettingHelper::check_connection())
                @if(\App\Helpers\SettingHelper::checkCredentialFileExists())
                    <h4 class="head-analytics mt-4 mb-4"><span class="title-google-analytics">{{ __('title.google_analytics') }}</span> <small class="link-analytics-detail">(<a href="{{ route('analytics') }}">{{ __('see_more') }}</a>)</small></h4>
                    <div class="row">
                        <div class="col-md-4">
                            @include('admin.analytics._device')
                        </div>
                        <div class="col-md-8">
                            @include('admin.analytics._visitors_pageviews')
                        </div>
                    </div>
                @endif
            @endif
        @endcan
    @endif
    </div>
@stop

@push('css')
    <style>
        body:has(.jtv-admin-dashboard) { background: #f3f7f5; }
        body:has(.jtv-admin-dashboard) .content-wrapper { background: #f3f7f5; }
        body:has(.jtv-admin-dashboard) .content-header { display: none; }
        body:has(.jtv-admin-dashboard) .content { padding: 24px 28px 34px; }
        body:has(.jtv-admin-dashboard) .main-sidebar { background: linear-gradient(180deg, #063f2d 0%, #032d22 100%); }
        body:has(.jtv-admin-dashboard) .brand-link { border-bottom: 1px solid rgba(255,255,255,.12); background: #063f2d; }
        body:has(.jtv-admin-dashboard) .brand-link .brand-text { color: #fff; font-weight: 800; }
        body:has(.jtv-admin-dashboard) .main-header { border-bottom: 1px solid #e4ece8; background: #fff; }
        body:has(.jtv-admin-dashboard) .nav-sidebar .nav-link { color: rgba(255,255,255,.78); border-radius: 5px; margin: 2px 10px; }
        body:has(.jtv-admin-dashboard) .nav-sidebar .nav-link:hover,
        body:has(.jtv-admin-dashboard) .nav-sidebar .nav-link.active { color: #fff; background: #d71e27; }
        body:has(.jtv-admin-dashboard) .jtv-admin-dashboard { max-width: 1440px; margin: 0 auto; font-family: "Noto Sans Bengali", "Segoe UI", sans-serif; }
        .jtv-dashboard-welcome { display: flex; align-items: center; justify-content: space-between; gap: 20px; padding: 24px 28px; margin-bottom: 20px; border-radius: 14px; color: #fff; background: linear-gradient(110deg, #07543a, #0b7a4a 58%, #d71e27); box-shadow: 0 10px 25px rgba(4, 71, 46, .16); }
        .jtv-dashboard-eyebrow { display: block; margin-bottom: 7px; color: #bdebd7; font-size: 12px; font-weight: 700; letter-spacing: .2px; }
        .jtv-dashboard-welcome h2 { margin: 0; font-size: 29px; font-weight: 800; }
        .jtv-dashboard-welcome p { margin: 5px 0 0; color: rgba(255,255,255,.8); font-size: 13px; }
        .jtv-dashboard-live { display: inline-flex; align-items: center; gap: 8px; padding: 11px 16px; border: 1px solid rgba(255,255,255,.38); border-radius: 7px; color: #fff !important; background: rgba(255,255,255,.12); font-size: 13px; font-weight: 700; text-decoration: none !important; white-space: nowrap; }
        .jtv-live-dot { width: 8px; height: 8px; border-radius: 50%; background: #ffccd0; box-shadow: 0 0 0 4px rgba(255,255,255,.16); }
        .jtv-dashboard-stats { display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); gap: 14px; margin-bottom: 20px; }
        .jtv-dashboard-stat { display: flex; align-items: center; gap: 11px; min-width: 0; padding: 14px 12px; border: 1px solid #e2ebe6; border-radius: 10px; color: #173c2d !important; background: #fff; box-shadow: 0 3px 12px rgba(10, 61, 42, .06); text-decoration: none !important; transition: transform .2s, box-shadow .2s; }
        .jtv-dashboard-stat:hover { transform: translateY(-3px); box-shadow: 0 8px 18px rgba(10, 61, 42, .12); }
        .jtv-stat-icon { display: grid; flex: 0 0 42px; width: 42px; height: 42px; place-items: center; border-radius: 9px; color: #fff; font-size: 18px; }
        .jtv-dashboard-stat > span:last-child { display: block; min-width: 0; }
        .jtv-dashboard-stat small, .jtv-dashboard-stat strong, .jtv-dashboard-stat em { display: block; }
        .jtv-dashboard-stat small { color: #60776b; font-size: 11px; font-weight: 700; }
        .jtv-dashboard-stat strong { margin: 1px 0; color: #123a2a; font-size: 22px; line-height: 1.1; }
        .jtv-dashboard-stat em { overflow: hidden; color: #91a099; font-size: 9px; font-style: normal; white-space: nowrap; text-overflow: ellipsis; }
        .jtv-dashboard-stat em i { color: #0a8b52; }
        .stat-green .jtv-stat-icon { background: #07935a; } .stat-red .jtv-stat-icon { background: #e63946; } .stat-teal .jtv-stat-icon { background: #168d84; } .stat-orange .jtv-stat-icon { background: #efa912; } .stat-purple .jtv-stat-icon { background: #7352d5; } .stat-blue .jtv-stat-icon { background: #2d7dd2; } .stat-violet .jtv-stat-icon { background: #9b4bd2; }
        .jtv-dashboard-columns { display: grid; grid-template-columns: minmax(0, 1.55fr) minmax(330px, .85fr); gap: 16px; }
        .jtv-dashboard-panel { overflow: hidden; border: 1px solid #e0eae5; border-radius: 12px; background: #fff; box-shadow: 0 3px 12px rgba(10, 61, 42, .05); }
        .jtv-panel-heading { display: flex; align-items: center; justify-content: space-between; min-height: 54px; padding: 0 18px; border-bottom: 1px solid #edf2ef; }
        .jtv-panel-heading h3 { margin: 0; color: #174936; font-size: 16px; font-weight: 800; }
        .jtv-panel-heading h3 i { margin-right: 7px; color: #087849; }
        .jtv-panel-heading a { color: #d71e27; font-size: 11px; font-weight: 800; text-decoration: none; }
        .jtv-recent-item { display: flex; align-items: center; gap: 12px; padding: 12px 18px; border-bottom: 1px solid #f0f4f2; color: inherit !important; text-decoration: none !important; }
        .jtv-recent-item:last-child { border-bottom: 0; }
        .jtv-recent-item:hover { background: #f8fbf9; }
        .jtv-recent-thumb { display: grid; flex: 0 0 46px; width: 46px; height: 46px; place-items: center; border-radius: 7px; color: #087849; background: #e4f3ec; font-size: 18px; }
        .jtv-recent-copy { display: block; min-width: 0; flex: 1; }
        .jtv-recent-copy strong, .jtv-recent-copy small { display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .jtv-recent-copy strong { color: #254b3b; font-size: 13px; }
        .jtv-recent-copy small { margin-top: 4px; color: #91a099; font-size: 10px; }
        .jtv-recent-copy small i { color: #d71e27; margin-right: 3px; } .jtv-recent-copy small span { margin: 0 5px; }
        .jtv-recent-arrow { color: #afbeb7; font-size: 11px; }
        .jtv-empty-state { padding: 30px 18px; color: #8a9a92; text-align: center; font-size: 13px; }
        .jtv-quick-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; padding: 14px; }
        .jtv-quick-grid a { display: flex; align-items: center; gap: 9px; padding: 14px 11px; border: 1px solid #e7efea; border-radius: 8px; color: #315646 !important; background: #fbfdfc; font-size: 11px; font-weight: 700; text-decoration: none !important; }
        .jtv-quick-grid a:hover { border-color: #b4dbc8; background: #effaf4; }
        .jtv-quick-grid i { display: grid; width: 28px; height: 28px; place-items: center; border-radius: 6px; color: #fff; background: #087849; }
        @media (max-width: 1200px) { .jtv-dashboard-stats { grid-template-columns: repeat(4, minmax(0, 1fr)); } }
        @media (max-width: 767px) { body:has(.jtv-admin-dashboard) .content { padding: 15px 10px 25px; } .jtv-dashboard-welcome { align-items: flex-start; flex-direction: column; padding: 20px; } .jtv-dashboard-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 9px; } .jtv-dashboard-stat { padding: 11px 9px; } .jtv-dashboard-columns { grid-template-columns: 1fr; } }
    </style>
@endpush

@push('js')
    @include('layouts.partials._switch_lang')
    @include('admin.analytics._script')
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
