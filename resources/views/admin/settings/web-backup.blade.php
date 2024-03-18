@extends('adminlte::page')

@section('title', __('Web Information'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.web_backup') }}" currentActive="{{ __('title.web_backup') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <div class="form-group">
        <label>{{ __('form.export') }}</label>
        <div>
            <button type="button" id="btn-export" class="btn btn-info">
                <i class="fas fa-file-excel"></i> {{ __('button.download_data') }}
            </button>
            <button type="button" id="btn-export-storage" class="btn btn-info">
                <i class="fas fa-download"></i> {{ __('button.download_backup') }}
            </button>
        </div>
    </div>
    <hr>
    <form id="formUploadImport" action="{{ route('import') }}" method="POST" role="form" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="form-group">
            <label for="">{{ __('form.import') }}</label><br>
            <div class="input-group">
                <div class="custom-file">
                    <input id="InputFileBackup" type="file" name="import" class="custom-file-input" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                    <label class="custom-file-label">{{ __('form.placeholder_import') }}</label>
                </div>
            </div>
            <p>
                <small>
                    {{ __('form.help_import') }}<br>
                </small>
            </p>
        </div>
        <button id="uploadFileBackup" type="submit" class="btn btn-info" disabled>
            {{ __('button.upload') }}
        </button>
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

        $('input[type=file]#InputFileBackup').change(function() {
            if($('input[type=file]#inputFileBackup').val()==''){
                $('button#uploadFileBackup').attr('disabled',true)
            }
            else{
                $('button#uploadFileBackup').attr('disabled',false);
            }
        });

        $(document).on("click", "#btn-export", function(e) {
            e.preventDefault();
            $("#btn-export").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading') }}</span></div> {{ __('message.sending') }}");
            $.ajax({
                url: "{{ route('export') }}",
                method: "GET",
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response){
                    let name = "{{ config('retenvi.app_name') }}";
                    let version = "{{ config('retenvi.version') }}";
                    let ext = ".xlsx";
                    let filename = name + "-v" + version + ext;
                    let blob = new Blob([response]);
                    let link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = filename;
                    link.click();
                    $(".spinner-grow").attr("hidden", true);
                    $("#btn-export").html("<i class='fas fa-file-excel'></i> {{ __('button.download_data') }}");
                }
            });
        })

        $(document).on("click", "#btn-export-storage", function(e) {
            e.preventDefault();
            $("#btn-export-storage").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading') }}</span></div> {{ __('message.sending') }}");
            $.ajax({
                url: "{{ route('export.storage') }}",
                method: "GET",
                cache: false,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response){
                    let name = "{{ config('retenvi.app_name') }}";
                    let version = "{{ config('retenvi.version') }}";
                    let ext = "storage.zip";
                    let filename = name + "-v" + version + "-" + ext;
                    let blob = new Blob([response]);
                    let link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = filename;
                    link.click();
                    $(".spinner-grow").attr("hidden", true);
                    $("#btn-export-storage").html("<i class='fas fa-file-excel'></i> {{ __('button.download_data') }}");
                }
            });
        })

        $(document).on("click", "#uploadFileBackup", function(e) {
            e.preventDefault();
            $("#uploadFileBackup").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading')}}</span></div> {{ __('message.sending') }}");
            let url = $("#formUploadImport").attr("action");
            var form = $('#formUploadImport')[0];
            var data = new FormData(form);
            $.ajax({
                type: 'post',
                processData: false,
                contentType: false,
                enctype: "multipart/form-data",
                url: url,
                data: data,
                success: function(response) {
                    $(".spinner-grow").attr("hidden", true);
                    $("#formUploadImport")[0].reset();
                    $("#uploadFileBackup").html("{{__('button.upload')}}");
                    if (response.errors) {
                        toastr.error(response.errors.import);
                    } else if (response.info) {
                        toastr.info(response.info);
                    } else {
                        toastr.success(response.success);
                    }
                }
            })
        })
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
