<script>
    "use strict";

    // Language menu display
    $('#language').select2({
        theme: "bootstrap4",
        minimumResultsForSearch: 5,
    });


    // Select menus
    $('select[name=menu]').on('change', function(){
        $('.load-select').append("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading') }}</span></div> {{ __('message.sending') }}");
        let data = {
            'menu': $('select[name=menu]').val()
        }

        $.post( "{{ route('menusshow') }}", data, function( data ) {
            window.location.href = "/admin/manage/menus/"+data.menu_id+"/lang/"+data.lang;
        });
    });
    
    // Change the menu language display
    $(document).on("change", "#language", function(e) {
        e.preventDefault();
        let data = $('select#language').find(':selected').val();
        let menu_id = $('input#menuid').val();
        $.ajax({
            url: "{{ route('menus.select.language', ['menu_id' => $id]) }}",
            data: {
                'language': data
            },
            success: function(resp){
                window.location.href = "/admin/manage/menus/"+menu_id+"/lang/"+resp.lang;
            }
        })
    });

    // The function displays all menu item lists
    function loadMenuStructure(){
        const xhr = new XMLHttpRequest();
        const container = document.getElementById('menulist');
        $('.menuStructure .card-body').prepend('<div class="spinner d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>');

        xhr.onload = function() {
            $('.spinner-border').hide();
            if (this.status == 200) {
                container.innerHTML = xhr.responseText;
            }else{
                console.warn('Did not receive 200 OK from response');
            }
        }

        let id = $('input#menuid').val();
        let lang = '{{ $langCode }}';
        let url_get = '{{ route("menulist", ['menu_id'=>':id','lang'=>':lang']) }}';

        url_get = url_get.replace(':id', id).replace(':lang', lang);
        xhr.open('get', url_get );
        xhr.send();
    }

    // Displays all menu items list
    loadMenuStructure();

    $(function () {
        $('.dd').nestable();
        $('.dd').on('change', function () {
            let $this = $(this);
            let serializedData = window.JSON.stringify($($this).nestable('serialize'));
            let id = $('#menuid').val();
            let url = '{{ route("menus.change_position_menu", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'PUT',
                dataType: 'json',
                data: { 'menu': serializedData},
                success: function (data, textStatus, xhr) {
                    notification(data);
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('Error in Operation');
                }
            });


            $this.parents('div.card-default').find('input#menuitem').val(serializedData);
        });
    });

    function removeClassCSS() {
        $(".form-group").filter(function () {
            return $(this).children("#class").length > 0;
        }).remove();
    }

    function classCss(val) {
        $('#insert .card-body').append('<div class="form-group">' +
            '<label for="class">{{ __("form.class") }}</label>' +
            '<input type="text" name="class" class="form-control" id="class" placeholder="" value="'+val+'" required autofocus>' +
            '<div class="invalid-feedback msg-error-class"></div>' +
            '</div>');
    }

    function sweetalertRemoveItem(url) {
        Swal.fire({
            width: "25rem",
            title: "{{__('title.are_you_sure')}}",
            text: "{!! __('message.you_wont_be_able_to_revert_this') !!}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{__('button.yes_delete_it')}}",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: "DELETE",
                    success: function(response) {
                        if (response.success) {
                            loadMenuStructure();
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
        });
    }


    // The function displays edit menu items
    function edit(id) {
        let url = '{{ route("menus.edititem", [$id, ":id"]) }}';
        let editUrl = '{{ route("menus.updateitemmenu", ":id") }}';
        url = url.replace(':id', id);
        editUrl = editUrl.replace(':id', id);

        $("form#insert").attr("href", editUrl);

        $.ajax({
            method: "GET",
            url: url,
        }).done(function(resp) {
            let data_class;

            $("#btn-cancel").removeAttr("hidden");
            $("#insert button[type=submit]").attr("id","btn-submit-update").html("{{ __('button.update') }}");

            $("#url").val(resp.data.link);
            $("#label").val(resp.data.label);

            if (resp.data.class == null) {
                data_class = '';
            } else {
                data_class = resp.data.class;
            }

            if($('#class').length < 1){
                classCss(data_class);
            }
        });
    }

    // The function of deleting menu items
    function remove(url) {
        sweetalertRemoveItem(url);
    }

    // Cancel button click function
    $(document).on("click", "#btn-cancel", function(e) {
        $(".card-form.card-title").html("{{ __('button.create_menu_item') }}");
        $("form#insert").removeAttr("href");
        $("#url").val("");
        $("#label").val("");

        removeClassCSS();

        $("#url").removeClass("is-invalid");
        $("#label").removeClass("is-invalid");
        $(".msg-error-url").html("");
        $(".msg-error-label").html("");

        $("#btn-cancel").attr("hidden", true)

        $("#insert button[type=submit]").attr("id", "btn-submit").html("{{ __('button.create_menu_item') }}");
    });

    // Update button click function
    $(document).on("click", "#btn-submit-update", function(e) {
        e.preventDefault();
        $("#update button[type=submit]").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading') }}</span></div> {{ __('message.sending') }}");
        $("#name").removeClass("is-invalid");
        $(".msg-error-name").html("");

        let editurl = $("form#insert").attr("href");
        $.ajax({
            url: editurl,
            method: 'PUT',
            data: $("#insert").serialize(),
            success: function(response) {
                if (response.success) {
                    loadMenuStructure();
                    removeClassCSS();
                    $(".spinner-grow").attr("hidden");
                    $("input[type=text]").val("");
                    $("#insert button[type=submit]").attr("id", "btn-submit").html("{{ __('button.create_menu_item') }}");
                    $("#btn-cancel").attr("hidden", true)
                    addItemMenu(response.menu);

                } else if (response.errors) {
                    if (response.errors.label) {
                        $("#label").addClass("is-invalid");
                        $(".msg-error-label").html(response.errors.label);
                    }
                    if (response.errors.url) {
                        $("#url").addClass("is-invalid");
                    }
                    if (response.errors.class) {
                        $("#class").addClass("is-invalid");
                        $(".msg-error-class").html(response.errors.url);
                    }
                    $("#insert button[type=submit]").html("{{ __('message.resending') }}");
                    $("#btn-cancel").removeAttr("hidden");
                } else {
                    notification(response);
                    removeClassCSS();
                    $(".spinner-grow").attr("hidden");
                    $("input[type=text]").val("");
                    $("#insert button[type=submit]").attr("id", "btn-submit").html("{{ __('button.create_menu_item') }}");
                    $("#btn-cancel").attr("hidden", true)
                }
            },
        });
    });

    // The function of the create new menu item button
    $('#insert').submit(function(e) {
        e.preventDefault();
        $("#insert button[type=submit]").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading') }}</span></div> {{ __('message.sending') }}");
        $("#url").removeClass("is-invalid")
        $("#label").removeClass("is-invalid")
        $(".msg-error-url").html("");
        $(".msg-error-label").html("");

        $.ajax({
            url: "{{ route('menus.storeitem') }}",
            method: 'POST',
            data: $("#insert").serialize(),
            success: function(response) {
                if (response.success) {
                    loadMenuStructure();
                    $(".spinner-grow").attr("hidden");
                    $("input[type=text]").val("");
                    removeClassCSS();
                    $("#insert button[type=submit]").html("{{ __('button.create_menu_item') }}");
                    $("#btn-cancel").attr("hidden", true)
                } else if (response.errors) {
                    if (response.errors.label) {
                        $("#label").addClass("is-invalid")
                        $("#insert button[type=submit]").html("{{ __('message.resending') }}");
                        $(".msg-error-label").html(response.errors.label);
                        $("#btn-cancel").removeAttr("hidden");
                    }
                    if (response.errors.url) {
                        $("#url").addClass("is-invalid")
                        $("#insert button[type=submit]").html("{{ __('message.resending') }}");
                        $(".msg-error-url").html(response.errors.url);
                        $("#btn-cancel").removeAttr("hidden");
                    }
                } else {
                    notification(response);
                    removeClassCSS();
                    $(".spinner-grow").attr("hidden");
                    $("input[type=text]").val("");
                    $("#insert button[type=submit]").html("{{ __('button.create_menu_item') }}");
                    $("#btn-cancel").attr("hidden", true)
                }
            }
        });
    });
</script>
