<div class="card card-default">
    <form id="insert" role="form" enctype="multipart/form-data">
        @csrf
        <input id="categoryLanguage" type="hidden" name="language" value="{{ \App\Helpers\LocalizationHelper::getCurrentLocaleAuthdId() }}">
        <div class="card-body">
            <div class="form-group">
                <label for="name">{{ __('form.name') }}</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       id="name"
                       placeholder="{{ __('form.placeholder_name') }}"
                       required autofocus>
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="parent">{{ __('form.parent') }}</label>
                <select id="parent"
                        name="parent"
                        class="select2"
                        data-placeholder="{{ __('form.parent') }}"
                        style="width: 100%;"></select>
            </div>
            <div class="form-group">
                <label for="name">{{ __('form.description') }}</label>
                <textarea name="description"
                          class="form-control"
                          rows="3"
                          placeholder="{{ __('form.placeholder_description') }}"
                          id="description"></textarea>
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <p>
                    <button type="button" class="btn btn-info btn-sm" id="translation" onclick="showTranslation()" disabled>
                        {{ __('button.add_translation') }}
                    </button>
                </p>
                <div id="container-translation"></div>
            </div>
            <div class="form-group">
                <label for="image">{{ __('form.image') }}</label>
                <div class="upload-image" id="uploadImage">
                    <input id="upload" type="file" name="image" value="{{ __('form.choose_a_file') }}" accept="image/*"
                           data-role="none" hidden>
                    <input type="hidden" name="isupload">
                    <div class="col-md-12">
                        <div class="upload-msg">{{ __('form.placeholder_image') }}</div>
                        <div id="display">
                            <img id="image_preview_container" src="#" alt="{{ __('form.preview_image') }}" style="width: 100%;">
                        </div>
                        <div class="buttons text-center mt-3">
                            <button id="reset" type="button" class="reset btn btn-sm btn-danger">{{ __('button.remove') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button id="btn-reset" type="button" class="btn btn-warning" hidden>{{ __('button.cancel') }}</button>
            <button id="btn-submit" type="submit" class="btn btn-info float-right">{{ __('button.add_new_category') }}</button>
        </div>
    </form>
</div>
