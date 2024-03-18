@extends('adminlte::page')

@section('title', __('title.dashboard'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <h1>{{ __('title.dashboard') }}</h1>
@stop

@section('plugins.Flag', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        @can('read-posts')
            <div class="col-12 col-sm-6 col-md-3">
                <a class="link-info-box" href="{{ route('posts.index') }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('title.posts') }}</span>
                            <span class="info-box-number">{{ $count->post }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('read-pages')
            <div class="col-12 col-sm-6 col-md-3">
                <a class="link-info-box" href="{{ route('pages.index') }}">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-copy"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('title.pages') }}</span>
                            <span class="info-box-number">{{ $count->page }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        <div class="clearfix hidden-md-up"></div>

        @can('read-categories')
            <div class="col-12 col-sm-6 col-md-3">
                <a class="link-info-box" href="{{ route('categories.index') }}">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tags"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('title.categories') }}</span>
                            <span class="info-box-number">{{ $count->category }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('read-tags')
            <div class="col-12 col-sm-6 col-md-3">
                <a class="link-info-box" href="{{ route('tags.index') }}">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-thumbtack"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('title.tags') }}</span>
                            <span class="info-box-number">{{ $count->tag }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('read-users')
            <div class="col-12 col-sm-6 col-md-3">
                <a class="link-info-box" href="{{ route('users.index') }}">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-indigo elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('title.users') }}</span>
                            <span class="info-box-number">{{ $count->user }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('read-roles')
            <div class="col-12 col-sm-6 col-md-3">
                <a class="link-info-box" href="{{ route('roles.index') }}">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-fuchsia elevation-1"><i class="fas fa-user-shield"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('title.roles') }}</span>
                            <span class="info-box-number">{{ $count->role }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('read-contacts')
            <div class="col-12 col-sm-6 col-md-3">
                <a class="link-info-box" href="{{ route('contacts.index') }}">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-olive elevation-1"><i class="fas fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('title.contacts') }}</span>
                            <span class="info-box-number">{{ $count->contact }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('read-galleries')
            <div class="col-12 col-sm-6 col-md-3">
                <a class="link-info-box" href="{{ route('galleries.index') }}">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-hdd"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('title.galleries') }}</span>
                            <span class="info-box-number">{{ $count->gallery }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
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
@stop

@push('css')
    <style>
        .card {box-shadow: none;border: 1px solid rgba(0, 0, 0, .125);} .link-info-box {color: #000;}
    </style>
@endpush

@push('js')
    @include('layouts.partials._switch_lang')
    @include('admin.analytics._script')
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
