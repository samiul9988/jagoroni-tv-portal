@extends('adminlte::page')

@section('title', __('title.edit_translation'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.edit_translation') }}" currentActive="{{ __('edit') }}" :addLink="[ __('title.translations') => route('translations.index')]"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <form action="{{ route('translations.update', [$translation->id]) }}" method="POST" role="form">
    @method('PUT')
    @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="string">{{ __('form.key') }}</label>
                            <input type="text" name="key" class="form-control @error('key') is-invalid @enderror"
                                   id="string" placeholder="{{ __('localization.placeholder_key') }}" value="{{ old('key', $translation->key) }}" disabled>
                            @error('key')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="string">{{ __('form.text') }}</label>
                            @foreach($text as $index => $value)
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text">{{ strtoupper($index) }}</div>
                                <input type="text" name="text[{{ $index }}]" class="form-control" placeholder="{{ __('localization.placeholder_text') }}" value="{{ old('translation', $value) }}">
                            </div>
                            @error('translation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('translations.index') }}" class="btn btn-warning">{{ __('button.back') }}</a>
                        <button type="submit" class="btn btn-primary float-right">{{ __('button.save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@push('js')
    @include('layouts.partials._notification')
    @include('layouts.partials._switch_lang')
    @include('admin.translations._script')
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
