<script>
    "use strict";

    // UPLOAD IMAGE

    const element = document.querySelector(".upload-image");
    $('input[name=isupload]').val(element.classList.contains("ready"));

    $(document).on('click', '.upload-msg', function() {
        $("#upload").trigger("click");
    });

    $(document).on('click', '#reset', function() {
        resetFileUpload();
    });

    function resetFileUpload() {
        $('#display').removeAttr('hidden');
        $('#reset').attr('hidden');
        $('.upload-image').removeClass('ready result');
        $('#image_preview_container').attr('src', 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D');
        $('#upload')[0].value = '';
        $('input[name=isupload]').val("remove");
    }

    function readFile(input) {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('.upload-image').addClass('ready');
            $('#image_preview_container').attr('src', e.target.result);
            $('input[name=isupload]').val("true");
        };
        reader.readAsDataURL(input.files[0]);
    }

    $(document).on('change', '#upload', function() {
        readFile(this);
    });

    // SELECT CATEGORY
    $('#parent').select2({
        theme: 'bootstrap4',
        allowClear: true,
        ajax: {
            url: "{{ route('api.categories.search') }}",
            dataType: 'json',
            data: function (params) {
                let query = {
                    q: params.term,
                    lang: $('#custom-filter').val()
                }
                return query;
            },
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.name
                        }
                    })
                }
            },
            cache: true
        }
    });

    var items = "";
    $.getJSON("{{ route('getdatalanguage') }}", function (result) {
        $.each(result, function (i, item) {
            if (item.id == "{{ Auth::user()->language }}") {
                items += "<option value='" + item.id + "' selected>" + item.name + "</option>";
            } else {
                items += "<option value='" + item.id + "'>" + item.name + "</option>";
            }
        });
        $("#custom-filter").html(items);
    });

    function hideTranslation(name) {
        $("#hide-translation").html("{{ __('button.add_translation') }}");

        if (name) {
            $('#container-translation').empty();
            $("#hide-translation").attr('onclick', 'showTranslation(' + JSON.stringify(name) + ')');
        } else {
            $('#container-translation').empty();
            $("#hide-translation").attr("onclick", "showTranslation()");
        }

        $("#hide-translation").attr("id", "translation");
    }

    function showTranslation(name) {
        let lang = $("#custom-filter").val();
        let data = '{!! $languages !!}';

        $("#translation").html("{{ __('button.hide_translation') }}");

        if (name) {
            $("#translation").attr('onclick', 'hideTranslation(' + JSON.stringify(name) + ')');
        } else {
            $("#translation").attr("onclick", "hideTranslation()");
        }

        $("#translation").attr("id", "hide-translation");

        let html = [];

        $.each(JSON.parse(data), function (i, item) {
            if (item.id != lang) {
                html[i] = '<div class="input-group mb-3">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text text-code-' + item.language + '">' +
                    item.language.toUpperCase() +
                    '</span>' +
                    '</div>';
                if (name) {
                    if (name[item.language]) {
                        html[i] += '<input type="text" id="translation-' + item.language + '" class="form-control" name="translation[' + item.language + ']" placeholder="' + item.name + '" value="' + name[item.language] + '">'
                    } else {
                        html[i] += '<input type="text" id="translation-' + item.language + '" class="form-control" name="translation[' + item.language + ']" placeholder="' + item.name + '">'
                    }
                } else {
                    html[i] += '<input type="text" id="translation-' + item.language + '" class="form-control" name="translation[' + item.language + ']" placeholder="' + item.name + '">'
                }
                html[i] += ' <div class="invalid-feedback msg-error-translation-' + item.language + '"></div>';
                html[i] += '</div>';
            }
        });
        $('#container-translation').empty().append(html);
    }

    function clearBox() {
        $("input[type=text]").val("");
        $("#parent").html("");
        $("#description").val("");
        $("#container-translation").html("");
        $("#btn-reset").attr("hidden", true);
        $("input[type=text]").removeClass("is-invalid");
        $(".invalid-feedback").html("");
        $("#btn-reset").attr("hidden", true);
        $("button[type=submit]").attr("id", "btn-submit").html("{{ __('button.add_new_category') }}");
        $('input[type="file"]').val('').clone(true);

        if (document.getElementById('hide-translation')) {
            $("#hide-translation").attr("onclick", "showTranslation()");
            $("#hide-translation").html("{{ __('button.add_translation') }}");
            $("#hide-translation").attr("id", "translation");
        }
    }

    function changeValLang() {
        let lang = $("#custom-filter").val();
        $("input[name=language]").val(lang);
    }

    document.querySelector('button#btn-reset').addEventListener('click', () => {
        $(".card-form.card-title").html("{{ __('button.add_new_category') }}");
        $("form#insert").removeAttr("href");
        $("#description").val("");
        $("input[type=text]").val("");
        $("#name").removeClass("is-invalid");
        $(".msg-error-name").html("");
        $("#btn-reset").attr("hidden", true);
        $("button[type=submit]").attr("id", "btn-submit").html("{{ __('button.add_new_category') }}");
        clearBox();
        resetFileUpload();
    });

    $(document).on("click", "#btn-submit-update", function (e) {
        e.preventDefault();
        $("#update button[type=submit]").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('app.loading') }}</span></div> {{ __('app.sending') }}");
        $("input").removeClass("is-invalid")
        $(".invalid-feedback").html("");

        let editurl = $("form#insert").attr("href"),
        data = new FormData($('#insert')[0]);
        data.append('_method', 'PUT');

        $.ajax({
            url: editurl,
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function (response) {
                if (response.errors) {
                    $.each(response.errors.data, function (i, j) {
                        if (j.trans) {
                            $('#name').addClass('is-invalid').next('.invalid-feedback').html(j.trans.name);
                        } else {
                            $.each(j.validateTrans, function (k, l) {
                                let id = l.error_lang;
                                $("#translation-"+id).addClass('is-invalid').next('.invalid-feedback').html(l.error_translation);
                            });
                        }
                    });
                } else {
                    $(".spinner-grow").attr("hidden");
                    notification(response);
                    $("#category-table").DataTable().ajax.reload();
                    $("input[type=text]").val("");
                    $("#description").val("");
                    $("#insert button[type=submit]").html("{{ __('button.add_new_category') }}");
                    $("#update").attr("id", "insert");
                    $("#btn-reset").attr("hidden", true);
                    clearBox();
                    resetFileUpload();
                }
            }
        });
    });

    $(document).on("click", "#btn-submit", function (e) {
        e.preventDefault();
        $("#btn-submit").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading') }}</span></div> {{ __('message.sending') }}");
        $("input").removeClass("is-invalid")
        $(".invalid-feedback").html("");

        let form  = $("#insert")[0];
        let formData = new FormData(form);

        $.ajax({
            url: "{{ route('categories.store') }}",
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                if (response.errors) {
                    $.each(response.errors.data, function (i, j) {
                        if (j.trans) {
                            $('#name').addClass('is-invalid').next('.invalid-feedback').html(j.trans.name);
                        } else {
                            $.each(j.validateTrans, function (k, l) {
                                let id = l.error_lang;
                                $("#translation-"+id).addClass('is-invalid').next('.invalid-feedback').html(l.error_translation);
                            });
                        }
                    });

                    $("#insert button[type=submit]").html("{{ __('button.resending') }}");
                    $("#btn-reset").removeAttr("hidden");
                } else {
                    $(".spinner-grow").attr("hidden");
                    notification(response);
                    $("#category-table").DataTable().ajax.reload();
                    $("input[type=text]").val("");
                    $("#description").val("");
                    $("#insert button[type=submit]").html("{{ __('button.add_new_category') }}");
                    clearBox();
                    resetFileUpload();
                }
            }
        });
    });
</script>
