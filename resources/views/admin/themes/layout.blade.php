@extends('adminlte::page')

@section('title', __('title.themes'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ $themes->title }}"
                   currentActive="{{ $themes->title }}"
                   :addLink="[
                   __('title.themes') => route('themes.index'),
                   __('Magz') => route('theme.generallayout', config('settings.current_theme')),
                   __('title.pages') => route('theme.pages', config('settings.current_theme'))
    ]"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Datatables', true)
@section('plugins.BootstrapSwitch', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
@if ($themes->title == 'Contact')
<div class="row">
    <div class="col-md-4">
        <div class="card card-default">
            <form id="form" role="form" method="POST" >
                @method('PUT')
                @csrf
                <div class="card-body">
                    <ul class="list-flags list-inline float-right ml-2 mb-0">
                        @foreach (LocalizationHelper::getListFlags() as $language)
                            @php    
                            $active = ($language->id == Auth::user()->language) ? 'active' : '';
                            @endphp
                            <li class="list-inline-item mr-0 {{ $active }}" data-lang="{{ $language->language }}"><i class="flag-icon flag-icon-{{ Str::lower($language->country_code) }}"></i></li>
                        @endforeach
                    </ul>
                    <div class="form-group">
                        <label for="title">{{ __('form.title') }}</label>
                        <div id="title_el" class="form-group">
                            @php 
                                $data = ThemeHelper::getConfigContact('magz', 'contact', 'body')['config']
                            @endphp
                            @if ($data['title'])
                                @foreach($data['title'] as $lang => $title)
                                    @php $hidden = (LocalizationHelper::getLangCodeById(Auth::user()->language) != $lang) ? 'hidden' : ''; @endphp
                                    <input type="text" class="form-control title input-desc-{{ $lang }}" name="title[{{ $lang }}]" value="{{ $title }}" placeholder="{{ __('form.placeholder_title') }}" {{ $hidden }}>
                                @endforeach
                            @else
                                <input type="text" class="form-control title input-desc-{{ $language->language }}" name="title[{{ $language->language }}]" placeholder="{{ __('form.placeholder_title') }}">';
                            @endif      
                            <div class="invalid-feedback msg-error-title"></div>                      
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url">{{ __('form.url') }}</label>
                        <div id="url_el" class="form-group">
                            @if ($data['url'])
                                @foreach($data['url'] as $lang => $url)
                                    @php $hidden = (LocalizationHelper::getLangCodeById(Auth::user()->language) != $lang) ? 'hidden' : ''; @endphp
                                    <input type="text" class="form-control url input-desc-{{ $lang }}" name="url[{{ $lang }}]" value="{{ $url }}" placeholder="/contact" {{ $hidden }}>
                                @endforeach
                            @else
                                <input type="text" class="form-control url input-desc-{{ $language->language }}" name="url[{{ $language->language }}]" placeholder="/contact">';
                            @endif      
                            <div class="invalid-feedback msg-error-title }}"></div>                      
                        </div>
                        <div class="invalid-feedback msg-error-url }}"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <button id="btn-reset" type="button" class="btn btn-warning" hidden>{{ __('button.cancel') }}</button>
                    <button id="btn-submit" type="button" class="btn btn-info float-right">{{ __('button.save') }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        @foreach($settings as $layout => $setting)
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{ $layout }}</h2>
                    <div class="card-tools">
                        @if($layout == "sidebar" || $layout == "footer")
                            @php 
                                $hideVisible = ($setting['config']['custom'] == 'false' ? 'hidden' : '');
                                $hideActive = ($setting['config']['custom'] == 'false' ? 'hidden' : '');
                                $hideSidebar = ($setting['config']['active'] == 'false' ? 'hidden' : '');
                                $disabled = ($setting['config']['custom'] == 'false' ? 'disabled' : '');
                            @endphp 
                            <div class="custom-control custom-switch d-inline align-middle mr-2">
                                <input data-name="{{ $layout }}" data-title="{{ Str::headline($layout) }}" data-layout="{{ $layout }}" id="custom-{{ $layout}}" type="checkbox" class="toggle-custom custom-control-input" @if($setting['config']['custom'] == 'true') checked @endif>
                                <label class="custom-control-label" for="custom-{{ $layout}}">{{ __('form.custom') }}</label>
                            </div>
                            <span class="control-visible" {{ $hideVisible }}>
                                <div class="custom-control custom-switch d-inline align-middle mr-2">
                                    <input data-name="{{ $layout }}" data-title="{{ Str::headline($layout) }}" data-layout="{{ $layout }}" id="{{ $layout }}" type="checkbox" class="toggle-class custom-control-input" @if($setting['config']['active'] == 'true') checked @endif>
                                    <label class="custom-control-label" for="{{ $layout }}">{{ __('form.visible') }}</label>
                                </div>
                                @if($layout == "sidebar")
                                @php $hidden = ($setting['config']['active'] == 'false' ? 'hidden' : '') @endphp
                                <button type="button" class="btn btn-sm btn-default position-select" {{ $hidden }}>
                                    @if($setting['config']['position']  == 'right')
                                        <i class="fas fa-align-right"></i>
                                    @elseif($setting['config']['position']  == 'left')
                                        <i class="fas fa-align-left"></i>
                                    @else
                                        <i class="fa-solid fa-ban"></i>
                                    @endif
                                </button>
                                @endif
                            </span>
                        @endif
                        
                        <a href="{{ route('theme.widgets', [$themes->theme, $themes->slug, $layout]) }}" class="btn btn-sm btn-warning link-edit"><i class="fas fa-pencil-alt"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<a href="{{ route('theme.pages', $themes->theme) }}" class="btn btn-warning mt-5">{{ __('button.back') }}</a>
@else
    <div class="row">
        <div class="col-md-12">
            @foreach($settings as $layout => $setting)
                @php $hideActive = '' @endphp
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">{{ $layout }}</h2>
                        <div class="card-tools">
                        @if($layout == "sidebar" || $layout == "footer")
                            @php 
                                $hideVisible = ($setting['config']['custom'] == 'false' ? 'hidden' : '');
                                $hideActive = ($setting['config']['custom'] == 'false' ? 'hidden' : '');
                                $hideSidebar = ($setting['config']['active'] == 'false' ? 'hidden' : '');
                                $disabled = ($setting['config']['custom'] == 'false' ? 'disabled' : '');
                            @endphp 
                                <div class="custom-control custom-switch d-inline align-middle mr-2">
                                    <input data-name="{{ $layout }}" data-title="{{ Str::headline($layout) }}" data-layout="{{ $layout }}" id="custom-{{ $layout}}" type="checkbox" class="toggle-custom custom-control-input" @if($setting['config']['custom'] == 'true') checked @endif>
                                    <label class="custom-control-label" for="custom-{{ $layout}}">{{ __('form.custom') }}</label>
                                </div>
                                <span class="control-visible" {{ $hideVisible }}>
                                    <div class="custom-control custom-switch d-inline align-middle mr-2">
                                        <input data-name="{{ $layout }}" data-title="{{ Str::headline($layout) }}" data-layout="{{ $layout }}" id="visible-{{ $layout }}" type="checkbox" class="toggle-class custom-control-input" @if($setting['config']['active'] == 'true') checked @endif>
                                        <label class="custom-control-label" for="visible-{{ $layout }}">{{ __('form.visible') }}</label>
                                    </div>
                                    @if($layout == "sidebar")
                                    <button type="button" class="btn btn-sm btn-default position-select" {{ $hideSidebar }}>
                                        @if($setting['config']['position']  == 'right')
                                            <i class="fas fa-align-right"></i>
                                        @elseif($setting['config']['position']  == 'left')
                                            <i class="fas fa-align-left"></i>
                                        @else
                                            <i class="fa-solid fa-ban"></i>
                                        @endif
                                    </button>
                                    @endif
                                </span>
                        @endif

                            <a href="{{ route('theme.widgets', [$themes->theme, $themes->slug, $layout]) }}" class="btn btn-sm btn-warning link-edit" {{ $hideActive}}><i class="fas fa-pencil-alt"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
            <a href="{{ route('theme.pages', $themes->theme) }}" class="btn btn-warning mt-5">{{ __('button.back') }}</a>
        </div>
    </div>
@endif
@stop

@push('css')
    @include('admin.themes._style')
@endpush

@push('js')
    @include('layouts.partials._notification')
    @include('layouts.partials._switch_lang')
    @include('layouts.partials._csrf-token')
    @include('admin.languages._languages')

    <script>
        // SET CUSTOM **
        $(document).on('change', '.toggle-custom', function () {
            let checked =  $(this).prop("checked") == true ? "true" : "false";

            if (checked == 'false') {
                $(this).closest('.card-tools').find('.control-visible').attr('hidden', true);
                $(this).closest('.card-tools').find('.link-edit').attr('hidden', true);
            } else {
                $(this).closest('.card-tools').find('.control-visible').removeAttr('hidden');
                $(this).closest('.card-tools').find('.link-edit').removeAttr('hidden');
            }

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/admin/change-custom-layout-theme",
                data: {
                    "active": checked,
                    "name": $(this).data("name"),
                    "title": $(this).data("title"),
                    "theme": "{{ $themes->theme }}",
                    "page": "{{ $themes->slug }}",
                    "layout": $(this).data("layout")
                },
                success: function (response) {
                    notification(response)
                },
                error: function (response) {
                    toastr.error(response.responseJSON.message, {timeOut: 5000})
                }
            })
        })
        // END SET CUSTOM....................................................

        // SET VISIBLE **
        $(document).on('change', '.toggle-class', function () {
            let checked =  $(this).prop("checked") == true ? "true" : "false";

            if (checked == 'false') {
                $(this).closest('.card-tools').find('.position-select').attr('hidden', true);
            } else {
                $(this).closest('.card-tools').find('.position-select').removeAttr('hidden');
            }

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/admin/change-visible-layout-theme",
                data: {
                    "active": checked,
                    "name": $(this).data("name"),
                    "title": $(this).data("title"),
                    "theme": "{{ $themes->theme }}",
                    "page": "{{ $themes->slug }}",
                    "layout": $(this).data("layout")
                },
                success: function (response) {
                    notification(response)
                },
                error: function (response) {
                    toastr.error(response.responseJSON.message, {timeOut: 5000})
                }
            })
        })
        // END SET VISIBLE....................................................

        // SET POSITION SIDEBAR **
        $(document).on("click", ".position-select", function(e) {
            $(this).find('.fas').toggleClass('fa-align-right fa-align-left');
            let position = ($(this).find('.fas').hasClass( 'fa-align-right' )) ? 'right' : 'left';

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/admin/change-sidebar-position",
                data: {
                    "position": position,
                    "theme": "{{ $themes->theme }}",
                    "page": "{{ $themes->slug }}"
                },
                success: function(response) {
                    notification(response)

                    $('button.position-select').html('<i class="fas fa-align-'+position+'"></i>')
                },
                error: function(response) {
                    toastr.error(response.responseJSON.message, {timeOut: 5000})
                }
            }) 
        });
        // END SET POSITION SIDEBAR....................................................

        // FLAGS **

        // SELECT FLAG **^
        $(document).on("click", ".list-flags li", function(e) {
            if (!$(this).hasClass('active')) {
                $('.list-flags li.active').removeClass('active');
                $(this).addClass('active');
            }
        });
        // END SELECT FLAG....................................................

        // ACTIVE LANGUAGE TITLE ***
        $(document).on("click", ".list-flags li.list-inline-item", function(e) {
            let lang = $(this).data('lang');

            if (!$(this).hasClass('input-desc-' + lang)) {
                $('#title_el input').attr('hidden', true);
            }

            if ($('#title_el input').hasClass('input-desc-' + lang)) {
                $('#title_el input.input-desc-' + lang).removeAttr('hidden');
            } else {
                $('#title_el').append('<input type="text" class="form-control title input-desc-' + lang + '" name="title[' + lang + ']">');
            }
        });
        // END ACTIVE LANGUAGE TITLE.......................................

        // ACTIVE LANGUAGE URL ***
        $(document).on("click", ".list-flags li.list-inline-item", function(e) {
            let lang = $(this).data('lang');

            if ($('#url_el input').length) {
                if (!$(this).hasClass('input-desc-' + lang)) {
                    $('#url_el input').attr('hidden', true);
                }

                if ($('#url_el input').hasClass('input-desc-' + lang)) {
                    $('#url_el input.input-desc-' + lang).removeAttr('hidden');
                } else {
                    $('#_wm_title_el').append('<input type="text" name="url[' + $lang + ']" class="form-control url input-desc-' + $lang + '"">');
                }
            }
        });
        // END ACTIVE LANGUAGE URL.......................................

        $(document).on("click", "#btn-submit", function(e) {
            e.preventDefault();
            let data = new FormData($('#form')[0]);
            data.append('_method', 'PUT');
            let theme = 'magz';

            console.log(data);

            let url = '{{ route('theme.contact.update', ['theme' => 'magz']) }}'

            $.ajax({
                url: url,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                success: function(response){
                    notification(response);
                    
                    
                },
                error: function(){
                    alert("Error");
                }
            });
        })

    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
