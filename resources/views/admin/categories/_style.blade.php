<style>
    .upload-msg {
        min-height: 4.75em;
        font-size: inherit;
        color: #aaa;
        border: 3px dashed #dbdeea;
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

    .upload-image.ready #display {
        display: block;
    }

    .upload-image.ready .buttons #reset {
        display: inline;
    }

    .upload-image #display,
    .upload-image .buttons #reset,
    .upload-image.ready .upload-msg {
        display: none;
    }

    .hide {
        display: none;
    }
</style>
@include('layouts.partials._dark-css')