@extends('adminlte::page')

@section('title', __('title.change_password'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.change_password') }}" currentActive="{{ __('title.change_password') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.ShowHidePassword', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <form action="{{ route('auth.password.update') }}" method="POST" role="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="old_password">{{ __('form.old_password') }}</label>
                            <div class="input-group">
                                <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" autofocus>
                                <div class="input-group-append old_password">
                                    <div class="input-group-text">
                                        <span class="fas fa-eye"></span>
                                    </div>
                                </div>
                                @error('old_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new_password">{{ __('form.new_password') }}</label>
                            <div class="input-group">
                                <input id="new_password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password">
                                <div class="input-group-append password">
                                    <div class="input-group-text">
                                        <span class="fas fa-eye"></span>
                                    </div>
                                </div>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{ __('form.confirm_password') }}</label>
                            <div class="input-group">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                                <div class="input-group-append password_confirmation">
                                    <div class="input-group-text">
                                        <span class="fas fa-eye"></span>
                                    </div>
                                </div>
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">{{ __('button.change_password_submit') }}</button>
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
