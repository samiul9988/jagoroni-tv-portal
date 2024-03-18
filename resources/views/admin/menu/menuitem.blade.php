@extends('adminlte::page')

@section('title', __('title.menu_items'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.menu') }}" currentActive="{{ __('title.menu') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Nestable', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.menu._select-menu')
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            @include('admin.menu._createitem')
        </div>
        <div class="col-md-8">
            @include('admin.menu._menu-structure')
        </div>
    </div>
@stop

@push('css')
    @include('admin.menu._style')
@endpush

@push('js')
    @include('layouts.partials._notification')
    @include('layouts.partials._switch_lang')
    @include('admin.menu._script')
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
