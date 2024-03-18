<script>
    "use strict";

    $(document).on("click", "#btn-submit", function(e) {
        e.preventDefault();
        $("#insert button[type=submit]").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading') }}</span></div> {{ __('message.sending') }}");
        $("#name").removeClass("is-invalid")
        $(".msg-error-name").html("");

        $.ajax({
            url: "{{ route('languages.store') }}",
            method: 'POST',
            data: $("#insert").serialize(),
            success: function(response) {
                $("#language").removeClass("is-invalid")
                $("#code").removeClass("is-invalid")
                $("#insert button[type=submit]").html("{{ __('button.language_submit') }}");
                $(".msg-error-language").html('');
                $(".msg-error-code").html('');
                $("#btn-reset").attr("hidden", true);
                if (response.errors) {
                    $("#language").addClass("is-invalid")
                    $("#code").addClass("is-invalid")
                    $("#insert button[type=submit]").html("{{ __('button.resending') }}");
                    $(".msg-error-language").html(response.errors.language);
                    $(".msg-error-code").html(response.errors.code);
                } else if (response.error_exists) {
                    $(".spinner-grow").attr("hidden");
                    toastr.error(response.error_exists);
                    $("#languages-table").DataTable().ajax.reload();
                    $("input[type=text]").val("");
                    $('#language').val(null).trigger('change');
                    $('#country').val(null).trigger('change');
                    $("#insert button[type=submit]").html("{{ __('button.add_new_language') }}");
                } else {
                    $(".spinner-grow").attr("hidden");
                    notification(response);
                    $("#languages-table").DataTable().ajax.reload();
                    $("input[type=text]").val("");
                    $('#language').val(null).trigger('change');
                    $('#country').val(null).trigger('change');
                    $("#insert button[type=submit]").html("{{ __('button.add_new_language') }}");
                }
            }
        });
    });
</script>
