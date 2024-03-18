 <style>
    .bg-link-input {
        background: #fff!important;
    }

    label.custom-control-label {
        font-weight: 500!important;
    }
    
    /* DropZone CSS */
    .dropzone {
        overflow-y: auto;
        border: 0;
        background: transparent;
    }
    .dz-preview {
        width: 100%;
        margin: 0 !important;
        height: 100%;
        padding: 15px;
        position: absolute !important;
        top: 0;
    }
    .dz-photo {
        height: 100%;
        width: 100%;
        overflow: hidden;
        border-radius: 12px;
        background: #eae7e2;
    }
    .dz-drag-hover .dropzone-drag-area {
        border-style: solid;
        border-color: #86b7fe;;
    }
    .dz-thumbnail {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .dz-image {
        width: 90px !important;
        height: 90px !important;
        border-radius: 6px !important;
    }
    .dz-remove {
        display: none !important;
    }
    .dz-delete {
        width: 24px;
        height: 24px;
        background: rgba(0, 0, 0, 0.57);
        position: absolute;
        opacity: 0;
        transition: all 0.2s ease;
        top: 30px;
        right: 30px;
        border-radius: 100px;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .dz-delete > svg {
        transform: scale(0.75);
        cursor: pointer;
    }
    .dz-preview:hover .dz-delete, 
    .dz-preview:hover .dz-remove-image {
        opacity: 1;
    }
    .dz-message {
        height: 100%;
        margin: 0 !important;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .dropzone-drag-area {
        height: 200px;
        position: relative;
        padding: 0 !important;
        border-radius: 10px;
        border: 3px dashed #dbdeea;
    }
    .was-validated .form-control:valid {
        border-color: #dee2e6 !important;
        background-image: none;
    }
    button.dz-delete.border-0.p-0, svg#times, svg#times path{
        cursor: pointer;
    }
    .del-img {
        width: 24px;
        height: 24px;
        background: rgba(0, 0, 0, 0.57);
        position: absolute;
        opacity: 0;
        transition: all 0.2s ease;
        top: 40px;
        right: 15px;
        border-radius: 100px;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .img-viewer:hover .del-img {
        opacity: 1;
    }
    .img-viewer {
        border: 3px dashed #dbdeea;
        padding: 20px;
    }
</style>

@include('layouts.partials._dark-css')