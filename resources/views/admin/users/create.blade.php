@extends('adminlte::page')

@section('title', __('title.add_new_user'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.add_new_user') }}" currentActive="{{ __('title.add_new') }}"
                   :addLink="[__('title.users') => route('users.index')]"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Croppie', true)
@section('plugins.Select2', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.IconPicker', true)
@section('plugins.ColorPicker', true)
@section('plugins.ShowHidePassword', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <form id="user" action="{{ route('users.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="role">{{ __('form.role') }}</label>
                            <select id="role" name="role" class="form-control @error('roles')is-invalid @enderror" data-placeholder="{{ __('form.placeholder_role') }}.." style="width: 100%;" required>
                                @foreach( $roles as $role )
                                    @if( $role->name == $roleSelected)
                                        <option value="{{ $role->name }}" selected>{{ $role->name }}</option>
                                    @else
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endif  
                                @endforeach
                            </select>
                            @error('roles')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('form.name') }}</label>
                            <input id="name" type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('form.placeholder_name') }}" value="{{ old('name') }}" required autofocus>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">{{ __('form.username') }}</label>
                            <input id="username" type="text" name="username"
                                   class="form-control @error('username') is-invalid @enderror" placeholder="{{ __('form.placeholder_username') }}" value="{{ old('username') }}" required>
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('form.email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" placeholder="{{ __('form.placeholder_email') }}" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('form.password') }}</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('form.placeholder_password') }}" required autocomplete="new-password">
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
                            <small id="passwordlHelp" class="form-text text-muted">{{ __('form.help_password') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">{{ __('form.confirm_password') }}</label>
                            <div class="input-group">
                                <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                       placeholder="{{ __('form.placeholder_confirm_password') }}" required autocomplete="new-password">
                                <div class="input-group-append password_confirmation">
                                    <div class="input-group-text">
                                        <span class="fas fa-eye"></span>
                                    </div>
                                </div>
                            </div>
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">{{ __('button.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('admin.settings._link-modal')
@stop

@push('css')
    @include('admin.users._style')
@endpush

@push('js')
    @include('layouts.partials._notification')
    @include('layouts.partials._switch_lang')
    @include('admin.users._script')
    <script>
        "use strict";

        $(".upload-msg").on("click", function () {
            $("#upload").trigger("click");
        })

        $("#btn-upload-reset").on("click", function () {
            $('#display').removeAttr('hidden');
            $('#btn-upload-result').attr('hidden');
            $('.upload-photo').removeClass('ready result');
            $("#display-i").html("");
            $('#upload').val("");
            $uploadCrop.croppie("bind", {
                url: ""
            }).then(function () {
            });
        });

        let $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                if (/^image/.test(input.files[0].type)) { // only image file
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        $('.upload-photo').addClass('ready');
                        $uploadCrop.croppie('bind', {
                            url: e.target.result
                        }).then(function () {
                            // console.log('jQuery bind complete');
                        });
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert("You may only select image files");
                }
            } else {
                alert("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        $uploadCrop = $('#display').croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'square'
            },
            boundary: {
                width: 300,
                height: 300
            },
        });

        function popupResult(result) {
            let html = '<img src="' + result.src + '" />';
            $("#display-i").html(html);
        }

        $('#upload').on('change', function () {
            readFile(this);
        });

        $('#btn-upload-result').on('click', function (ev) {
            let fileInput = document.getElementById('upload');
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $('input[name=image_base64]').val(resp);
                $('#btn-upload-result').attr('hidden', 'hidden');
                $('#display').attr('hidden', 'hidden');
                $('.upload-photo').addClass('result');
                popupResult({
                    src: resp
                });
            });
        });
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
