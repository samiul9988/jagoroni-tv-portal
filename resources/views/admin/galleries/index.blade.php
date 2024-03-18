@extends('adminlte::page')

@section('title', __('title.galleries'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('plugins.Flag', true)
@section('plugins.Datatables', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
    <x-breadcrumbs title="{{ __('title.galleries') }}" currentActive="{{ __('title.galleries') }}"/>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.galleries._create')
            @include('layouts.partials._table')
        </div>
    </div>
@stop

@push('js')
    @include('layouts.partials._datatables')
    @include('layouts.partials._switch_lang')
    @include('layouts.partials._notification')

    @if($errors->has('file'))
        <script>
            toastr.error("{{ $errors->first('file') }}")
        </script>
    @endif
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
