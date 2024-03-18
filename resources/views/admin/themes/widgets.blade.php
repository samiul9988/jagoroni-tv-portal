@extends('adminlte::page')

@section('title', __('title.theme_pages'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    @if ($slug == 'all')
    <x-breadcrumbs title="{{ __('Layout: '. Str::headline($layout)) }}"
                   currentActive="{{ Str::headline($layout) }}"
                   :addLink="[
                   __('title.themes') => route('themes.index'),
                   __('Magz') => route('theme.generallayout', $themeName),
    ]"/>
    @else
    <x-breadcrumbs title="{{ __('Layout: '. Str::headline($layout)) }}"
                   currentActive="{{ Str::headline($layout) }}"
                   :addLink="[
                   __('title.themes') => route('themes.index'),
                   __('Magz') => route('theme.generallayout', config('settings.current_theme')),
                   Str::headline($pageName) => route('theme.layout', [$themeName, $slug])
    ]"/>
    @endif
@stop

@section('plugins.Flag', true)
@section('plugins.Datatables', true)
@section('plugins.Sortable', true)
@section('plugins.Select2', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="container">
        <input id="language" type="hidden" name="language" value="{{ $language }}">
        @yield('section')
    </div>

    @include('admin.themes.modal._add-widget-modal')
    @include('admin.themes.modal._edit-widget-modal')
@stop

@push('css')
    @include('admin.themes._style')
@endpush

@push('js')
    @include('layouts.partials._notification')
    @include('layouts.partials._switch_lang')
    @include('admin.themes._script')
    @stack('script')
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
