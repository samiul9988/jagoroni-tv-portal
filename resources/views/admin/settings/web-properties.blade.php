@extends('adminlte::page')

@section('title', __('title.web_contact'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
<x-breadcrumbs title="{{ __('title.web_properties') }}" currentActive="{{ __('title.web_properties') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Select2', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-2">
                <ul id="navTab" class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#logo" data-toggle="tab">{{ __('Logo & Favicon') }}</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#ogi" data-toggle="tab">{{ __('Open Graph Images') }}</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="logo">
                        <div class="row">
                            <!-- Web logo light version -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.web_logo_light_version') }}</label><br>
                                    <div id="show_image_logo_web_light" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.logo_web_light'))
                                            <img id="image_preview_logo_web_light" src="{{ asset('storage/assets/' . config('settings.logo_web_light')) }}" alt="{{ config('settings.logo_web_light') }}" class="w-100 _properties" style="max-width:400px;">
                                            @else 
                                            <img id="image_preview_logo_web_light" src="{{ asset('themes/magz/images/logo-light.webp') }}" alt="logo-light.webp" class="w-100 _properties" style="max-width:400px">
                                            @endif
                                            <button onClick="deleteLogo('logo_web_light')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews1" data-prevcontainer="#dzPreviewContainer_logo_web_light" class="formDropzone dropzone overflow-visible p-0 form_logo_web_light formDropzone_logo_web_light" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="logo_web_light">
                                        <div class="dropzone-drag-area form-control" id="previews1">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_logo_web_light">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_logo_web_light fw-bold"></div>
                                        <small>{{ __('form.help_web_logo_light_version') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('logo_web_light', dropzone)" id="submit_web_logo_light" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('logo_web_light')" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Web logo dark version -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.web_logo_dark_version') }}</label><br>
                                    <div id="show_image_logo_web_dark" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.logo_web_dark'))
                                            <img id="image_preview_logo_web_dark" src="{{ asset('storage/assets/' . config('settings.logo_web_dark')) }}" alt="{{ config('settings.logo_web_dark') }}" class="w-100 _properties" style="max-width:400px;">
                                            @else 
                                            <img id="image_preview_logo_web_dark" src="{{ asset('themes/magz/images/logo.webp') }}" alt="" class="w-100 _properties" style="max-width:400px">
                                            @endif
                                            <button onClick="deleteLogo('logo_web_dark')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>             
                                    <form data-previews="#previews2" data-prevcontainer="#dzPreviewContainer_logo_web_dark" class="formDropzone dropzone overflow-visible p-0 form_logo_web_dark formDropzone_logo_web_dark" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="logo_web_dark">
                                        <div class="dropzone-drag-area form-control" id="previews2">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_logo_web_dark">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_logo_web_dark fw-bold"></div>
                                        <small>{{ __('form.help_web_logo_dark_version') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('logo_web_dark', dropzone)" id="submit_web_logo_dark" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('logo_web_dark')" id="cancel_upload_web_logo_dark" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Favicon -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.favicon') }}</label><br>
                                    <div id="show_image_favicon" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.favicon'))
                                            <img id="image_preview_favicon" src="{{ asset('storage/assets/' . config('settings.favicon')) }}" alt="{{ config('settings.favicon') }}" class="w-100 _properties" style="max-width:100px;">
                                            @else 
                                            <img id="image_preview_favicon" src="{{ asset('favicons/android-chrome-192x192.png') }}" alt="" class="w-100 _properties" style="max-width:100px">
                                            @endif
                                            <button onClick="deleteLogo('favicon')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews3" data-prevcontainer="#dzPreviewContainer_favicon" class="formDropzone dropzone overflow-visible p-0 form_favicon formDropzone_favicon" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="favicon">
                                        <div class="dropzone-drag-area form-control" id="previews3">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_favicon">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_favicon fw-bold"></div>
                                        <small>{{ __('form.help_favicon') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('favicon', dropzone)" id="submit_favicon" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('favicon')" id="cancel_upload_favicon" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Dashboard logo -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.dashboard_logo') }}</label><br>
                                    <div id="show_image_logo_dashboard" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.logo_dashboard'))
                                            <img id="image_preview_logo_dashboard" src="{{ asset('storage/assets/' . config('settings.logo_dashboard')) }}" alt="{{ config('settings.logo_dashboard') }}" class="w-100 _properties" style="max-width:100px;">
                                            @else 
                                            <img id="image_preview_logo_dashboard" src="{{ asset('img/logo.png') }}" alt="" class="w-100 _properties" style="max-width:100px">
                                            @endif
                                            <button onClick="deleteLogo('logo_dashboard')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <form data-previews="#previews4" data-prevcontainer="#dzPreviewContainer_logo_dashboard" class="formDropzone dropzone overflow-visible p-0 form_logo_dashboard formDropzone_logo_dashboard" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="logo_dashboard">
                                        <div class="dropzone-drag-area form-control" id="previews4">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_logo_dashboard">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_logo_dashboard fw-bold"></div>
                                        <small>{{ __('form.help_dashboard_logo') }}</small>
                                        <div class="buttons text-center mt-1">
                                            <button onClick="submitUpload('logo_dashboard', dropzone)" id="submit_logo_dashboard" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('logo_dashboard')" id="cancel_upload_logo_dashboard" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Auth logo -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.auth_logo') }}</label><br>
                                    <div id="show_image_logo_auth" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.logo_auth'))
                                            <img id="image_preview_logo_auth" src="{{ asset('storage/assets/' . config('settings.logo_auth')) }}" alt="{{ config('settings.logo_auth') }}" class="w-100 _properties" style="max-width:100px;">
                                            @else 
                                            <img id="image_preview_logo_auth" src="{{ asset('img/logo-auth.png') }}" alt="" class="w-100 _properties" style="max-width:100px">
                                            @endif
                                            <button onClick="deleteLogo('logo_auth')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews5" data-prevcontainer="#dzPreviewContainer_auth_logo" class="formDropzone dropzone overflow-visible p-0 form_logo_auth formDropzone_logo_auth" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="logo_auth">
                                        <div class="dropzone-drag-area form-control" id="previews5">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_auth_logo">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_logo_auth fw-bold"></div>
                                        <small>{{ __('form.help_auth_logo') }}</small>
                                        <div class="buttons text-center mt-1">
                                            <button onClick="submitUpload('logo_auth', dropzone)" id="submit_logo_auth" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('logo_auth')" id="cancel_upload_logo_auth" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="ogi">
                        <div class="row">
                            <!-- Home Page -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.homepage') }}</label>                            
                                    <div id="show_image_ogi_homepage" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.ogi_homepage'))
                                            <img id="image_preview_ogi_homepage" src="{{ asset('storage/assets/' . config('settings.ogi_homepage')) }}" alt="{{ config('settings.ogi_homepage') }}" class="w-100 _properties" style="max-width:400px;">
                                            @else 
                                            <img id="image_preview_ogi_homepage" src="{{ asset('img/cover.webp') }}" alt="" class="w-100 _properties" style="max-width:400px">
                                            @endif
                                            <button onClick="deleteLogo('ogi_homepage')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews6" data-prevcontainer="#dzPreviewContainer_ogi_homepage" class="formDropzone dropzone overflow-visible p-0 form_ogi_homepage formDropzone_ogi_homepage" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="ogi_homepage">
                                        <div class="dropzone-drag-area form-control" id="previews6">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_ogi_homepage">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_ogi_homepage fw-bold"></div>
                                        <small>{{ __('form.help_open_graph_image') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('ogi_homepage', dropzone)" id="submit_ogi_homepage" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('ogi_homepage')" id="cancel_upload_ogi_homepage" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Article Post Page -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.article_post_page') }}</label>                            
                                    <div id="show_image_ogi_article_post" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.ogi_article_post'))
                                            <img id="image_preview_ogi_article_post" src="{{ asset('storage/assets/' . config('settings.ogi_article_post')) }}" alt="{{ config('settings.ogi_article_post') }}" class="w-100 _properties" style="max-width:400px;">
                                            @else 
                                            <img id="image_preview_ogi_article_post" src="{{ asset('img/cover.webp') }}" alt="" class="w-100 _properties" style="max-width:400px">
                                            @endif
                                            <button onClick="deleteLogo('ogi_article_post')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews7" data-prevcontainer="#dzPreviewContainer_ogi_article_post" class="formDropzone dropzone overflow-visible p-0 form_ogi_article_post formDropzone_ogi_article_post" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="ogi_article_post">
                                        <div class="dropzone-drag-area form-control" id="previews7">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_ogi_article_post">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_ogi_article_post fw-bold"></div>
                                        <small>{{ __('form.help_open_graph_image') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('ogi_article_post', dropzone)" id="submit_ogi_article_post" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('ogi_article_post')" id="cancel_upload_ogi_article_post" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Pages -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.page') }}</label>                            
                                    <div id="show_image_ogi_page" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.ogi_page'))
                                            <img id="image_preview_ogi_page" src="{{ asset('storage/assets/' . config('settings.ogi_page')) }}" alt="{{ config('settings.ogi_page') }}" class="w-100 _properties" style="max-width:400px;">
                                            @else 
                                            <img id="image_preview_ogi_page" src="{{ asset('img/cover.webp') }}" alt="" class="w-100 _properties" style="max-width:400px">
                                            @endif
                                            <button onClick="deleteLogo('ogi_page')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews8" data-prevcontainer="#dzPreviewContainer_ogi_page" class="formDropzone dropzone overflow-visible p-0 form_ogi_page formDropzone_ogi_page" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="ogi_page">
                                        <div class="dropzone-drag-area form-control" id="previews8">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_ogi_page">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_ogi_page fw-bold"></div>
                                        <small>{{ __('form.help_open_graph_image') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('ogi_page', dropzone)" id="submit_ogi_page" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('ogi_page')" id="cancel_upload_ogi_page" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                             <!-- Video Post Page -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.video_post_page') }}</label>                            
                                    <div id="show_image_ogi_video_post" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.ogi_video_post'))
                                            <img id="image_preview_ogi_video_post" src="{{ asset('storage/assets/' . config('settings.ogi_video_post')) }}" alt="{{ config('settings.ogi_video_post') }}" class="w-100 _properties" style="max-width:400px;">
                                            @else 
                                            <img id="image_preview_ogi_video_post" src="{{ asset('img/cover.webp') }}" alt="" class="w-100 _properties" style="max-width:400px">
                                            @endif
                                            <button onClick="deleteLogo('ogi_video_post')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews9" data-prevcontainer="#dzPreviewContainer_ogi_video_post" class="formDropzone dropzone overflow-visible p-0 form_ogi_video_post formDropzone_ogi_video_post" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="ogi_video_post">
                                        <div class="dropzone-drag-area form-control" id="previews9">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_ogi_video_post">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_ogi_video_post fw-bold"></div>
                                        <small>{{ __('form.help_open_graph_image') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('ogi_video_post', dropzone)" id="submit_ogi_video_post" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('ogi_video_post')" id="cancel_upload_ogi_video_post" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Audio Post Page -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.audio_post_page') }}</label>                            
                                    <div id="show_image_ogi_audio_post" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.ogi_audio_post'))
                                            <img id="image_preview_ogi_audio_post" src="{{ asset('storage/assets/' . config('settings.ogi_audio_post')) }}" alt="{{ config('settings.ogi_audio_post') }}" class="w-100 _properties" style="max-width:400px;">
                                            @else 
                                            <img id="image_preview_ogi_audio_post" src="{{ asset('img/cover.webp') }}" alt="" class="w-100 _properties" style="max-width:400px">
                                            @endif
                                            <button onClick="deleteLogo('ogi_audio_post')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews10" data-prevcontainer="#dzPreviewContainer_ogi_audio_post" class="formDropzone dropzone overflow-visible p-0 form_ogi_audio_post formDropzone_ogi_audio_post" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="ogi_audio_post">
                                        <div class="dropzone-drag-area form-control" id="previews10">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_ogi_audio_post">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_ogi_audio_post fw-bold"></div>
                                        <small>{{ __('form.help_open_graph_image') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('ogi_audio_post', dropzone)" id="submit_ogi_page" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('ogi_audio_post')" id="cancel_upload_ogi_page" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Category Page -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.category_page') }}</label>                            
                                    <div id="show_image_ogi_category" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.ogi_category'))
                                            <img id="image_preview_ogi_category" src="{{ asset('storage/assets/' . config('settings.ogi_category')) }}" alt="{{ config('settings.ogi_category') }}" class="w-100 _properties" style="max-width:400px;">
                                            @else 
                                            <img id="image_preview_ogi_category" src="{{ asset('img/cover.webp') }}" alt="" class="w-100 _properties" style="max-width:400px">
                                            @endif
                                            <button onClick="deleteLogo('ogi_category')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews11" data-prevcontainer="#dzPreviewContainer_ogi_category" class="formDropzone dropzone overflow-visible p-0 form_ogi_category formDropzone_ogi_category" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="ogi_category">
                                        <div class="dropzone-drag-area form-control" id="previews11">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_ogi_category">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_ogi_category fw-bold"></div>
                                        <small>{{ __('form.help_open_graph_image') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('ogi_category', dropzone)" id="submit_ogi_page" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('ogi_category')" id="cancel_upload_ogi_category" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Tag Page-->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.tag_page') }}</label>                            
                                    <div id="show_image_ogi_tag" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.ogi_tag'))
                                            <img id="image_preview_ogi_tag" src="{{ asset('storage/assets/' . config('settings.ogi_tag')) }}" alt="{{ config('settings.ogi_tag') }}" class="w-100 _properties" style="max-width:400px;">
                                            @else 
                                            <img id="image_preview_ogi_tag" src="{{ asset('img/cover.webp') }}" alt="" class="w-100 _properties" style="max-width:400px">
                                            @endif
                                            <button onClick="deleteLogo('ogi_tag')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews12" data-prevcontainer="#dzPreviewContainer_ogi_tag" class="formDropzone dropzone overflow-visible p-0 form_ogi_tag formDropzone_ogi_tag" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="ogi_tag">
                                        <div class="dropzone-drag-area form-control" id="previews12">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_ogi_tag">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_ogi_tag fw-bold"></div>
                                        <small>{{ __('form.help_open_graph_image') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('ogi_tag', dropzone)" id="submit_ogi_tag" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('ogi_tag')" id="cancel_upload_ogi_tag" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- All Posts Page -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.all_posts_page') }}</label>                            
                                    <div id="show_image_ogi_posts" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.ogi_posts'))
                                            <img id="image_preview_ogi_page" src="{{ asset('storage/assets/' . config('settings.ogi_posts')) }}" alt="{{ config('settings.ogi_posts') }}" class="w-100 _properties" style="max-width:400px;">
                                            @else 
                                            <img id="image_preview_ogi_page" src="{{ asset('img/cover.webp') }}" alt="" class="w-100 _properties" style="max-width:400px">
                                            @endif
                                            <button onClick="deleteLogo('ogi_posts')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews13" data-prevcontainer="#dzPreviewContainer_ogi_posts" class="formDropzone dropzone overflow-visible p-0 form_ogi_posts formDropzone_ogi_posts" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="ogi_posts">
                                        <div class="dropzone-drag-area form-control" id="previews13">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_ogi_posts">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_ogi_posts fw-bold"></div>
                                        <small>{{ __('form.help_open_graph_image') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('ogi_posts', dropzone)" id="submit_ogi_posts" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('ogi_posts')" id="cancel_upload_ogi_posts" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Popular Post Page -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.popular_post_page') }}</label>                            
                                    <div id="show_image_ogi_popular_post" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.ogi_popular_post'))
                                            <img id="image_preview_ogi_popular_post" src="{{ asset('storage/assets/' . config('settings.ogi_popular_post')) }}" alt="{{ config('settings.ogi_popular_post') }}" class="w-100 _properties" style="max-width:400px;">
                                            @else 
                                            <img id="image_preview_ogi_popular_post" src="{{ asset('img/cover.webp') }}" alt="" class="w-100 _properties" style="max-width:400px">
                                            @endif
                                            <button onClick="deleteLogo('ogi_popular_post')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews14" data-prevcontainer="#dzPreviewContainer_ogi_popular_post" class="formDropzone dropzone overflow-visible p-0 form_ogi_popular_post formDropzone_ogi_popular_post" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="ogi_popular_post">
                                        <div class="dropzone-drag-area form-control" id="previews14">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_ogi_popular_post">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_ogi_popular_post fw-bold"></div>
                                        <small>{{ __('form.help_open_graph_image') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('ogi_popular_post', dropzone)" id="submit_ogi_popular_post" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('ogi_popular_post')" id="cancel_upload_ogi_popular_post" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Contact Page -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.contact_page') }}</label>                            
                                    <div id="show_image_ogi_contact" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.ogi_contact'))
                                            <img id="image_preview_ogi_contact" src="{{ asset('storage/assets/' . config('settings.ogi_contact')) }}" alt="{{ config('settings.ogi_contact') }}" class="w-100 _properties" style="max-width:400px;">
                                            @else 
                                            <img id="image_preview_ogi_contact" src="{{ asset('img/cover.webp') }}" alt="" class="w-100 _properties" style="max-width:400px">
                                            @endif
                                            <button onClick="deleteLogo('ogi_contact')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews15" data-prevcontainer="#dzPreviewContainer_ogi_contact" class="formDropzone dropzone overflow-visible p-0 form_ogi_contact formDropzone_ogi_contact" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="ogi_contact">
                                        <div class="dropzone-drag-area form-control" id="previews15">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_ogi_contact">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_ogi_contact fw-bold"></div>
                                        <small>{{ __('form.help_open_graph_image') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('ogi_contact', dropzone)" id="submit_ogi_contact" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('ogi_contact')" id="cancel_upload_ogi_contact" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Search Page-->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">{{ __('form.search_page') }}</label>                            
                                    <div id="show_image_ogi_search" class="text-center">
                                        <div class="img-viewer">
                                            @if(config('settings.ogi_search'))
                                            <img id="image_preview_ogi_search" src="{{ asset('storage/assets/' . config('settings.ogi_search')) }}" alt="{{ config('settings.ogi_search') }}" class="w-100 _properties" style="max-width:400px;">
                                            @else 
                                            <img id="image_preview_ogi_search" src="{{ asset('img/cover.webp') }}" alt="" class="w-100 _properties" style="max-width:400px">
                                            @endif
                                            <button onClick="deleteLogo('ogi_search')" class="del-img border-0 p-0" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <form data-previews="#previews16" data-prevcontainer="#dzPreviewContainer_ogi_search" class="formDropzone dropzone overflow-visible p-0 form_ogi_search formDropzone_ogi_search" method="POST" enctype="multipart/form-data" novalidate hidden>
                                        @csrf
                                        <input type="hidden" name="asset" value="ogi_search">
                                        <div class="dropzone-drag-area form-control" id="previews16">
                                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                                <span>{{ __('form.drag_file_here_to_upload') }}</span>
                                            </div>    
                                            <div class="d-none" id="dzPreviewContainer_ogi_search">
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-photo">
                                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                                    </div>
                                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback invalid_ogi_search fw-bold"></div>
                                        <small>{{ __('form.help_open_graph_image') }}</small>
                                        <div class="buttons text-center mt-3">
                                            <button onClick="submitUpload('ogi_search', dropzone)" id="submit_ogi_search" type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{ __('button.upload') }}</button>
                                            <button onClick="cancelUpload('ogi_search')" id="cancel_upload_ogi_search" type="button" class="btn btn-sm btn-warning">{{ __('button.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@stop

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
    @include('admin.settings._style')
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
    @include('layouts.partials._notification')
    @include('layouts.partials._switch_lang')
    @include('layouts.partials._csrf-token')
    @include('admin.languages._languages')
    <script>
        "use strict";

        $(document).ready(() => {
            let url = location.href.replace(/\/$/, "");

            if (location.hash) {
                const hash = url.split("#");
                $('#navTab a[href="#' + hash[1] + '"]').tab("show");
                url = location.href.replace(/\/#/, "#");
                history.replaceState(null, null, url);
                setTimeout(() => {
                    $(window).scrollTop(0);
                }, 400);
            }

            $('a[data-toggle="tab"]').on("click", function() {
                let newUrl;
                const hash = $(this).attr("href");
                newUrl = url.split("#")[0] + hash;
                newUrl += "/";
                history.replaceState(null, null, newUrl);
            });
        });
    </script>
    <script>
        "use strict";

        function deleteLogo(el) {
            $('.form_'+el).removeAttr('hidden');
            $('#show_image_'+el).attr('hidden', true);
        }

        function cancelUpload(el) {
            $('.form_'+el).attr('hidden', true);
            $('#show_image_'+el).removeAttr('hidden');
            Dropzone.forElement('.form_'+el).removeAllFiles(true);
        }

        Dropzone.autoDiscover = false;
        const dropzones = document.querySelectorAll(".dropzone");

        dropzones.forEach((dz) => {
            let preview          = dz.getAttribute("data-previews");
            let previewContainer = dz.getAttribute("data-prevcontainer");

            const dropzone = new Dropzone( dz, {
                previewTemplate: $(previewContainer).html(),
                url: '/admin/manage/settings/web-properties/upload',
                addRemoveLinks: true,
                autoProcessQueue: false,       
                uploadMultiple: false,
                parallelUploads: 1,
                maxFiles: 1,
                acceptedFiles: '.jpeg, .jpg, .png, .gif, .webp',
                thumbnailWidth: 900,
                thumbnailHeight: 600,
                previewsContainer: preview,
                timeout: 0,
                init: function() 
                {
                    // when file is dragged in
                    this.on('addedfile', function(file) { 
                        $('.dropzone-drag-area').removeClass('is-invalid').next('.invalid-feedback').hide();
                    });
                },
                success: function(file, response) 
                {
                    if (response.errors) {
                        if (response.errors.file) {
                            $('.invalid_'+response.asset).html(response.errors.file);
                            $('.dropzone-drag-area').addClass('is-invalid').next('.invalid-feedback').show();
                            Dropzone.forElement('.form_'+response.asset).removeAllFiles(true);
                        }
                    } else {
                        $('#image_preview_'+response.asset).attr('src', file.dataURL);
                        $('#show_image_'+response.asset).removeAttr('hidden');
                        Dropzone.forElement('.form_'+response.asset).removeAllFiles(true);

                        // hide form and show success message
                        $('.form_'+response.asset).attr('hidden', true);

                        toastr.success(response.success);

                        setTimeout(function() {
                            $('#successMessage').removeClass('d-none');
                        }, 100);    
                    }
                }
            });
        });

        /**
         * Form on submit
         */
        function submitUpload(el, dropzone) {
            event.preventDefault();
            
            var $this = $('#submit_'+el);
            
            // show submit button spinner
            $this.children('.spinner-border').removeClass('d-none');
            
            // validate form & submit if valid
            if ($('.formDropzone_'+el)[0].checkValidity() === false) {
                event.stopPropagation();

                // show error messages & hide button spinner    
                $('.formDropzone_'+el).addClass('was-validated'); 
                $this.children('.spinner-border').addClass('d-none');

                // if dropzone is empty show error message
                if (!dropzone.getQueuedFiles().length > 0) {                        
                    $('.dropzone-drag-area').addClass('is-invalid').next('.invalid-feedback').show();
                }
            } else {
                // if everything is ok, submit the form
                dropzone.processQueue();
            }
        }
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop