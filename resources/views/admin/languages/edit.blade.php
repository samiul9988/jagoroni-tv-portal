@extends('adminlte::page')

@section('title', __('title.edit_language'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.edit_language') }}" currentActive="{{ __('title.edit') }}" :addLink="[__('title.languages') => route('languages.index')]"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <form action="{{ route('languages.update', [$language]) }}" method="POST" role="form">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="language">{{ __('form.language') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text">{{ strtoupper($language->language) }}</div>
                                <input type="text" name="language" class="form-control{{ $errors->has('language') ? ' is-invalid' : '' }}" id="name" placeholder="{{ __('form.placeholder_language') }}" required value="{{ $language->name }}">
                           @error('language')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="country">{{ __('form.country') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/flags/4x3/'.strtolower($language->country_code).'.svg') }}" width="25">
                            </span>
                                </div>
                                <input type="text" class="form-control" aria-describedby="basic-addon1" value="{{ $language->country }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-right">{{ __('button.update') }}</button>
                        <a href="{{ route('languages.index') }}" class="btn btn-warning">{{ __('button.back') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@include('layouts.partials._dark-css')

@section('adminlte_js')
    @include('layouts.partials._notification')
    @include('layouts.partials._switch_lang')
    @include('admin.languages._countries')
@stop

@section('footer')
    @include('layouts.partials._footer')
@stop
