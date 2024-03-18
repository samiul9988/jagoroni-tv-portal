@extends('adminlte::page')

@section('title', __('title.translations'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.translations') }}" currentActive="{{ __('title.add_new') }}" :addLink="[__('title.translations') => route('translations.index')]"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title mr-auto">{{ __('Add a translation') }}</h3>
                </div>
                <form action="{{ route('languages.translations.store', $language) }}" method="POST" role="form" >
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>GROUP (OPTIONAL)</label>
                            <input type="text" class="form-control" name="group" placeholder="e.g. validation">
                        </div>
                        <div class="form-group">
                            <label>KEY</label>
                            <input type="text" class="form-control" name="key" placeholder="e.g. invalid_key">
                        </div>
                        <div class="form-group">
                            <label>VALUE</label>
                            <textarea class="form-control" name="value" placeholder="e.g. Keys must be a single string"></textarea>
                        </div>
                        <div class="form-group">
                            <p>
                                <a data-toggle="collapse" href="#collapseNameSpace" role="button" aria-expanded="false" aria-controls="collapseNameSpace">
                                    Toggle advanced options
                                </a>
                            </p>
                            <div class="collapse" id="collapseNameSpace">
                                <label>NAMESPACE (OPTIONAL)</label>
                                <input type="text" name="namespace" class="form-control" placeholder="e.g. my_package">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-right">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
    @include('layouts.partials._switch_lang')
    @include('layouts.partials._notification')
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
