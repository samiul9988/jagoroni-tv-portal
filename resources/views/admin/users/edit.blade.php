@extends('adminlte::page')

@section('title', __('title.edit_users'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.edit_users') }}" currentActive="{{ __('title.edit') }}"
                   :addLink="[__('title.users') => route('users.index')]"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Croppie', true)
@section('plugins.Select2', true)
@section('plugins.BootstrapSwitch', true)
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
                <form action="{{ route('users.update',[$user->id]) }}" method="POST" role="form"
                      enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="userName">{{ __('form.role') }}</label>
                            <select id="role" name="role" class="form-control @error('roles')is-invalid @enderror" data-placeholder="Select Role" style="width: 100%;" required>
                                @foreach( $roles as $role )
                                    @if($role->name == $user->roles->first()->name)
                                        <option value="{{ $role->name }}" selected="selected">{{ $role->name }}</option>
                                    @else
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userName">{{ __('form.name') }}</label>
                            <input id="userName" type="text" name="name"
                                   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   value="{{ $user->name }}" placeholder="{{ __('form.placeholder_name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="username">{{ __('form.username') }}</label>
                            <input id="username" type="text" name="username"
                                   class="form-control @error('username') is-invalid @enderror" placeholder="{{ __('form.placeholder_username') }}" value="{{ $user->username }}" required>
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('form.email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('form.placeholder_email') }}" value="{{ $user->email }}" required autocomplete="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('form.change_password') }}</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('form.placeholder_change_password') }}" autocomplete="new-password">
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
                                       placeholder="{{ __('form.placeholder_confirm_password') }}" autocomplete="new-password">
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
                        @if(Auth::id() != $user->id)
                        <div class="form-group">
                            <label for="status">{{ __('form.status') }}</label>
                            <div>
                                @php 
                                $checked = ($user->isBanned()) ? '' : 'checked';
                                @endphp
                                <input type="checkbox" name="status" {{ $checked }} data-bootstrap-switch data-off-color="danger" data-on-color="success" data-off-text="{{__('form.status_deactivated')}}" data-on-text="{{__('form.status_activated')}}">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">{{ __('button.update') }}</button>
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

        $('.upload-msg').on("click", function() {
            $('#btn-remove').attr('hidden', 'hidden');
            $('#btn-upload-result').removeAttr('hidden');
            $('#btn-upload-reset').removeAttr('hidden');
            $('#upload').trigger("click");
        });

        $('#btn-upload-reset, #btn-remove').on("click", function() {
            $('#btn-remove').attr('hidden', 'hidden');
            $('#display').removeAttr('hidden');
            $('#btn-upload-result').removeAttr('hidden');
            $('#btn-upload-reset').removeAttr('hidden');
            $('.upload-photo').removeClass('ready result');
            $("#display-i").html('');
            $('#upload').val('');
            $('input[name=isupload]').val("remove");
        });

        let $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                if (/^image/.test(input.files[0].type)) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $('.upload-photo').addClass('ready');
                        $('input[name=isupload]').val("true");
                        $uploadCrop.croppie('bind', {
                            url: e.target.result
                        }).then(function() {
                            // console.log('jQuery bind complete');
                        });
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert("__('You may only select image files')");
                }
            } else {
                alert("__('Sorry - you're browser doesn't support the FileReader API')");
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

        $('#upload').on('change', function() {
            readFile(this);
        });

        $('#btn-upload-result').on('click', function(ev) {
            let fileInput = document.getElementById('upload');
            let fileName = fileInput.files[0].name;
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {
                $('#btn-upload-result').attr('hidden', 'hidden');
                $('#display').attr('hidden', 'hidden');
                $('.upload-photo').addClass('result');
                $('input[name=image_base64]').val(resp);
                popupResult({
                    src: resp
                });
            });
        });

        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
