<style>
    .static {
        background-color: #f4f6f9;
    }

    .static .card-title {
        color: #6c757d;
    }

    .remove-column {
        margin-top: -36px;
        margin-right: -8px;
    }

    .handle {
        cursor: move;
    }

    .upload-msg {
        text-align: center;
        padding-top: 35px;
        padding-left: 30px;
        padding-right: 30px;
        font-size: 22px;
        color: #aaa;
        height: 100px;
        margin: 10px auto;
        border: 1px solid #aaa;
    }

    .upload-image.ready #display, .upload-image.ready .buttons{
        display: block;
    }

    .upload-image #display,
    .upload-image .buttons,
    .upload-image.ready .upload-msg {
        display: none;
    }
</style>

@include('layouts.partials._dark-css')
