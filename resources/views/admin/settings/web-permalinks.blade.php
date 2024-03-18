@extends('adminlte::page')

@section('title', __('Web Contact'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.web_permalinks') }}" currentActive="{{ __('title.web_permalinks') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Select2', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.IcheckBootstrap', true)

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form id="form-web-permalinks" action="{{ route('settings.update') }}" method="POST" role="form">
                    @method('PATCH')
                    @csrf
                    <h5>{{  __('form.post_permalinks') }}</h5>
                    <hr>
                    <div class="form-group">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="postname" name="permalink_type" value="post_name" {{ config('settings.permalink') === 'post_name' ? 'checked' : '' }}>
                            <label for="postname">
                                {{ __('form.post_name') }}
                            </label>
                            <code>{{ url('/') }}/sample-post</code>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="dayandname" name="permalink_type" value="%year%/%month%/%day%" {{ config('settings.permalink') === '%year%/%month%/%day%' ? 'checked' : '' }}>
                            <label for="dayandname">
                                {{ __('form.day_and_name') }}
                            </label>
                            <code>{{ url('/') }}/{{ now()->year }}/{{ now()->month }}/{{ now()->day }}/sample-post</code>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="monthandname" name="permalink_type" value="%year%/%month%" {{ config('settings.permalink') === '%year%/%month%' ? 'checked' : '' }}>
                            <label for="monthandname">
                                {{ __('form.month_and_name') }}
                            </label>
                            <code>{{ url('/') }}/{{ now()->year }}/{{ now()->month }}/sample-post</code>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="custom" name="permalink_type" value="custom" {{ config('settings.permalink_type') === 'custom' ? 'checked' : '' }}>
                            <label for="custom" style="line-height: inherit">
                                {{ __('form.custom') }}
                            </label>
                            <code>{{ url('/') }}/</code>
                            @if(config('settings.permalink_type') == 'custom')
                                <input type="text" class="form-control-custom" value="{{ config('settings.permalink') }}" name="custom_input">
                            @else
                                <input type="text" class="form-control-custom" value="{{ config('settings.permalink_old_custom') }}" name="custom_input">
                            @endif

                            <code>/sample-post</code>
                        </div>
                    </div>

                    <div class="row mt-3">&nbsp;</div>

                    <h5>{{ __('form.page_permalinks') }}</h5>
                    <hr>
                    <div class="form-group">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="pagename" name="page_permalink_type" value="page_name" {{ config('settings.page_permalink_type') === 'page_name' ? 'checked' : '' }}>
                            <label for="pagename">
                                {{ __('form.page_name') }}
                            </label>
                            <code>{{ url('/') }}/sample-page</code>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="withprefix" name="page_permalink_type" value="with_prefix" {{ config('settings.page_permalink_type') === 'with_prefix' ? 'checked' : '' }}>
                            <label for="withprefix">
                                {{ __('form.with_prefix') }}
                            </label>
                            <code>{{ url('/') }}/page/sample-page</code> 
                        </div>
                    </div>

                    <div class="row mt-3">&nbsp;</div>
                    <h5>{{ __('form.category_permalinks') }}</h5>
                    <hr>
                    <div class="form-group">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="categoryname" name="category_permalink_type" value="category_name" {{ config('settings.category_permalink_type') === 'category_name' ? 'checked' : '' }}>
                            <label for="categoryname">
                                {{ __('form.category_name') }}
                            </label>
                            <code>{{ url('/') }}/sample-category</code>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="withprefixcategory" name="category_permalink_type" value="with_prefix_category" {{ config('settings.category_permalink_type') === 'with_prefix_category' ? 'checked' : '' }}>
                            <label for="withprefixcategory">
                                {{ __('form.with_prefix') }}
                            </label>
                            <code>{{ url('/') }}/category/sample-category</code>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('css')
    @include('admin.settings._style')
@endpush

@push('js')
    @include('layouts.partials._notification')
    @include('layouts.partials._switch_lang')
    @include('layouts.partials._csrf-token')
    @include('admin.languages._languages')
    <script>
        "use strict";

        // SET PERMALINKS **
        function setConfig() {
            let obj = $(this),
            value = $(this).val(),
            key = $(this).attr('name');
            $(this).closest('.icheck-primary').append('<div class="spinner-grow spinner-grow-sm" role="status"><span class="sr-only">Loading...</span></div>');

            let data;
            if (value == 'custom') {
                data = {
                    "key": key,
                    "value": value,
                    "custom": $(this).closest('.icheck-primary').find('.form-control-custom').val()
                }
            } else {
                data = {
                    "key": key,
                    "value": value
                }
            }
            
            $.ajax({
                type: "PATCH",
                dataType: "json",
                url: "/admin/settings/set-config",
                data: data
            })
            .done(function(data) {
                obj.closest('.icheck-primary').children('div.spinner-grow').remove();

                if(data.info) {
                    toastr.info(data.info);
                } else if(data.success){
                    toastr.success(data.success);
                }else{
                    toastr.error(data.abort);
                }
            })
        }

        $(document).on("click", "input[name=page_permalink_type]", setConfig);
        $(document).on("click", "input[name=category_permalink_type]", setConfig);
        $(document).on("click", "input[name=permalink_type]", setConfig);

        $('.form-control-custom').blur(function (e) {
            const isPrefixCustom = $('#custom').is(':checked');

            if ( isPrefixCustom ) {
                let value = $('.form-control-custom').val(),
                data = {
                    "key": 'permalink',
                    "value": value
                }

                $('.form-control-custom').closest('.icheck-primary').append('<div class="spinner-grow spinner-grow-sm" role="status"><span class="sr-only">Loading...</span></div>');

                $.ajax({
                    type: "PATCH",
                    dataType: "json",
                    url: "/admin/settings/set-config",
                    data: data
                })
                .done(function(data) {
                    $('.form-control-custom').closest('.icheck-primary').children('div.spinner-grow').remove();

                    if(data.info) {
                        toastr.info(data.info);
                    } else if(data.success){
                        toastr.success(data.success);
                    }else{
                        toastr.error(data.abort);
                    }
                })
            }
        })
        // END SET PERMALINKS **
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop