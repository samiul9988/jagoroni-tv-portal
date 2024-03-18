<div class="card card-default">
    <form id="insert" role="form">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="language">{{ __('form.language') }}</label>
                <select id="language" name="language" class="select2" data-placeholder="{{ __('form.placeholder_select_language') }}" style="width: 100%;">
                    <option></option>
                </select>
                <div class="invalid-feedback msg-error-language"></div>
            </div>
            <div class="form-group">
				<label for="country">{{ __('form.country') }}</label>
                <select id="country" name="country" class="select2" data-placeholder="{{ __('form.placeholder_select_country') }}" style="width: 100%;">
                    <option></option>
                </select>
                <div class="invalid-feedback msg-error-country"></div>
            </div>
        </div>
        <div class="card-footer">
            <button id="btn-submit" type="submit" class="btn btn-info float-right">{{ __('button.add_new_language') }}</button>
        </div>
    </form>
</div>
