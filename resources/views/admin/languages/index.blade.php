@extends('adminlte::page')

@section('title', __('title.languages'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.languages') }}" currentActive="{{ __('title.languages') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Toggle', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('admin.languages._create')
        </div>
        <div class="col-md-8">
            @include('layouts.partials._table')
        </div>
    </div>
@stop

@include('layouts.partials._dark-css')

@push('js')
    @include('layouts.partials._notification')
    @include('layouts.partials._datatables')
    @include('layouts.partials._switch_lang')
    @include('admin.languages._script')
    @include('admin.languages._languages')
    @include('admin.languages._countries')
    <script>
        $("#language").select2({
            theme: "bootstrap4",
            minimumResultsForSearch: 5,
            data: languages
        });

        $("#country").select2({
            theme: "bootstrap4",
            minimumResultsForSearch: 5,
            data: countries
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
