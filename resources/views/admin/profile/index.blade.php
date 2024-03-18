@extends('adminlte::page')

@section('title', __('title.profile'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.profile') }}" currentActive="{{ __('title.profile') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Select2', true)
@section('plugins.Croppie', true)
@section('plugins.ColorPicker', true)
@section('plugins.IconPicker', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ \App\Helpers\ImageHelper::show('avatar',  Auth::user()->photo, 'img/noavatar.png') }}" alt="">
                            </div>
                            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                            <p class="text-muted text-center">{{ Auth::user()->roles->pluck('name')->implode(', ') }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('title.about_me') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-user-md mr-1"></i>{{ __('form.occupation') }}</strong>
                            <p class="text-muted">
                                {{ $user->occupation }}
                            </p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i>{{ __('form.about') }}</strong>
                            <p class="text-muted">{{  $user->about }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <form class="form-horizontal" action="{{ route('profile.update', [$user->id]) }}" method="POST" role="form" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">{{ __('form.settings') }}</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#photo" data-toggle="tab">{{ __('form.photo') }}</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="settings">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">{{ __('form.name') }}</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control" id="inputName" placeholder="{{ __('form.placeholder_name') }}" value="{{ $user->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputUsername" class="col-sm-2 col-form-label">{{ __('form.username') }}</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="username" class="form-control" id="inputUsername" placeholder="{{ __('form.placeholder_username') }}" value="{{ $user->username }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">{{ __('form.email') }}</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="{{ __('form.placeholder_email') }}" value="{{ $user->email }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputOccupation" class="col-sm-2 col-form-label">{{ __('form.occupation') }}</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="occupation" class="form-control" id="inputOccupation" placeholder="{{ __('form.placeholder_occupation') }}" value="{{ $user->occupation }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputAbout" class="col-sm-2 col-form-label">{{ __('form.about') }}</label>
                                            <div class="col-sm-10">
                                            <textarea class="form-control" name="about" id="inputAbout" placeholder="{{ __('form.placeholder_about') }}">{{ $user->about }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="link" class="col-sm-2 col-form-label">{{ __('form.link') }}</label>
                                            <div class="col-sm-10">
                                                <button type="button" class="btn btn-light btn-sm" id="addLink">{{ __('button.add_link') }}</button>
                                            </div>
                                        </div>
                                        <div class="links">
                                            @if($links)
                                                @foreach($links as $link)
                                                    <div class="form-group row linkItem" id="link{{ $link->id }}">
                                                        <label for="" class="col-sm-2 col-form-label">{{ $link->label }}</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group">
                                                                <input class="linkId" type="hidden" name="links[{{ $link->id }}][id]" value="{{ $link->id }}">
                                                                <input class="linkLabel" type="hidden" name="links[{{ $link->id }}][label]" value="{{ $link->label }}">
                                                                <input class="linkIcon" type="hidden" name="links[{{ $link->id }}][icon]" value="{{ $link->icon }}">
                                                                <input class="linkColor" type="hidden" name="links[{{ $link->id }}][color]" value="{{ $link->color }}">
                                                                <div class="input-group-prepend"><span class="input-group-text"> <i
                                                                            class="{{ $link->icon }}"></i></span></div>
                                                                <input type="text" name="links[{{ $link->id }}][url]"
                                                                    class="form-control bg-link-input" placeholder="http://www.example.com"
                                                                    value="{{ $link->url }}" readonly>
                                                                <div class="input-group-append"
                                                                    onClick="removeInput({{ $link->id }})" style="cursor:pointer"><span
                                                                        class="input-group-text"><i class="fas fa-times"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputRole" class="col-sm-2 col-form-label">{{ __('form.role') }}</label>
                                            <div class="col-sm-10">
                                                <select id="role" name="roles[]" class="select2" multiple="multiple"
                                                        data-placeholder="{{ __('form.select_role') }}" style="width: 100%;" disabled>
                                                    @foreach( $roles as $role )
                                                        <option value="{{ $role->id }}" selected="selected">{{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="photo">
                                        <div class="form-group">
                                            <div class="upload-photo @if($image) ready result @endif">
                                                <input type="file" id="upload" name="image" value="Choose a file {{ __('form.choose_a_file') }}"
                                                       accept="image/*" data-role="none" hidden>
                                                <input type="hidden" name="image_base64">
                                                <input type="hidden" name="isupload">
                                                <div class="col-md-12">
                                                    <div class="upload-msg">{{ __('form.placeholder_photo') }}</div>
                                                    <div id="display" @if($image) hidden @endif></div>
                                                    <div id="display-i" class="mx-auto">
                                                        <img src="{{ $image }}" alt="" style="width:200px">
                                                    </div>
                                                    <div class="buttons text-center">
                                                        <button id="btn-upload-result" type="button"
                                                                class="upload-result btn btn-info" hidden>{{ __('button.use_this_image') }}</button>
                                                        <button id="btn-upload-reset" type="button"
                                                                class="reset btn btn-warning" hidden>{{ __('button.reset') }}</button>
                                                        <button id="btn-remove" type="button" class="reset btn btn-danger"
                                                                @empty($image) hidden @endempty>{{ __('button.remove') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">{{ __('button.update') }}</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->

                @include('admin.settings._link-modal')

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@stop

@push('css')
    @include('admin.profile._style')
@endpush

@push('js')
    @include('layouts.partials._switch_lang')
    @include('layouts.partials._notification')
    @include('admin.profile._script')
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop

