@extends('adminlte::page')

@section('title', __('title.add_new_post'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.add_new_post') }}" currentActive="{{ __('title.add_new') }}" :addLink="[__('title.posts') => route('posts.index')]"/>
@stop

@section('plugins.Flag', true)
@section('plugins.BootstrapTagInput', true)
@section('plugins.Tinymce', true)
@section('plugins.Select2', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <form id="form" action="{{ route('posts.store') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="titlePost">{{ __('form.title') }}</label>
                            <input type="text" name="post_title" class="form-control @error('post_title') is-invalid @enderror"
                                   id="titlePost" placeholder="{{ __('form.placeholder_title') }}" value="{{ old('post_title') }}" autofocus>
                            @error('post_title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="summary">{{ __('form.summary') }}</label>
                            <textarea name="post_summary" class="form-control" rows="3" placeholder="{{ __('form.placeholder_summary') }}"
                                      id="summary"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('form.content') }}</label>
                            <textarea name="post_content" placeholder="{{ __('form.placeholder_content') }}" style="width: 100%; height: 200px; font-weight:normal"></textarea>
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
                            <select id="language" name="post_language" class="select2" data-placeholder="{{ __('form.select_language') }}" style="width: 100%;">
                                @foreach( $languages as $id => $language )
                                    @if($id == Auth::user()->language)
                                        <option value="{{ $id }}" selected="selected">{{ $language }}</option>
                                    @else
                                        <option value="{{ $id }}">{{ $language }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="hidden" id="language_id" name="language_id" value="{{ Auth::user()->language }}">
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
                            <input type="text" class="form-control" data-role="tagsinput" name="tags" placeholder="{{ __('form.placeholder_tags') }}">
                            <small class="form-text text-muted">
                                {{ __('form.help_tag') }}
                            </small>
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
                                <li class="nav-item">
                                    <a class="nav-link active" id="uploadImageMethod-tab" data-toggle="pill" href="#uploadImageMethod" role="tab" aria-controls="custom-content-below-home" aria-selected="true">{{ __('button.upload') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="linkMethod-tab" data-toggle="pill" href="#linkMethod" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">URL</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="post-thumb-tabContent">
                                <div class="tab-pane fade active show" id="uploadImageMethod" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                    <div class="upload-photo mt-3">
                                        <input id="upload" type="file" name="post_image" value="{{ __('form.choose_a_file') }}" accept="image/*" data-role="none" hidden>
                                        <div class="col-md-12">
                                            <div class="upload-msg">{{ __('form.placeholder_image') }}</div>
                                            <div id="display">
                                                <img id="image_preview_container" src="#" alt="{{ __('form.preview_image') }}" style="width: 100%;">
                                            </div>
                                            <small class="form-text text-muted my-3">
                                                {{ __('form.help_upload_post_image') }}
                                            </small>
                                            <div class="buttons text-center mt-3">
                                                <button id="reset" type="button" class="reset btn btn-sm btn-danger">{{ __('button.remove') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="linkMethod" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                    <div class="form-group mt-3">
                                        <input type="text" name="image_url" class="form-control @error('image_url') is-invalid @enderror"
                                            id="imageUrl" placeholder="{{ __('form.placeholder_image_url') }}" value="{{ old('image_url') }}">
                                        @error('image_url')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="thumb_caption">{{ __('form.caption') }}</label>
                            <textarea id="thumb_caption" name="thumb_caption" class="form-control" rows="3"
                                placeholder="{{ __('form.placeholder_caption') }}"></textarea>
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
                            <textarea id="meta_description" name="meta_description" class="form-control" rows="3"
                                      placeholder="{{ __('form.placeholder_meta_description') }}"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta_keyword">{{ __('form.meta_keyword') }}</label>
                            <textarea id="meta_keyword" name="meta_keyword" class="form-control" rows="3"
                                      placeholder="{{ __('form.placeholder_meta_keyword') }}"></textarea>
                        </div>
                        <div class="form-group">
                            <label>{{ __('form.visibility') }}</label>
                            <select id="visibility" class="form-control" name="post_visibility">
                                @if(old('post_visibility') == "private")
                                    <option id="public" value="public">{{ __('form.public') }}</option>
                                    <option id="private" value="private" selected>{{ __('form.private') }}</option>
                                @else
                                    <option id="public" value="public" selected>{{ __('form.public') }}</option>
                                    <option id="private" value="private">{{ __('form.private') }}</option>
                                @endif
                            </select>
                            <small class="form-text text-muted visibility-msg">
                                {{ __('form.help_public_visibility') }}
                            </small>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="publish" value="1">{{ __('button.publish') }}</button>
                            <button class="btn btn-secondary float-right" type="submit" name="draft" value="1">{{ __('button.save_draft') }}</button>
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
    @include('admin.posts._script')
    <script>
        "use strict";

        // UPLOAD IMAGE
        $(document).on('click', '.upload-msg', function() {
            $("#upload").trigger("click");
        });

        $('#reset').on("click", function() {
            $('#display').removeAttr('hidden');
            $('#reset').attr('hidden');
            $('.upload-photo').removeClass('ready result');
            $('#image_preview_container').attr('src', '#');
            $('#upload')[0].value = '';
        });

        function readFile(input) {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('.upload-photo').addClass('ready');
                $('#image_preview_container').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

        $('#upload').on('change', function() {
            readFile(this);
        });
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
