<div class="modal fade" id="edit-widget-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Widget Modal Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="widgetModalForm" method="POST" name="widget_modal_form" role="form" enctype="multipart/form-data">
                <input type="hidden" id="_wm_theme" name="theme">
                <input type="hidden" id="_wm_slug" name="slug">
                <input type="hidden" id="_wm_layout" name="layout">
                <input type="hidden" id="_wm_column" name="column">
                <input type="hidden" id="_wm_type" name="type">
                <input type="hidden" id="_wm_type_name" name="typeName">
                <input type="hidden" id="_wm_widget" name="widget">
                @method('PUT')
                @csrf
                <div class="modal-body"></div>
                <div class="modal-footer justify-content-between">
                    <button id="close-button" type="button" class="btn btn-default" data-dismiss="modal">{{ __('button.close') }}</button>
                    <button id="widget-modal-button" type="submit" class="btn btn-primary">{{ __('button.save') }}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
