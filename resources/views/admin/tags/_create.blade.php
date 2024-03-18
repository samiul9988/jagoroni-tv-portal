<div class="card card-default">
    <form id="insert" role="form">
        @csrf
        <input id="tagLanguage" type="hidden" name="language" value="{{ $language }}">
        <div class="card-body">
            <div class="form-group">
                <label for="name">{{ __('form.name') }}</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('form.placeholder_name') }}" required autofocus>
                <div class="invalid-feedback msg-error-name"></div>
            </div>
            <div class="form-group">
                <label for="name">{{ __('form.description') }}</label>
                <textarea name="description" class="form-control" rows="3" placeholder="{{ __('form.placeholder_description') }}" id="description"></textarea>
                <div class="invalid-feedback msg-error-description"></div>
            </div>
            <div class="form-group">
                <p>
                    <button type="button" class="btn btn-info btn-sm" id="translation" onclick="showTranslation()" disabled>
                        {{ __('button.add_translation') }}
                    </button>
                </p>
                <div id="container-translation"></div>
            </div>
        </div>
        <div class="card-footer">
            <button id="btn-reset" type="button" class="btn btn-warning" hidden>{{ __('button.cancel') }}</button>
            <button id="btn-submit" type="submit" class="btn btn-info float-right">{{ __('button.add_new_tag') }}</button>
        </div>
    </form>
</div>
