@extends('adminlte::page')

@section('title', __('title.file_manager'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.file_manager') }}" currentActive="{{ __('title.file_manager') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Datatables', true)
@section('plugins.FileManager', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
<div class="row">
    <div class="col-md-12">
        <div id="fm" style="height: 600px"></div>
    </div>
</div>
@stop

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
@endpush

@include('layouts.partials._dark-css')

@push('js')
@include('layouts.partials._switch_lang')
@endpush

@section('footer')
@include('layouts.partials._footer')
@stop
