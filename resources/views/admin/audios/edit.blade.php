@extends('adminlte::page')

@section('title', __('title.edit_audio_post'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.edit_audio_post') }}" currentActive="{{ __('title.edit') }}" :addLink="[__('title.audio_posts') => route('audios.index')]"/>
@stop

@section('plugins.Flag', true)
@section('plugins.BootstrapTagInput', true)
@section('plugins.Tinymce', true)
@section('plugins.Select2', true)
@section('plugins.Filepond', true)
@section('plugins.Player', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <form action="{{ route('audios.update', [$post->id]) }}" method="POST" role="form" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header d-flex p-0">
                    <h3 class="card-title p-3">{{ __('title.upload_audio') }}</h3>
                    <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item" data-type="file"><a class="nav-link @if($post->post_type == 'audio_file') active @endif" href="#audio_file" data-toggle="tab">{{ __('title.upload_audio') }}</a></li>
                        <li class="nav-item" data-type="url"><a class="nav-link @if($post->post_type == 'audio_url') active @endif" href="#audio_url" data-toggle="tab">{{ __('title.url') }}</a></li>
                        <li class="nav-item" data-type="embed"><a class="nav-link @if($post->post_type == 'audio_embed') active @endif" href="#audio_embed" data-toggle="tab">{{ __('title.embed') }}</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <input type="hidden" name="post_type" id="post_type" value="{{ $post->post_type }}">
                        <div class="tab-pane @if($post->post_type == 'audio_file') active @endif" id="audio_file">
                            <div class="form-group" id="file">
                                @if ($post->post_type == 'audio_file' AND $fileExists AND $dbExists)
                                    <div class="container-plyr" @error('post_source') hidden @enderror>
                                        <audio id="player" controls>
                                            <source src="{{ asset('storage/audios/'.$post->post_source) }}"/>
                                        </audio>
                                        <div class="buttons text-center mt-3">
                                            <button id="changeAudioFiles" type="button" class="btn btn-sm btn-danger">{{ __('button.change_audio_files') }}</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="container-upload" @error('post_source') @else @if($fileExists AND $dbExists) hidden @endif @enderror>
                                        <input type="file" id="_upload" name="post_source" class="audio_file @error('post_source') is-invalid @enderror"/>
                                        @error('post_source')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        @if($post->post_type == 'audio_file')
                                        <div class="buttons text-center">
                                            <button id="usePreviousAudioFiles" type="button" class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-rotate-right"></i>
                                                {{ __('button.use_previous_audio_files') }}
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane @if($post->post_type == 'audio_url') active @endif" id="audio_url">
                            <div class="form-group">
                                @php
                                    if ($post->post_type == 'audio_url'){
                                        $value = old('post_source') ? old('post_source') : $post->post_source;
                                    } else {
                                        $value = '';
                                    }
                                @endphp
                                <input type="text" @if($post->post_type != 'audio_url') disabled @endif name="post_source" class="audio_url form-control @error('post_source') is-invalid @enderror" placeholder="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" value="{{ $value }}">
                                @error('post_source')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane @if($post->post_type == 'audio_embed') active @endif" id="audio_embed">
                            <div class="form-group">
                                @php
                                    if ($post->post_type == 'audio_embed'){
                                        $value = old('post_source') ? old('post_source') : $post->post_source;
                                    } else {
                                        $value = '';
                                    }
                                @endphp
                                <textarea @if($post->post_type != 'audio_embed') disabled @endif name="post_source" class="audio_embed form-control @error('post_source') is-invalid @enderror" rows="5" placeholder="{{ __('form.placeholder_audio_embed') }}">{{ $value }}</textarea>
                                @error('post_source')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div><!-- /.card-body -->
            </div>
            <div class="card card-default">
                <div class="card-body">
                    <div class="form-group">
                        <label for="titlePost">{{ __('form.title') }}</label>
                        <input type="text" name="post_title"
                            class="form-control {{ $errors->has('post_title') ? 'is-invalid' : '' }}" id="titlePost"
                            placeholder="{{ __('form.placeholder_title') }}" value="{{ old('post_title') ? old('post_title') : $post->post_title }}" required autofocus>
                        @if ($errors->has('post_title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('post_title') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <p>
                            <a class="btn btn-info btn-sm" data-toggle="collapse" href="#collapseSlug" role="button" aria-expanded="false" aria-controls="collapseSlug">
                                {{ __('button.use_custom_permalink') }}
                            </a>
                        </p>
                        <div class="collapse{{ $errors->has('slug') ? ' show' : '' }}" id="collapseSlug">
                            <input type="text" name="slug"
                                   class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" id="slugPost"
                                   placeholder="{{ __('form.placeholder_custom_permalink') }}" value="{{ old('slug') ? old('slug') : $post->post_name }}">
                            @if ($errors->has('slug'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('slug') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="summaryPost">{{ __('form.summary') }}</label>
                        <textarea id="summaryPost" name="post_summary" class="form-control" rows="3" placeholder="{{ __('form.placeholder_summary') }}">{{ $post->post_summary }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="contentPost">{{ __('form.content') }}</label>
                        <textarea id="contentPost" name="post_content" placeholder="{{ __('form.placeholder_content') }}" style="width: 100%; height: 200px; font-weight:normal">{{ $post->post_content }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('form.audio_thumbnails') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <ul class="nav nav-tabs" id="thumbnail-tab" role="tablist">
                            @php
                                if (PostHelper::isImageUrlAvailable($post)){
                                    $urlTab = 'active';
                                    $urlContentTab = 'active show';
                                    $uploadTab = '';
                                    $uploadContentTab = '';
                                } else {
                                    $urlTab = '';
                                    $urlContentTab = '';
                                    $uploadTab = 'active';
                                    $uploadContentTab = 'active show';
                                }
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link {{ $uploadTab }}" id="uploadImageMethod-tab" data-toggle="pill" href="#uploadImageMethod" role="tab" aria-controls="custom-content-below-home" aria-selected="true">{{ __('button.upload') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $urlTab }}" id="linkMethod-tab" data-toggle="pill" href="#linkMethod" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">URL</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="thumbnail-tabContent">
                            <div class="tab-pane fade {{ $uploadContentTab }}" id="uploadImageMethod" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                <div class="upload-photo mt-3 @if(!empty($post->post_image))ready @endif">
                                    <input id="upload" type="file" name="post_image" value="{{ __('form.choose_a_file') }}" accept="image/*" data-role="none" hidden>
                                    <input type="hidden" name="isimage">
                                    <div class="col-md-12">
                                        <div class="upload-msg">{{ __('form.placeholder_image') }}</div>
                                        <div id="display">
                                            <img id="image_preview_container" src="{{ $image }}" alt="{{ __('form.preview_image') }}"
                                                style="width: 100%;">
                                        </div>
                                        <small class="form-text text-muted my-3">
                                            {{ __('form.help_upload_post_image') }}
                                        </small>
                                        <div class="buttons text-center">
                                            <button id="reset" type="button" class="reset btn btn-danger">{{ __('button.remove') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade {{ $urlContentTab }}" id="linkMethod" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                <div class="form-group mt-3">
                                    <input type="text" name="image_url" class="form-control @error('image_url') is-invalid @enderror"
                                        id="imageUrl" placeholder="{{ __('form.placeholder_image_url') }}" value="{{ PostHelper::getPostThumbnailUrl($post->post_image_meta) }}">
                                    @error('image_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('form.language') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="language">{{ __('form.select_language') }}</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <img src="{{ asset('img/flags/4x3/'.strtolower($language->country_code).'.svg') }}" width="25">
                                </span>
                            </div>
                            <input type="text" class="form-control" aria-describedby="basic-addon1" value="{{ $language->name }}" disabled>
                            <input type="hidden" id="language_id" name="language_id" value="{{ Auth::user()->language }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('form.translations') }}</label>
                        @foreach(\App\Helpers\LocalizationHelper::languageWithFlag() as $trans)
                            @if($trans->language != $language->language)
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <img src="{{ asset('img/flags/4x3/'.strtolower($trans->country_code).'.svg') }}" width="25">
                                        </span>
                                        @if(\App\Helpers\PostHelper::checkExistsTrans($trans->language, $post->translations->first()->value))
                                            <a class="btn btn-outline-secondary" href="{{ route('audios.edit', \App\Helpers\PostHelper::getTransPostId($trans->id, $post->translations->first()->value)) }}">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-outline-secondary" href="{{ route('audios.create.translate', ['id' => $post->id, 'lang' => $trans->language]) }}">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <input type="text" class="form-control" aria-describedby="basic-addon1" value="{{ \App\Helpers\PostHelper::showTransPostTitle($trans->id, $post->translations->first()->value) }}" disabled>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('form.categories') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select id="categories" name="categories[]" class="select2" multiple="multiple"
                            data-placeholder="{{ __('form.choose') }}" style="width: 100%;">
                            @foreach( $post->terms()->category()->get() as $category )
                            <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">
                            {{ __('form.help_category') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <p>
                            <a class="" href="#collapseCategory" data-toggle="collapse" id="add_category" role="button" aria-expanded="false" aria-controls="collapseCategory">
                                {{ __('button.add_new_category') }}
                            </a>
                        </p>
                    </div>
                    <div class="collapse @error('add_new_category')) show @enderror" id="collapseCategory">
                        <div class="form-group">
                            <input id="input-add-category" type="text" name="add_new_category" class="form-control @error('title') is-invalid @enderror" autofocus>
                            <div class="invalid-feedback msg-error-name-category"></div>
                        </div>
                        <div class="form-group">
                            <select id="parent" name="parent" class="select2" data-placeholder="{{ __('form.placeholder_select_parent') }}" style="width: 100%;"></select>
                        </div>
                        <button id="btn-submit-add-category" type="button" class="btn btn-info btn-sm float-right">{{ __('button.add_new_category') }}</button>
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('form.subcategories') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select id="subcategories" name="categories[]" class="select2" multiple="multiple"
                                data-placeholder="{{ __('form.placeholder_subcategories') }}" style="width: 100%;">
                            @foreach( $post->terms()->subcategory()->get() as $category )
                                <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">
                            {{ __('form.help_subcategories') }}
                        </small>
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('form.tags') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control" data-role="tagsinput" name="tags" placeholder="{{ __('form.placeholder_tags') }}" value="{{ $tags }}">
                        <small class="form-text text-muted">
                            {{ __('form.help_tag') }}
                        </small>
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('form.publish') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="meta_description">{{ __('form.meta_description') }}</label>
                        <textarea id="meta_description" name="meta_description" class="form-control" rows="3"
                                  placeholder="{{ __('form.placeholder_meta_description') }}">{{ $post->meta_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_keyword">{{ __('form.meta_keyword') }}</label>
                        <textarea id="meta_keyword" name="meta_keyword" class="form-control" rows="3"
                                  placeholder="{{ __('form.placeholder_meta_keyword') }}">{{ $post->meta_keyword }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>{{ __('form.publish') }}</label>
                        <div class="mb-3">
                            <span id="showDateTimePublish">{{ $post->created_at->locale($language->language)->isoFormat('LLL') }}</span>
                            <span id="displayDateTimePublish">{{ __('button.edit') }}</span>
                            <span id="closeDateTimePublish" class="d-none">{{ __('button.close') }}</span>
                        </div> 
                        <div id="displayDateTimeEdit" class="d-none">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <select id="input-month" class="form-control" name="month">
                                    @for ($m=1; $m<=12; $m++)
                                        @if ($m == $post->created_at->locale($language->language)->isoFormat('M') )
                                        <option value="{{ $m }}" selected>{{ date('F', mktime(0,0,0,$m, 1, date('Y'))) }}</option>
                                        @else 
                                        <option value="{{ $m }}">{{ date('F', mktime(0,0,0,$m, 1, date('Y'))) }}</option>
                                        @endif
                                    @endfor
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="number" id="input-days" class="form-control" name="days" value="{{ $post->created_at->locale($language->language)->isoFormat('D') }}">
                                </div>
                                <div class="col-3">
                                    <input type="number" id="input-year" class="form-control" name="year" min="1" max="9999" value="{{ $post->created_at->locale($language->language)->isoFormat('Y') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="input-group">
                                        <input type="number" id="input-hour" class="form-control border-right-0" name="hour" value="{{ $post->created_at->isoFormat('hh') }}">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text p-0 border-right-0 border-left-0 bgcolon">:</span>
                                        </div>
                                        <input type="number" id="input-minute" class="form-control border-left-0" name="minute" value="{{ $post->created_at->isoFormat('mm') }}">
                                        <input type="hidden" name="second" value="{{ $post->created_at->isoFormat('ss') }}">
                                    </div>
                                </div>
                                <div class="col-8">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-info">
                                        <input type="radio" name="timeFormat" id="time-am" autocomplete="off" @if($post->created_at->isoFormat('A') == "AM") checked @endif value="AM"> AM 
                                    </label>
                                    <label class="btn btn-info">
                                        <input type="radio" name="timeFormat" id="time-pm" autocomplete="off" @if($post->created_at->isoFormat('A') == "PM") checked @endif value="PM"> PM
                                    </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('form.visibility') }}</label>
                        <select id="visibility" class="form-control" name="post_visibility">
                            @if($visibility == 'public')
                                <option id="public" value="public" selected>{{ __('form.public') }}</option>
                                <option id="private" value="private">{{ __('form.private') }}</option>
                            @else
                                <option id="public" value="public">{{ __('form.public') }}</option>
                                <option id="private" value="private" selected>{{ __('form.private') }}</option>
                            @endif
                        </select>
                        <small class="form-text text-muted visibility-msg">
                            {{ __('form.help_public_visibility') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="publish" value="{{ __('button.update') }}">
                        <input class="btn btn-secondary float-right" type="submit" name="draft" value="{{ __('button.save_draft') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@stop

@push('css')
    @include('admin.posts._style')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endpush

@push('js')
    @include('layouts.partials._notification')
    @include('layouts.partials._switch_lang')
    @include('layouts.partials._csrf-token')
    @include('layouts.partials._datepublish_script')
    <script>
        let lang = $("#language").val();
    </script>
    @include('admin.posts._script')
    <script>
        "use strict";

        $( "#linkMethod-tab" ).on( "click", function() {
            $('input[name=isimage]').val("false");
        } );

        $( "#uploadImageMethod-tab" ).on( "click", function() {
            $('input[name=isimage]').val("true");
        } );

        $(document).ready(() => {
            let url = location.href.replace(/\/$/, "");

            if (location.hash) {
                const hash = url.split("#");
                $('.nav-pills a[href="#' + hash[1] + '"]').tab("show");
                url = location.href.replace(/\/#/, "#");
                history.replaceState(null, null, url);
                setTimeout(() => {
                    $(window).scrollTop(0);
                }, 400);
            }

            $('.nav-link').on("click", function() {
                let newUrl;
                const hash = $(this).attr("href");
                newUrl = url.split("#")[0] + hash;
                history.replaceState(null, null, newUrl);

                if ($(this).attr('href') == '#audio_file') {
                    $('.audio_url').attr('disabled', true);
                    $('.audio_embed').attr('disabled', true);
                    $('.audio_file').removeAttr('disabled');
                    $('#post_type').val('audio_file');
                    $('#post_type').val('audio_file');
                    $('audio').each(function(){this.player.pause(); this.player.setCurrentTime(0)})
                } else if ($(this).attr('href') == '#audio_url') {
                    $('.audio_file').attr('disabled', true);
                    $('.audio_embed').attr('disabled', true);
                    $('.audio_url').removeAttr('disabled');
                    $('#post_type').val('audio_url');
                    $('audio').each(function(){this.player.pause(); this.player.setCurrentTime(0)})
                } else if ($(this).attr('href') == '#audio_embed') {
                    $('.audio_url').attr('disabled', true);
                    $('.audio_file').attr('disabled', true);
                    $('.audio_embed').removeAttr('disabled');
                    $('#post_type').val('audio_embed');
                    $('audio').each(function(){this.player.pause(); this.player.setCurrentTime(0)})
                }
            });

            let currentUrl = window.location.href;
            currentUrl = currentUrl.replace(/\/$/, "")

            if (currentUrl.split("#")[1] == 'audio_file') {
                $('.audio_url').attr('disabled', true);
                $('.audio_embed').attr('disabled', true);
                $('.audio_file').removeAttr('disabled');
                $('#post_type').val('audio_file');
            } else if (currentUrl.split("#")[1] == 'audio_url') {
                $('.audio_file').attr('disabled', true);
                $('.audio_embed').attr('disabled', true);
                $('.audio_url').removeAttr('disabled');
                $('#post_type').val('audio_url');
            } else if (currentUrl.split("#")[1] == 'audio_embed') {
                $('.audio_url').attr('disabled', true);
                $('.audio_file').attr('disabled', true);
                $('.audio_embed').removeAttr('disabled');
                $('#post_type').val('audio_embed');
            }
        });

        // CHANGE AUDIO
        $('#changeAudioFiles').on('click', function(){
            $('.container-plyr').attr('hidden', true);
            $('.container-upload').removeAttr('hidden');
            $('audio').each(function(){this.player.pause(); this.player.setCurrentTime(0)})
        });

        // Re-USE FILE AUDIO
        $('#usePreviousAudioFiles').on('click', function(){
            $('.container-plyr').removeAttr('hidden');
            $('.container-upload').attr('hidden', true);
        });

        // UPLOAD IMAGE
        const element = document.querySelector(".upload-photo");
        $('input[name=isimage]').val(element.classList.contains("ready"));

        $('.upload-msg').on("click", function() {
            $("#upload").trigger("click");
        });

        $('#reset').on("click", function() {
            $('#display').removeAttr('hidden');
            $('#reset').attr('hidden');
            $('.upload-photo').removeClass('ready result');
            $('#image_preview_container').attr('src', 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D');
            $('input[name=isimage]').val("false");
        });

        function readFile(input) {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('.upload-photo').addClass('ready');
                $('#image_preview_container').attr('src', e.target.result);
                $('input[name=isimage]').val("true");
            }
            reader.readAsDataURL(input.files[0]);
        }

        $('#upload').on('change', function() {
            readFile(this);
        });

        // AUDIO PLAYER
        const player = new Plyr('#player');

        // UPLOAD AUDIO
        FilePond.registerPlugin(FilePondPluginFileValidateType);

        FilePond.setOptions({
            credits: false,
            chunkUploads: true,
            server: {
                url: '/filepond/api',
                process: '/process',
                revert: '/process',
                restore: '/filepond-restore/',
                patch: "?patch=",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });

        @if (session('posttype'))
            @if (session('posttype') == 'audio_file')
                @if (session('serverid'))
                FilePond.create(document.querySelector('#_upload'), {
                    acceptedFileTypes: ['audio/*'],
                    files: [
                        {
                            source: '{{ session('serverid') }}',
                            options: {
                                type: 'limbo',
                            },
                        },
                    ],
                });
               @endif
           @endif
        @else
           FilePond.create(document.querySelector('#_upload'), {
               acceptedFileTypes: ['audio/*']
           });
        @endif
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
