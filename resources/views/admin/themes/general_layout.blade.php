@extends('adminlte::page')

@section('title', __('title.general_layout'))

@inject('utlHelper', 'App\Helpers\UtlHelper')

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.theme') }} : {{ $utlHelper->headline($themes->theme) }}"
                   currentActive="{{ $utlHelper->headline($themes->theme) }}"
                   :addLink="[
                   __('title.themes') => route('themes.index')
    ]"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Datatables', true)
@section('plugins.BootstrapSwitch', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Page</h2>
                    <div class="card-tools">
                        <a href="{{ route('theme.pages', config('settings.current_theme')) }}" class="btn btn-sm btn-warning link-edit"><i class="fas fa-pencil-alt"></i></a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Sidebar</h2>
                    <div class="card-tools">
                        <div class="custom-control custom-switch d-inline align-middle mr-2">
                            <input data-name="sidebar" data-title="Sidebar" data-layout="sidebar" id="sidebar" type="checkbox" class="toggle-class custom-control-input" @if($settings->sidebar['config']['active'] == 'true') checked @endif>
                            <label class="custom-control-label" for="sidebar">{{ __('form.visible') }}</label>
                        </div>
                        @php $hidden = ($settings->sidebar['config']['active'] == 'false' ? 'hidden' : '') @endphp
                        <button type="button" class="btn btn-sm btn-default position-select" {{ $hidden }}>
                            @if($settings->sidebar['config']['position']  == 'right')
                                <i class="fas fa-align-right"></i>
                            @elseif($settings->sidebar['config']['position']  == 'left')
                                <i class="fas fa-align-left"></i>
                            @else
                                <i class="fa-solid fa-ban"></i>
                            @endif
                        </button>
                        <a href="{{ route('theme.setgenerallayout', ['theme'=> 'magz', 'layout'=>'sidebar']) }}" class="btn btn-sm btn-warning link-edit"><i class="fas fa-pencil-alt"></i></a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Footer</h2>
                    <div class="card-tools">
                        <div class="custom-control custom-switch d-inline align-middle mr-2">
                            <input data-name="footer" data-title="Footer" data-layout="footer" id="footer" type="checkbox" class="toggle-class custom-control-input" @if($settings->footer['config']['active'] == 'true') checked @endif>
                            <label class="custom-control-label" for="footer">{{ __('form.visible') }}</label>
                        </div> 
                        <a href="{{ route('theme.setgenerallayout', ['theme'=> 'magz', 'layout'=>'footer']) }}" class="btn btn-sm btn-warning link-edit"><i class="fas fa-pencil-alt"></i></a>
                    </div>
                </div>
            </div>
            <a href="{{ route('theme.pages', $themes->theme) }}" class="btn btn-warning mt-5">{{ __('button.back') }}</a>
        </div>
    </div>
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
