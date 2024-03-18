@extends('adminlte::page')

@section('title', __('title.video_posts'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.video_posts') }}" currentActive="{{ __('title.video_posts') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Datatables', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)


@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.videos._table')
        </div>
    </div>
@stop

@push('js')
    @include('layouts.partials._datatables')
    @include('layouts.partials._switch_lang')
    @include('layouts.partials._notification')
    <script>
        "use strict";
        var items = "";
        $.getJSON("{{ route('getdatalanguage') }}", function (result) {
            $.each(result, function (i, item) {
                if (item.id == "{{ Auth::user()->language }}") {
                    items += "<option value='" + item.id + "' selected>" + item.name + "</option>";
                } else {
                    items += "<option value='" + item.id + "'>" + item.name + "</option>";
                }
            });
            $("#custom-filter").html(items);
        });
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
