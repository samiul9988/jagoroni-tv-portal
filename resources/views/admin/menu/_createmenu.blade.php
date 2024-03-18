<div class="card card-default">
    <form id="insert" role="form">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">{{ __('form.name') }}</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('form.placeholder_name') }}" required autofocus>
                <div class="invalid-feedback msg-error-name"></div>
            </div>
        </div>
        <div class="card-footer">
            <button id="btn-cancel" type="button" class="btn btn-warning" hidden>{{ __('button.cancel') }}</button>
            <button id="btn-submit" type="submit" class="btn btn-info float-right">{{ __('button.create') }}</button>
        </div>
    </form>
</div>
