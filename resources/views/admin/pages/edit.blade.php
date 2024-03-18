@extends('adminlte::page')

@section('title', __('title.edit_page'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.edit_page') }}" currentActive="{{ __('title.edit') }}" :addLink="[__('title.pages') => route('pages.index')]"/>
@stop

@section('plugins.Flag', true)
@section('plugins.BootstrapTagInput', true)
@section('plugins.Tinymce', true)
@section('plugins.Select2', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
<form action="{{route('pages.update', [$page->id])}}" method="POST" role="form" enctype="multipart/form-data">
@method('PUT')
@csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-body">
                    <div class="form-group">
                        <label for="titlePost">{{ __('form.title') }}</label>
                        <input id="titlePost" type="text" name="post_title" class="form-control {{ $errors->has('post_title') ? 'is-invalid' : '' }}"
                            placeholder="{{ __('form.placeholder_title') }}" value="{{ $page->post_title }}" required autofocus>
                        @if ($errors->has('post_title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('post_title') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <p>
                            <a id="customPermalink" class="btn btn-info btn-sm" data-toggle="collapse" href="#collapseSlug" role="button" aria-expanded="false" aria-controls="collapseSlug">
                                {{ __('button.use_custom_permalink') }}
                            </a>
                        </p>
                        <div class="collapse{{ $errors->has('slug') ? ' show' : '' }}" id="collapseSlug">
                            <input type="text" name="slug" disabled
                                   class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" id="slugPost"
                                   placeholder="{{ __('form.placeholder_custom_permalink') }}" value="{{ old('slug') ? old('slug') : $page->post_name }}">
                            @if ($errors->has('slug'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('slug') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('form.summary') }}</label>
                        <textarea name="post_summary" class="form-control" rows="3" placeholder="{{ __('form.placeholder_summary') }}">{{ $page->post_summary }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('form.content') }}</label>
                        <textarea name="post_content" placeholder="{{ __('form.placeholder_content') }}" style="width: 100%; height: 200px; font-weight:normal">{{ $page->post_content }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/flags/4x3/'.strtolower($language->country_code).'.svg') }}" width="25">
                            </span>
                            </div>
                            <input type="text" class="form-control" aria-describedby="basic-addon1" value="{{ $language->name }}" disabled>
                            <input type="hidden" name="language_id" value="{{ $language->id }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('form.translations') }}</label>
                        @foreach(LocalizationHelper::languageWithFlag() as $trans)
                            @if($trans->language != $language->language)
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <img src="{{ asset('img/flags/4x3/'.strtolower($trans->country_code).'.svg') }}" width="25">
                                    </span>
                                        @if(PostHelper::checkExistsTrans($trans->language, $page->translations->first()->value))
                                            <a class="btn btn-outline-secondary" href="{{ route('pages.edit', PostHelper::getTransPostId($trans->id, $page->translations->first()->value)) }}">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-outline-secondary" href="{{ route('pages.create.translate', ['id' => $page->id, 'lang' => $trans->language]) }}">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <input type="text" class="form-control" aria-describedby="basic-addon1" value="{{ PostHelper::showTransPostTitle($trans->id, $page->translations->first()->value) }}" disabled>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('form.featured_image') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="thumb_caption">{{ __('form.post_thumbnail') }}</label>
                        <ul class="nav nav-tabs" id="post-thumb-tab" role="tablist">
                            @if (PostHelper::isImageUrlAvailable($page))
                            <li class="nav-item">
                                <a class="nav-link" id="uploadImageMethod-tab" data-toggle="pill" href="#uploadImageMethod" role="tab" aria-controls="custom-content-below-home" aria-selected="true">{{ __('button.upload') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="linkMethod-tab" data-toggle="pill" href="#linkMethod" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">URL</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link active" id="uploadImageMethod-tab" data-toggle="pill" href="#uploadImageMethod" role="tab" aria-controls="custom-content-below-home" aria-selected="true">{{ __('button.upload') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="linkMethod-tab" data-toggle="pill" href="#linkMethod" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">URL</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="post-thumb-tabContent">
                            @if (PostHelper::isImageUrlAvailable($page))
                            <div class="tab-pane fade" id="uploadImageMethod" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                <div class="upload-photo mt-3 @if(!empty($page->post_image))ready @endif">
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
                            <div class="tab-pane fade active show" id="linkMethod" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                <div class="form-group mt-3">
                                    <input type="text" name="image_url" class="form-control @error('image_url') is-invalid @enderror"
                                        id="imageUrl" placeholder="{{ __('form.placeholder_image_url') }}" value="{{ PostHelper::getPostThumbnailUrl($page->post_image_meta) }}">
                                    @error('image_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @else
                            <div class="tab-pane fade active show" id="uploadImageMethod" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                <div class="upload-photo mt-3 @if(!empty($page->post_image))ready @endif">
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
                            <div class="tab-pane fade" id="linkMethod" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                <div class="form-group mt-3">
                                    <input type="text" name="image_url" class="form-control @error('image_url') is-invalid @enderror"
                                        id="imageUrl" placeholder="{{ __('form.placeholder_image_url') }}" value="{{ PostHelper::getPostThumbnailUrl($page->post_image_meta) }}">
                                    @error('image_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="thumb_caption">{{ __('form.caption') }}</label>
                        <textarea id="thumb_caption" name="thumb_caption" class="form-control" rows="3"
                            placeholder="{{ __('form.placeholder_caption') }}">{{ PostHelper::getPostThumbnailCaption($page->post_image_meta) }}</textarea>
                        @error('thumb_caption')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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
                        <textarea id="meta_description" name="meta_description" class="form-control" rows="3" placeholder="{{ __('form.placeholder_meta_description') }}">{{ $page->meta_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_keyword">{{ __('form.meta_keyword') }}</label>
                        <textarea id="meta_keyword" name="meta_keyword" class="form-control" rows="3" placeholder="{{ __('form.placeholder_meta_keyword') }}">{{ $page->meta_keyword}}</textarea>
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
@endpush

@push('js')
    @include('layouts.partials._notification')
    @include('layouts.partials._switch_lang')
    @include('layouts.partials._csrf-token')
    @include('admin.pages._script')
    <script>
        "use strict";

        $( "#linkMethod-tab" ).on( "click", function() {
            $('input[name=isimage]').val("false");
        } );

        $( "#uploadImageMethod-tab" ).on( "click", function() {
            $('input[name=isimage]').val("true");
        } );

        $('.upload-msg').on("click", function() {
            $("#upload").trigger("click");
        })

        const element = document.querySelector(".upload-photo");
        $('input[name=isimage]').val(element.classList.contains("ready"));

        $('#reset').on("click", function() {
            $('#display').removeAttr('hidden');
            $('#reset').attr('hidden');
            $('.upload-photo').removeClass('ready result');
            $('#image_preview_container').attr('src', 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D');
            $('input[name=isimage]').val("false");
        })

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
        })
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
