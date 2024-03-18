@extends('adminlte::page')

@section('title', __('title.categories'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.categories') }}" currentActive="{{ __('title.categories') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('admin.categories._create')
        </div>
        <div class="col-md-8">
            @include('admin.categories._table')
        </div>
    </div>
@stop

@push('css')
    @include('admin.categories._style')
@endpush

@push('js')
    @include('layouts.partials._datatables')
    @include('layouts.partials._switch_lang')
    @include('layouts.partials._notification')
    @include('admin.categories._script')
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop

