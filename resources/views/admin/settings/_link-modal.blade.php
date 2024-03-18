<!-- Modal -->
<div class="modal fade" id="add-link-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="linkForm" method="POST" role="form">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('title.add_link') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="link-name">{{ __('form.label') }}</label>
                        <input type="text" name="name" class="form-control" id="link-label" placeholder="{{ __('form.placeholder_link_label') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="link-url">{{ __('form.url') }}</label>
                        <input type="text" name="url" class="form-control" id="link-url" placeholder="{{ __('form.placeholder_link_url') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="link-icon">{{ __('form.icon') }}</label>
                        <div class="input-group mb-3">
                            <input type="text" name="icon" class="form-control icp icp-auto" id="link-icon" data-placement="bottomRight" placeholder="{{ __('form.placeholder_link_icon') }}" aria-label="fa-solid fa-link" aria-describedby="basic-addon2" value="fa-solid fa-link">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="link-color">{{ __('form.color') }}</label>
                        <div id="cp2" class="input-group">
                            <input type="text" id="link-color" name="color" class="form-control" value="#666" placeholder="{{ __('form.placeholder_link_color') }}"/>
                            <span class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                            </span>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button id="close-button" type="button" class="btn btn-default" data-dismiss="modal">{{ __('button.close') }}</button>
                    <button id="submitAddLink" type="button" class="btn btn-primary">{{ __('button.add') }}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>