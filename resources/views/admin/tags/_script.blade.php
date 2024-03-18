<script>
    "use strict";

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

        $.each(JSON.parse(data), function(i, item) {
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
        $("#name").val("");
        $("#description").val("");
        $("#container-translation").html("");
        $("#btn-reset").attr("hidden", true);
        $("input[type=text]").removeClass("is-invalid");
        $(".invalid-feedback").html("");
        $("#btn-reset").attr("hidden", true);
        $("button[type=submit]").attr("id", "btn-submit").html("{{ __('button.add_new_tag') }}");

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

    $(document).on("click", "#btn-reset", function(e) {
        $(".card-form.card-title").html("{{ __('button.add_new_tag') }}");
        $("form#insert").removeAttr("href");
        $("#name").removeClass("is-invalid");
        $(".msg-error-name").html("");
        clearBox();
    });

    $(document).on("click", "#btn-submit-update", function(e) {
        e.preventDefault();
        $("#update button[type=submit]").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{  __('button.loading') }}</span></div> {{  __('button.sending') }}");
        $("input").removeClass("is-invalid")
        $(".invalid-feedback").html("");

        var data = new FormData($('#insert')[0]);
        data.append('_method', 'PUT');

        let editurl = $("form#insert").attr("href");
        $.ajax({
            url: editurl,
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                if (response.errors) {
                    $.each(response.errors.data, function (i, j) {
                        if (j.trans) {
                            $("#name").addClass("is-invalid");
                            $(".msg-error-name").html(j.trans.name);
                        } else {
                            $.each(j.validateTrans, function (k, l) {
                                let id = l.error_lang;
                                $("#translation-"+id).addClass("is-invalid");
                                $(".msg-error-translation-"+id).html(l.error_translation);
                            });
                        }
                    });
                } else {
                    $(".spinner-grow").attr("hidden");
                    notification(response);
                    $("#tag-table").DataTable().ajax.reload();
                    $("input[type=text]").val("");
                    $("#description").val("");
                    $("#insert button[type=submit]").html("{{ __('button.add_new_tag') }}");
                    $("#update").attr("id", "insert");
                    $("#btn-reset").attr("hidden", true);
                    clearBox();
                }
            }
        });
    });

    $(document).on("click", "#btn-submit", function(e) {
        e.preventDefault();
        $("#insert button[type=submit]").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{  __('button.loading') }}</span></div> {{  __('button.sending') }}");
        $("#name").removeClass("is-invalid")
        $(".msg-error-name").html("");

        let lang = $("#custom-filter").val();

        $.ajax({
            url: "{{ route('tags.store') }}",
            method: 'POST',
            data: $("#insert").serialize(),
            success: function(response) {
                if (response.errors) {
                    $.each(response.errors.data, function (i, j) {
                        if (j.trans) {
                            $("#name").addClass("is-invalid");
                            $(".msg-error-name").html(j.trans.name);
                        } else {
                            $.each(j.validateTrans, function (k, l) {
                                let id = l.error_lang;
                                $("#translation-"+id).addClass("is-invalid");
                                $(".msg-error-translation-"+id).html(l.error_translation);
                            });
                        }
                    });

                    $("#insert button[type=submit]").html("{{ __('button.resending') }}");
                    $("#btn-reset").removeAttr("hidden");
                } else {
                    $(".spinner-grow").attr("hidden");
                    notification(response);
                    $("#tag-table").DataTable().ajax.reload();
                    $("input[type=text]").val("");
                    $("#description").val("");
                    $("#insert button[type=submit]").html("{{ __('button.add_new_tag') }}");
                    clearBox();
                }
            }
        });
    });
</script>
