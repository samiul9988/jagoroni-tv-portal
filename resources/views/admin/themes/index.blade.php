@extends('adminlte::page')

@section('title', __('title.themes'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.themes') }}" currentActive="{{ __('title.themes') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Datatables', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">
                        @php $nop = 1; @endphp
                        @foreach($dirs as $dir)
                            <div class="col-md-3 col-sm-4 cover">
                                <figure class="pos-relative mg-b-0">
                                    <img src="{{ asset('themes/'.last(explode('/', $dir)).'/screenshot.png') }}" class="img-fit-cover" alt="" />
                                    <figcaption class="pos-absolute b-0 p-20 d-flex w-100 justify-content-center">
                                        <div class="btn-group hide">
                                            @if (config('settings.current_theme') != Str::slug(\App\Helpers\SettingHelper::getThemeName($dir)))
                                                <button type="button" href="#" class="btn btn-dark btn-icon activate" title="{{__('activate')}}" data-toggle="tooltip" data-placement="top" data-theme="{{ SettingHelper::themeName(SettingHelper::getTheme(last(explode('/', $dir)))) }}" data-themedir="{{ last(explode('/', $dir)) }}"><i class="fas fa-play"></i></button>
                                            @endif
                                            <a href="{{ route('theme.generallayout', config('settings.current_theme')) }}" class="btn btn-dark btn-icon customize" title="{{ __('customize') }}" data-toggle="tooltip" data-placement="{{ __('top') }}"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-dark btn-icon info" title="{{ __('info') }}" data-themedir="{{ last(explode('/', $dir)) }}" data-toggle="tooltip" data-placement="top" data-dir><i class="fas fa-info-circle"></i></button>
                                            @if (config('settings.current_theme') != Str::slug(\App\Helpers\SettingHelper::getThemeName($dir)))
                                                <button type="button" class="btn btn-dark btn-icon" data-delete="" title="{{__('delete')}}" data-toggle="tooltip" data-placement="top"><i class="fas fa-trash-alt"></i></button>
                                            @endif
                                        </div>
                                    </figcaption>
                                </figure>
                                <h5 class="text-center">{{ \App\Helpers\SettingHelper::getThemeName($dir) }}</h5>
                            </div>
                            @php $nop++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="view">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><i class="fas fa-info-circle"></i> {{ __('title.theme_information') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>{{ __('table.name') }}</th>
                            <td class="row1"></td>
                        </tr>
                        <tr>
                            <th>{{ __('table.version') }}</th>
                            <td class="row2"></td>
                        </tr>
                        <tr>
                            <th>{{ __('table.author') }}</th>
                            <td class="row3"></td>
                        </tr>
                        <tr>
                            <th>{{ __('table.author_uri') }}</th>
                            <td class="row4"></td>
                        </tr>
                        <tr>
                            <th>{{ __('table.uri') }}</th>
                            <td class="row5"></td>
                        </tr>
                        <tr>
                            <th>{{ __('table.license') }}</th>
                            <td class="row6"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">{{ __('button.close') }}</button>
                </div>
            </div>
        </div>
    </div>
@stop

@push('css')
    <style>
        .pos-relative {
            position:relative;
        }
        .img-fit-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .pos-absolute {
            position: absolute;
        }
        .btn-group, .btn-group-vertical {
            position: relative;
            display: inline-flex;
            vertical-align: middle;
        }
        .b-0 {
            bottom: 0;
        }
        .p-20 {
            padding: 20px;
        }
         .hide {
             visibility: hidden;
         }
        .cover:hover .hide  {
            visibility: visible;
        }
        [class*="col-"]:not(:last-child){
            margin-bottom: 30px;
        }
    </style>
@endpush

@push('js')
    @include('layouts.partials._switch_lang')
    @if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @endif
    <script>
        $(function () {
            "use strict";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('[data-toggle="tooltip"]').tooltip();

            $(".activate").on("click", function() {
                const theme = $(this).data("theme"),
                themedir = $(this).data("themedir");
                $.ajax({
                    data: {
                        "theme": theme,
                        "theme_dir": themedir,
                    },
                    type: "PATCH",
                    url: "{{ route('theme.activated') }}",
                    cache: false,
                    success: function(response) {
                        location.reload();
                    }
                });
            })

            $(".info").on("click", function() {
                const theme_name = $(this).data('themedir');
                $.ajax({
                    url: "{{ route('theme') }}",
                    method: 'GET',
                    data: {'theme': theme_name},
                    success: function(resp) {
                        $('.row1').html(resp.theme_name);
                        $('.row2').html(resp.version);
                        $('.row3').html(resp.author);
                        $('.row4').html(resp.author_uri);
                        $('.row5').html(resp.theme_uri);
                        $('.row6').html(resp.license);
                        $('#view').modal('show');
                    }
                })
            })
        })
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
