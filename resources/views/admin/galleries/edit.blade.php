@extends('adminlte::page')

@section('title', __('title.edit_gallery'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.edit_gallery') }}" currentActive="{{ __('title.edit') }}" :addLink="[__('title.galleries') => route('galleries.index')]" />
@stop

@section('plugins.Flag', true)
@section('plugins.Datatables', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default">
                <form action="{{route('galleries.update', [$gallery->id])}}" method="POST" role="form">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">{{ __('form.title') }}</label>
                            <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" placeholder="{{ __('form.placeholder_title') }}" required autofocus value="{{ $gallery->post_title }}">
                            @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <img src="{{ $image }}" alt="" class="w-100">
                        </div>

                        <div class="form-group">
                            <label for="alt_text">{{ __('form.alternative_text') }}</label>
                            <input type="text" name="alt_text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="alt_text" placeholder="{{ __('form.placeholder_alternative_text') }}" value="{{ $meta->attr_image_alt }}">
                            @if ($errors->has('alt_text'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('alt_text') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('form.description') }}</label>
                            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" rows="3" name="description" placeholder="{{ __('form.placeholder_description') }}">{{ strip_tags($gallery->post_content) }}</textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">{{ __('button.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('title.file_information') }}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        {{ __('form.uploaded_on') }}: <strong>{{ $gallery->created_at }}</strong>
                    </div>
                    <div class="form-group">
                        <label>{{ __('form.file_url') }}</label>
                        <input type="text" class="form-control" value="{{ $gallery->post_guid }}" readonly>
                    </div>
                    <div class="form-group">
                        {{ __('form.file_name') }}: <strong>{{ $meta->file }}</strong>
                    </div>
                    <div class="form-group">
                        {{ __('form.file_type') }}: <strong>{{ $meta->type }}</strong>
                    </div>
                    <div class="form-group">
                        {{ __('form.file_size') }}: <strong>{{ $meta->size }}</strong>
                    </div>
                    <div class="form-group">
                        {{ __('form.dimension') }}: <strong>{{ $meta->dimension }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    @include('layouts.partials._notification')
    @include('layouts.partials._switch_lang')
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
