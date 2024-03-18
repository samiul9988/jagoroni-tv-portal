<style>
    .bg-link-input {
        background: #fff!important;
    }
    
    .upload-msg {
        margin: 10px auto;
        text-align: center;
        padding-left: 30px;
        padding-right: 30px;
        width: 300px;
        height: 300px;
        min-height: 4.75em;
        font-size: inherit;
        color: #aaa;
        border-radius: .5em;
        background-color: #f4f6f9;
        justify-content: center;
        display: flex;
        align-items: center;
    }

    .dark-mode .upload-msg {
        background-color: #3f474e;
    }

    .dark-mode pre {
        color: #fff;
    }

    .upload-photo.ready #display {
        display: block;
    }

    .upload-photo.result #display-i {
        background: #e1e1e1;
        width: 300px;
        padding: 50px;
        height: 300px;
        margin-bottom: 30px
    }

    .upload-photo.ready .buttons #btn-upload-result,
    .upload-photo.ready .buttons #btn-upload-reset {
        display: inline;
    }

    .upload-photo #display,
    .upload-photo .buttons #btn-upload-result,
    .upload-photo .buttons #btn-upload-reset,
    .upload-photo.ready .upload-msg {
        display: none;
    }
</style>

@include('layouts.partials._dark-css')
