<script>
    "use strict";

    // SELECT FLAG **^
    $(document).on("click", ".list-flags li", function(e) {
        if (!$(this).hasClass('active')) {
            $('.list-flags li.active').removeClass('active');
            $(this).addClass('active');
        }
    });
    // END SELECT FLAG....................................................

    // SET CONTACT DESCRIPTION ***
    $(document).on("click", ".list-flags li.list-inline-item", function(e) {
        let lang = $(this).data('lang');

        if (!$(this).hasClass('input-contact-desc-' + lang)) {
            $('#contact_desc_el textarea').attr('hidden', true);
        }

        if ($('#contact_desc_el textarea').hasClass('input-contact-desc-' + lang)) {
            $('#contact_desc_el textarea.input-contact-desc-' + lang).removeAttr('hidden');
        } else {
            $('#contact_desc_el').append('<textarea id="contactdescription" name="contact_description[' + lang + ']" class="form-control contact_description input-contact-desc-' + lang + '" rows="3"></textarea>');
        }
    });
    // SET CONTACT DESCRIPTION.......................................

    $(document).on("change", "#default_language", function(e) {
        e.preventDefault();
        let dataLangCode = $('select#default_language').find(':selected').val() //get code;
        $.ajax({
            type: "PATCH",
            dataType: "json",
            url: "/admin/settings/change-default-language",
            data: {
                'code': dataLangCode
            },
            success: function(response) {
                toastr.success(response.success);
                $("#default_language").select2("val", "");
            }
        })
    });

    function readImage(input) {
        let reader = new FileReader();
        let name = $(input).attr('name');
        reader.onload = (e) => {
            $('#image_preview_'+name).attr('src', e.target.result).removeClass('d-none');
            $('#image_'+name).hide();
        }
        reader.readAsDataURL(input.files[0]);
    }

    $(function() {
        bsCustomFileInput.init()
    });

    let editor = CodeMirror.fromTextArea(document.getElementById("credit_footer"), {
        mode: "htmlmixed",
        styleActiveLine: true,
        lineNumbers: true,
        lineWrapping: true,
        matchBrackets: true
    });
    editor.setSize(null, 100);
    editor.on('change', (editor) => {
        const text = editor.doc.getValue()
        $('#credit_footer').html(text);
    });

    $(document).on("click", "#submit-web-properties", function(e) {
        e.preventDefault();
        $("#submit-web-properties").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading') }}</span></div> {{ __('message.sending') }}");
        $.ajax({
            url: "{{ route('settings.update') }}",
            method: "PATCH",
            data: $("#form-web-information").serialize(),
            success: function(response) {
                if (response.errors) {
                    $(".spinner-grow").attr("hidden", true);
                    $("#submit-web-properties").html("{{ __('button.save') }}");
                    toastr.error(response.errors);
                } else if (response.info) {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.info(response.info);
                    $("#submit-web-properties").html("{{ __('button.save') }}");
                } else {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.success(response.success);
                    $("#submit-web-properties").html("{{ __('button.save') }}");
                }
            }
        });
    });

    $(document).on("click", "#submit-web-contact", function(e) {
        e.preventDefault();
        $("#submit-web-contact").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading') }}</span></div> {{ __('message.sending') }}");
        $("#name").removeClass("is-invalid")
        $(".msg-error-name").html("");
        $.ajax({
            url: "{{ route('settings.update') }}",
            method: "POST",
            data: $("#form-web-contact").serialize(),
            success: function(response) {
                if (response.errors) {
                    $(".spinner-grow").attr("hidden", true);
                    $("#submit-web-contact").html("{{ __('button.save') }}");
                    toastr.error(response.errors);
                } else if (response.info) {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.info(response.info);
                    $("#submit-web-contact").html("{{ __('button.save') }}");
                } else {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.success(response.success);
                    $("#submit-web-contact").html("{{ __('button.save') }}");
                }
            }
        });
    });

    $(document).on("click", "#submit-web-permalinks", function(e) {
        e.preventDefault();
        $("#submit-web-permalinks").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading') }}</span></div> {{ __('message.sending') }}");
        $("#name").removeClass("is-invalid")
        $(".msg-error-name").html("");
        $.ajax({
            url: "{{ route('settings.update') }}",
            method: "POST",
            data: $("#form-web-permalinks").serialize(),
            success: function(response) {
                if (response.errors) {
                    $(".spinner-grow").attr("hidden", true);
                    $("#submit-web-permalinks").html("{{ __('button.save') }}");
                    toastr.error(response.errors);
                } else if (response.info) {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.info(response.info);
                    $("#submit-web-permalinks").html("{{ __('button.save') }}");
                } else {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.success(response.success);
                    $("#submit-web-permalinks").html("{{ __('button.save') }}");
                }
            }
        });
    });

    $(document).on("change", "#number_nested_comments", function(e) {
        e.preventDefault();
        let dataNumberNestedComments = $('select#number_nested_comments').find(':selected').val() //get code;
        $.ajax({
            type: "PATCH",
            dataType: "json",
            url: "/admin/settings/change-number-nested-comment",
            data: {
                'number_nested_comments': dataNumberNestedComments
            },
            success: function(response) {
                toastr.success(response.success);
                $("#number_nested_comments").select2("val", "");
            }
        })
    });

    $(document).on("change", "#commentReqApproval", function(e) {
        let active = $(this).prop("checked") == true ? "y" : "n";
        $.ajax({
            type: "PATCH",
            dataType: "json",
            url: "/admin/settings/change-comment-req-approval",
            data: {
                "active": active
            },
            success: function(data) {
                if(data.info) {
                    toastr.info(data.info);
                } else {
                    toastr.success(data.success);
                }
            }
        })
    });

    $(document).on("change", "#sendCommentReplyEmail", function(e) {
        let active = $(this).prop("checked") == true ? "y" : "n";
        $.ajax({
            type: "PATCH",
            dataType: "json",
            url: "/admin/settings/change-send-comment-reply-email",
            data: {
                "active": active
            },
            success: function(data) {
                if(data.info) {
                    toastr.info(data.info);
                } else {
                    toastr.success(data.success);
                }
            }
        })
    });

    $(document).on("change", "#customSwitch1", function(e) {
        let active = $(this).prop("checked") == true ? "y" : "n";
        $.ajax({
            type: "PATCH",
            dataType: "json",
            url: "/admin/settings/changeStatusMaintenance",
            data: {
                "active": active
            },
            success: function(data) {
                if(data.info) {
                    toastr.info(data.info);
                } else {
                    toastr.success(data.success);
                }
            }
        })
    });

    $(document).on("change", "#customSwitch2", function(e) {
        let active = $(this).prop("checked") == true ? "y" : "n";
        $.ajax({
            type: "PATCH",
            dataType: "json",
            url: "/admin/settings/changeRegisterMember",
            data: {
                "active": active
            },
            success: function(data) {
                if(data.info) {
                    toastr.info(data.info);
                } else if(data.success){
                    toastr.success(data.success);
                }else{
                    toastr.error(data.abort);
                }
            }
        })
    });

    $(document).on("change", "#customSwitch3", function(e) {
        let active = $(this).prop("checked") == true ? "y" : "n";
        $.ajax({
            type: "PATCH",
            dataType: "json",
            url: "/admin/settings/change-active-email-verification",
            data: {
                "active": active
            },
            success: function(data) {
                if(data.info) {
                    toastr.info(data.info);
                } else if(data.success){
                    toastr.success(data.success);
                }else{
                    toastr.error(data.abort);
                }
            }
        })
    });

    $(document).on("change", "#switchDisplayLanguage", function(e) {
        let active = $(this).prop("checked") == true ? "y" : "n";
        $.ajax({
            type: "PATCH",
            dataType: "json",
            url: "/admin/settings/switch-display-language",
            data: {
                "active": active
            },
            success: function(data) {
                if(data.info) {
                    toastr.info(data.info);
                } else if(data.success){
                    toastr.success(data.success);
                }else{
                    toastr.error(data.abort);
                }
            }
        })
    });

    // SET PERMALINKS **

    function setConfig() {
        let obj = $(this),
        value = $(this).val(),
        key = $(this).attr('name');
        $(this).closest('.icheck-primary').append('<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>');

        let data;
        if (value == 'custom') {
            data = {
                "key": key,
                "value": value,
                "custom": $(this).closest('.icheck-primary').find('.form-control-custom').val()
            }
        } else {
            data = {
                "key": key,
                "value": value
            }
        }
        
        $.ajax({
            type: "PATCH",
            dataType: "json",
            url: "/admin/settings/set-config",
            data: data
        })
        .done(function(data) {
            obj.closest('.icheck-primary').children('div.spinner-border').remove();

            if(data.info) {
                toastr.info(data.info);
            } else if(data.success){
                toastr.success(data.success);
            }else{
                toastr.error(data.abort);
            }
        })
    }

    $(document).on("click", "input[name=page_permalink_type]", setConfig);
    $(document).on("click", "input[name=category_permalink_type]", setConfig);
    $(document).on("click", "input[name=permalink_type]", setConfig);

    $('.form-control-custom').blur(function (e) {
        const isPrefixCustom = $('#custom').is(':checked');

        if ( isPrefixCustom ) {
            let value = $('.form-control-custom').val(),
            data = {
                "key": 'permalink',
                "value": value
            }

            $('.form-control-custom').closest('.icheck-primary').append('<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>');

            $.ajax({
                type: "PATCH",
                dataType: "json",
                url: "/admin/settings/set-config",
                data: data
            })
            .done(function(data) {
                $('.form-control-custom').closest('.icheck-primary').children('div.spinner-border').remove();

                if(data.info) {
                    toastr.info(data.info);
                } else if(data.success){
                    toastr.success(data.success);
                }else{
                    toastr.error(data.abort);
                }
            })
        }
    })
    // END SET PERMALINKS **

    $(document).ready(() => {
        let url = location.href.replace(/\/$/, "");

        if (location.hash) {
            const hash = url.split("#");
            $('#vert-tabs-tab a[href="#' + hash[1] + '"]').tab("show");
            url = location.href.replace(/\/#/, "#");
            history.replaceState(null, null, url);
            setTimeout(() => {
                $(window).scrollTop(0);
            }, 400);
        }

        $('a[data-toggle="pill"]').on("click", function() {
            let newUrl;
            const hash = $(this).attr("href");
            newUrl = url.split("#")[0] + hash;
            newUrl += "/";
            history.replaceState(null, null, newUrl);
        });
    });

    $('input[type=file]#InputFileBackup').change(function(){
        if($('input[type=file]#inputFileBackup').val()==''){
            $('button#uploadFileBackup').attr('disabled',true)
        }
        else{
            $('button#uploadFileBackup').attr('disabled',false);
        }
    })

    $(document).on("click", "#btn-export", function(e) {
        e.preventDefault();
        $("#btn-export").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading') }}</span></div> {{ __('message.sending') }}");
        $.ajax({
            url: "{{ route('export') }}",
            method: "GET",
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response){
                let name = "{{ config('retenvi.app_name') }}";
                let version = "{{ config('retenvi.version') }}";
                let ext = ".xlsx";
                let filename = name + "-v" + version + ext;
                let blob = new Blob([response]);
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename;
                link.click();
                $(".spinner-grow").attr("hidden", true);
                $("#btn-export").html("<i class='fas fa-file-excel'></i> {{ __('button.download_data') }}");
            }
        });
    })

    $(document).on("click", "#btn-export-storage", function(e) {
        e.preventDefault();
        $("#btn-export-storage").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading') }}</span></div> {{ __('message.sending') }}");
        $.ajax({
            url: "{{ route('export.storage') }}",
            method: "GET",
            cache: false,
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response){
                let name = "{{ config('retenvi.app_name') }}";
                let version = "{{ config('retenvi.version') }}";
                let ext = "storage.zip";
                let filename = name + "-v" + version + "-" + ext;
                let blob = new Blob([response]);
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename;
                link.click();
                $(".spinner-grow").attr("hidden", true);
                $("#btn-export-storage").html("<i class='fas fa-file-excel'></i> {{ __('button.download_data') }}");
            }
        });
    })

    $(document).on("click", "#uploadFileBackup", function(e) {
        e.preventDefault();
        $("#uploadFileBackup").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading')}}</span></div> {{ __('message.sending') }}");
        let url = $("#formUploadImport").attr("action");
        var form = $('#formUploadImport')[0];
        var data = new FormData(form);
        $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            enctype: "multipart/form-data",
            url: url,
            data: data,
            success: function(response) {
                $(".spinner-grow").attr("hidden", true);
                $("#formUploadImport")[0].reset();
                $("#uploadFileBackup").html("{{__('button.upload')}}");
                if (response.errors) {
                    toastr.error(response.errors.import);
                } else if (response.info) {
                    toastr.info(response.info);
                } else {
                    toastr.success(response.success);
                }
            }
        })
    })

    $(function () {
        $('.icp-auto').iconpicker();
        $('#cp2').colorpicker();
    });

    $('#addLink').on('click', function(){
        $('#add-link-modal').modal('show');
    });

    $('#add-link-modal').on('hidden.bs.modal', function (event) {
        $('#linkForm')[0].reset();
    });

    $('#submitAddLink').on('click', function(){
        $('#add-link-modal').modal('hide');
        let data = {
            "name": $('#name').val(),
            "url": $('#url').val(),
            "icon": $('#icon').val(),
            "color": $('#color').val(),
        }

        $.ajax({
            type: 'POST',
            url: '/admin/createdatalink',
            data: data,
            dataType: 'json',
            success: function(data) {
                let linkData = data.data;

                $('#add-link-modal #name, #add-link-modal #url').val('');
                $('#add-link-modal #icon').val('fas fa-link');
                $('#add-link-modal #color').val('#666666');

                if (data.success) {
                    toastr.success(data.success);
                    let itemHtml = "";
                    linkData.forEach((item) => {
                        itemHtml +=
                            `<div class="col-lg-6 mb-3" id="link${item.id}">
                                <div class="form-group">
                                    <label>${item.name}</label>
                                    <div class="input-group">
                                        <input type="hidden" name="id" value="${item.id}">
                                        <div class="input-group-prepend"><span class="input-group-text"> <i class="${item.icon}"></i></span></div>
                                        <input type="text" name="link" class="bg-link-input form-control" placeholder="http://www.example.com" value="${item.url}" title="${item.url}" readonly>
                                        <div class="input-group-append" onclick="removeInput(${item.id})" style="cursor:pointer">
                                            <span class="input-group-text"><i class="fas fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });

                    $(".links").html(itemHtml);
                } else {
                    toastr.error("{{ __('message.failed_to_save') }}");
                }
            }
        });
    });

    function removeInput(id) {
        $.ajax({
            url: "/admin/links/"+id+"/site",
            type: 'DELETE',
            data: {
                "id": id
            },
            success: function (response){
                document.getElementById("link" + id).remove();
                notification(response);
            }
        });
    }
</script>
