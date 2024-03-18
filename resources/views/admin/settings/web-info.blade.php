@extends('adminlte::page')

@section('title', __('title.web_information'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.web_information') }}" currentActive="{{ __('title.web_information') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Codemirror', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-web-information" action="{{ route('settings.webinfo.update') }}" method="POST" role="form">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="company_name">{{ __('form.company_name') }}</label>
                                    <input id="company_name" type="text" name="company_name" class="form-control" placeholder="{{ __('form.placeholder_company_name') }}" value="{{ config('settings.company_name') }}">
                                    <div class="msg-company_name"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="site_name">{{ __('form.web_name') }}</label>
                                    <input id="site_name" type="text" name="site_name" class="form-control" placeholder="{{ __('form.placeholder_web_name') }}" value="{{ config('settings.site_name') }}">
                                    <div class="msg-site_name"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="site_url">{{ __('form.web_url') }}</label>
                                    <input id="site_url" type="text" name="site_url" class="form-control" placeholder="{{ __('form.placeholder_web_url') }}" value="{{ config('settings.site_url') }}">
                                    <div class="msg-site_url"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="site_description">{{ __('form.web_description') }}</label>
                                    <textarea id="site_description" name="site_description" class="form-control" rows="3" placeholder="{{ __('form.placeholder_web_description') }}..">{{ config('settings.site_description') }}</textarea>
                                    <div class="msg-site_description"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="meta_keyword">{{ __('form.web_keyword') }}</label>
                                    <textarea id="meta_keyword" name="meta_keyword" class="form-control" rows="3" placeholder="{{ __('form.placeholder_web_keyword') }}">{{ config('settings.meta_keyword') }}</textarea>
                                    <div class="msg-meta_keyword"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="credit_footer">{{ __('form.credit_footer') }}</label>
                                    <textarea class="form-control" name="credit_footer" id="credit_footer" rows="3">{{ $creditFooter }}</textarea>
                                    <div class="msg-credit_footer"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button id="submit" type="submit" class="btn btn-info float-right">{{ __('button.save') }}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
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
        
        let editor = CodeMirror.fromTextArea(document.getElementById("credit_footer"), {
            mode: "htmlmixed",
            styleActiveLine: true,
            lineNumbers: true,
            lineWrapping: true,
            matchBrackets: true
        });
        editor.setSize(null, 100);
        editor.on('change', (editor) => {
            const text = editor.doc.getValue()
            $('#credit_footer').html(text);
        });
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop























