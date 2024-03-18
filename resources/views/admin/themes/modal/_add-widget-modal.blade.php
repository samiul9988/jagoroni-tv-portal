<div class="modal fade" id="add-widget-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('title.add_widget') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="_awm_widget_name" name="widget_name">
                <input type="hidden" id="_awm_widget_type" name="widget_type">
                <div class="form-group">
                    <label for="name">{{ __('form.widget') }}</label>
                    <select id="_aw_widget_name" class="form-control" name="type"></select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button id="close-button" type="button" class="btn btn-default" data-dismiss="modal">{{ __('button.close') }}</button>
                <button id="add-widget-submit" type="submit" class="btn btn-primary">{{ __('button.add') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
