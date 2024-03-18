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

    .upload-photo.ready #display {
        display: block;
    }

    .upload-photo.ready .buttons #reset {
        display: inline;
    }

    .upload-photo #display,
    .upload-photo .buttons #reset,
    .upload-photo.ready .upload-msg {
        display: none;
    }

    .hide {
        display: none;
    }

    #displayDateTimePublish, #closeDateTimePublish {
        cursor: pointer;
        color: #0056b3;
    }

    #displayDateTimePublish:hover, #closeDateTimePublish:hover {
        background-color: #f0f8ff;
    }

    .dark-mode #displayDateTimePublish:hover, .dark-mode #closeDateTimePublish:hover {
        background-color: #454d55;
    }

    .bgcolon {
        background-color: #fff;
    }

    .dark-mode .bgcolon {
        background-color: #343a40;
    }
</style>

@include('layouts.partials._dark-css')
