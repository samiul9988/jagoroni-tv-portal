<div class="card card-default">
    <form id="insert" role="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="menu" value="{{ $id }}">
        <input type="hidden" name="language" value="{{ $langId }}">
        <div class="card-header">
            <h3 class="card-title">{{ __('title.add_menu_item') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" title="Info" data-toggle="modal" data-target="#modal-info">
                    <i class="fas fa-question-circle"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="url">{{ __('form.url') }}</label>
                <input type="text" name="url" class="form-control" id="url" placeholder="" required autofocus>
                <div class="invalid-feedback msg-error-url"></div>
            </div>
            <div class="form-group">
                <label for="label">{{ __('form.label') }}</label>
                <input type="text" name="label" class="form-control" id="label" placeholder="" required autofocus>
                <div class="invalid-feedback msg-error-label"></div>
            </div>
        </div>
        <div class="card-footer">
            <button id="btn-cancel" type="button" class="btn btn-warning" hidden>{{ __('button.cancel') }}</button>
            <button id="btn-submit" type="submit" class="btn btn-info float-right">{{ __('button.create_menu_item') }}</button>
        </div>
    </form>
</div>

<div class="modal fade" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-question-circle"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>URL</h5>
                <p>Category <br/> <code>- /category/slug-title</code> or <code>- /slug-title</code></p>
                <p>Page <br/> <code>- /page/slug-title</code> or <code>- /slug-title</code></p>
                <p>Link <br/> <code>- https://www.example.com/slug-title</code></p>
            </div>
            <div class="modal-footer">
                <button id="close-button" type="button" class="btn btn-default" data-dismiss="modal">{{ __('button.close') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

