@php($package='env-editor')
@php($translatePrefix='env-editor::env-editor.')

@extends(config("$package.layout"))

@section('title', __('Env-editor'))

@section('content_header')
    <x-breadcrumbs title="{{ __('Env-editor') }}" currentActive="{{ __('Env-editor') }}"/>
@stop

@section('adminlte_js_pre')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@stop

@section('plugins.Axios', true)

@section('content')
    <div id="env-editor">
        <div id="env-alerts"></div>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#current-env" role="tab">{{__($translatePrefix.'views.tabTitles.currentEnv')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#backup-env" role="tab">{{__($translatePrefix.'views.tabTitles.backup')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#upload-env" role="tab">{{__($translatePrefix.'views.tabTitles.upload')}}</a>
            </li>
            <li class="nav-item ml-auto">
                <env-editor-config-actions></env-editor-config-actions>
            </li>
        </ul>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active p-3" id="current-env" role="tabpanel" aria-labelledby="nav-home-tab">
                <env-main-tab></env-main-tab>
            </div>
            <div class="tab-pane fade p-3" id="backup-env" role="tabpanel" aria-labelledby="nav-profile-tab">
                <env-editor-backups></env-editor-backups>
            </div>
            <div class="tab-pane fade p-3" id="upload-env" role="tabpanel" aria-labelledby="nav-contact-tab">
                <env-file-upload></env-file-upload>
            </div>
        </div>

        <env-keys-modal ref="keysModal"></env-keys-modal>
    </div>
@stop

@include('env-editor::components._itemModal')
@include('env-editor::components._currentEnv')
@include('env-editor::components._upload')
@include('env-editor::components._backup')
@include('env-editor::components._configActions')

@push('css')
    <style>
        .content-wrapper {
            min-height: 100%;
            height: auto !important;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('vendor/vue/vue.min.js') }}"></script>
    @stack('scripts')
<script>
    window.envEventBus = new Vue();
    const envAlert = ($type, $text) => {
        let alert =
            '<div id="__id__" class="alert alert-__type__ alert-dismissible fade show" role="alert">' +
            '  <div>__text__</div>' +
            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '    <span aria-hidden="true">&times;</span>' +
            '  </button>' +
            '</div>';
        let $id = 'env-alert_' + Date.now();
        let $html = alert.replace('__type__', $type).replace('__text__', $text).replace('__id__', $id);
        $('#env-alerts').append($html);
        setTimeout(() => {
            $('#' + $id).alert('close')
        }, 3000)

    };

    const dotEnv = new Vue({
        el: '#env-editor',
        components: {
            'env-main-tab': itemsWrapper,
            'env-keys-modal': itemsModal,
            'env-file-upload': fileUpload,
            'env-editor-backups': backUps,
            'env-editor-config-actions': configActions
        }
    })
</script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop

