<script>
    "use strict";

    // CUSTOM PERMALINKS
    $(document).on('click', '#customPermalink', function(){
        $(this).text(function(i,o){
            return o == "{!! __('button.no_custom_permalink') !!}" ?  "{{ __('button.use_custom_permalink') }}" : "{!! __('button.no_custom_permalink') !!}";
        });
        $('#slugPost').prop('disabled', (i, v) => !v);
    });

    // VISIBILITY
    $(document).on('change', '#visibility', function(){
        let indexVisible = document.getElementById("visibility").selectedIndex;
        let info = []
        info[0] = "{{ __('form.help_public_visibility') }}";
        info[1] = "{{ __('form.help_private_visibility') }}";
        $(".visibility-msg").html(info[indexVisible]);
    });

    // SELECT LANGUAGE
    $('#language').select2({
        minimumResultsForSearch: -1,
        theme: 'bootstrap4'
    });

    $('#language').on('select2:select', function (e) {
        let id = e.params.data.id;
        $('#language').val(id);
    });


    // EDITOR

    const bodyElement = document.querySelector('body');
    const darkMode = document.querySelector('li.adminlte-darkmode-widget');

    const useDarkMode = bodyElement.classList.contains('dark-mode');

    let skin = useDarkMode ? 'magz-dark' : 'tinymce-5';
    let contentCss = useDarkMode ? 'magz-dark' : 'tinymce-5';

    addTiny(skin, contentCss);

    darkMode.addEventListener('click', () => {
        const useDarkMode = bodyElement.classList.contains('dark-mode');
        tinymce.remove();
        skin = useDarkMode ? 'magz-dark' : 'tinymce-5';
        contentCss = useDarkMode ? 'magz-dark' : 'tinymce-5';

        addTiny(skin, contentCss);
    });

    function addTiny(skin = null, contentCss = null){
        tinymce.init({
            selector: 'textarea[name=post_summary]',
            skin: skin,
            content_css: contentCss,
            height: 200,
            branding: false,
            toolbar: 'bold italic underline removeformat strikethrough blockquote codeformat link superscript subscript',
            menubar: false,
        });

        tinymce.init({
            selector: 'textarea[name=post_content]',
            valid_children: '+body[style],+body[style]>p[style],+body[style]>p[style]>span,*[class]',
            extended_valid_elements: 'iframe[class=responsive-iframe|title|src|frameborder="0"|allowfullscreen], div[class|id]',
            skin: skin,
            content_css: contentCss,
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough removeformat  | code codesample | alignleft aligncenter alignright |' +
                'fontfamily fontsize blocks | outdent indent | ltr rtl | numlist bullist | forecolor backcolor | pagebreak insertfile image media link anchor | fullscreen  preview',
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            importcss_append: true,
            image_class_list: [
                {title: '', value: 'figure-img img-fluid'},
            ],
            style_formats : [
                {title : 'youtube-video', selector : 'iframe'},
            ],
            file_picker_callback (callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                tinymce.activeEditor.windowManager.openUrl({
                    url: '/file-manager/tinymce5?leftDisk=images',
                    title: 'Laravel File manager',
                    width: x * 0.8,
                    height: y * 0.8,
                    onMessage: (api, message) => {
                        let path = message.content;
                        path = path.split('/').slice(-2).join('/');
                        callback(window.location.origin+'/storage/'+path, {text: message.text, class: 'img-fluid'})
                    }
                })
            },
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'image table',
            branding: false,
            promotion: false,
            relative_urls : false,
            remove_script_host : false,
            document_base_url : "{{  url('') }}"
        });
    }
</script>
