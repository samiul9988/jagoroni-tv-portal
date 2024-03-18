@extends('adminlte::page')

@section('title', __('title.add_page_translation'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.add_page_translation') }}" currentActive="{{ __('title.translation') }}" :addLink="[__('title.pages') => route('pages.index')]"/>
@stop

@section('plugins.Flag', true)
@section('plugins.BootstrapTagInput', true)
@section('plugins.Tinymce', true)
@section('plugins.Select2', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <form action="{{ route('pages.store') }}" method="POST" role="form" enctype="multipart/form-data">
        <input type="hidden" name="id_source_post" value="{{ $page->id }}">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="titlePost">{{ __('form.title') }}</label>
                            <input id="titlePost" type="text" name="post_title"
                                   class="form-control{{ $errors->has('post_title') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('form.placeholder_title') }}" value="{{ old('post_title') }}" required autofocus>
                            @error('post_title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('form.summary') }}</label>
                            <input type="hidden" name="post_summary">
                            <textarea name="post_summary" class="form-control" rows="3" placeholder="{{ __('form.placeholder_summary') }}"></textarea>
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
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <img src="{{ asset('img/flags/4x3/'.strtolower($language->country_code).'.svg') }}" width="25">
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" value="{{ $language->name }}" disabled>
                                <input type="hidden" name="post_language" value="{{ $language->id }}">
                                <input type="hidden" id="language_id" name="language_id" value="{{ $language->id }}">
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
                                        <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" value="{{ PostHelper::showTransPostTitle($trans->id, $page->translations->first()->value) }}" disabled>
                                    </div>
                                @endif
                            @endforeach
                            <input type="hidden" name="trans_id" value="{{ $transId }}">
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
                                    <div class="upload-photo mt-3 @if(!empty($post->post_image))ready @endif">
                                        <input id="upload" type="file" name="post_image" value="{{ __('form.choose_a_file') }}" accept="image/*"
                                            data-role="none" hidden>
                                        <div class="col-md-12">
                                            <div class="upload-msg">{{ __('form.placeholder_image') }}</div>
                                            <div id="display">
                                                <img id="image_preview_container" src="{{ $image }}" alt="{{ __('form.preview_image') }}"
                                                    style="width: 100%;">
                                            </div>
                                            <small class="form-text text-muted my-3">
                                                {{ __('form.help_upload_post_image') }}
                                            </small>
                                            <div class="buttons text-center mt-3">
                                                <button id="reset" type="button"
                                                        class="reset btn btn-danger">{{ __('button.remove') }}</button>
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
                                <option id="public" value="public" selected>{{ __('form.public') }}</option>
                                <option id="private" value="private">{{ __('form.private') }}</option>
                            </select>
                            <small class="form-text text-muted visibility-msg">
                                {{ __('form.help_public_visibility') }}
                            </small>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="publish" value="{{ __('button.publish') }}">
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
    <script>
        "use strict";

        // LANGUAGE
        $("#language").select2({
            theme:"bootstrap4",
            selectOnClose: true,
            minimumResultsForSearch: -1,
            ajax: {
                url: "{{ route('getdatalanguage') }}",
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.language_code,
                                text: item.language
                            }
                        })
                    }
                }
            }
        });
    </script>
    @include('admin.pages._script')
    <script>
        "use strict";

        $(document).on('click', '.upload-msg', function() {
            $("#upload").trigger("click");
        });

        $('#reset').on("click", function() {
            $('#display').removeAttr('hidden');
            $('#reset').attr('hidden');
            $('.upload-photo').removeClass('ready result');
            $('#image_preview_container').attr('src', '#');
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
