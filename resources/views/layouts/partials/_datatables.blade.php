@isset($dataTable)
    {{ $dataTable->scripts() }}
@endisset

<script>
    "use strict";

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
        }
    })

    // alert delete
    function sweetalert2(table, url) {
        Swal.fire({
            width: "25rem",
            title: "{{__('title.are_you_sure')}}",
            text: "{!! __('message.you_wont_be_able_to_revert_this') !!}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{__('button.yes_delete_it')}}",
            cancelButtonText: "{{__('button.cancel')}}",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: "DELETE",
                    success: function(response) {
                        if (response.success) {
                            $("#" + table).DataTable().ajax.reload();
                            Swal.fire({
                                width: "22rem",
                                title: "{{__('message.deleted')}}",
                                text: response.success,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else if (response.info) {
                            toastr.info(response.info)
                        } else if (response.error) {
                            Swal.fire({
                                width: "22rem",
                                title: "{{__('message.authorize')}}",
                                text: response.error,
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else {
                            toastr.error(response.authorize)
                        }
                    },
                    error: function(response) {
                        toastr.error(response.responseJSON.message)
                    }
                });
            }
        })
    }

    // multi delete row table
    function multiDelCheckbox(table, url, selectClass) {
        Swal.fire({
            width: "25rem",
            title: "{{__('title.are_you_sure')}}",
            text: "{!! __('message.you_wont_be_able_to_revert_this') !!}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{__('button.yes_delete_it')}}",
            cancelButtonText: "{{__('button.cancel')}}",
        }).then((result) => {
            if (result.value) {
                let id = [];
                $("."+selectClass+":checked").each(function(){
                    id.push($(this).val());
                });
                if(id.length > 0) {
                    $.ajax({
                        url: url,
                        method: "GET",
                        data: {id:id},
                        success: function(response) {
                            if (response.success) {
                                $("#" + table).DataTable().ajax.reload();
                                Swal.fire({
                                    width: "22rem",
                                    title: "{{__('message.deleted')}}",
                                    text: response.success,
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else if (response.info) {
                                toastr.info(response.info)
                            } else if (response.error) {
                                Swal.fire({
                                    width: "22rem",
                                    title: "{{__('message.authorize')}}",
                                    text: response.error,
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                toastr.error(response.authorize)
                            }
                            $("#selectAll").prop("checked",false);
                            $("input[type=checkbox]").prop("checked",false);
                        }
                    });
                }else{
                    Swal.fire({
                        width: "22rem",
                        title: "{{__('title.error')}}",
                        text: "{{__('message.please_select_atleast_one_checkbox')}}",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        })
    }

    // function delete button
    function delBtn() {
        $(".confirm").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('Loading') }}...</span></div> {{ __('Deleting') }}...");
        $.ajax({
            url: url,
            method: "DELETE",
            success: function(response) {
                console.log(response)
                $("#delete").modal("hide")
                alert_sweet_success(response.success);
                $("#" + table).DataTable().ajax.reload();
                $(".confirm").html("Delete");
            }
        });
    }
</script>

