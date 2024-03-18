<script>
    const theme = '{{ $themeName }}';
    const slug = '{{ $slug }}';
    const layout = '{{ $layout }}';
    const identifier = 'widgetName';
    const dataIdentifier = 'widgetData';

    // FLAGS **

    // SELECT FLAG **^
    $(document).on("click", ".list-flags li", function(e) {
        if (!$(this).hasClass('active')) {
            $('.list-flags li.active').removeClass('active');
            $(this).addClass('active');
        }
    });
    // END SELECT FLAG....................................................

    // ACTIVE LANGUAGE TITLE ***
    $(document).on("click", ".list-flags li.list-inline-item", function(e) {
        let lang = $(this).data('lang');

        if (!$(this).hasClass('input-desc-' + lang)) {
            $('#_wm_title_el input').attr('hidden', true);
        }

        if ($('#_wm_title_el input').hasClass('input-desc-' + lang)) {
            $('#_wm_title_el input.input-desc-' + lang).removeAttr('hidden');
        } else {
            $('#_wm_title_el').append('<input type="text" class="form-control _wm_title input-desc-' + lang + '" name="title[' + lang + ']">');
        }
    });
    // END ACTIVE LANGUAGE TITLE.......................................

    // ACTIVE LANGUAGE DESCRIPTION ***
    $(document).on("click", ".list-flags li.list-inline-item", function(e) {
        let lang = $(this).data('lang');

        if ($('#_wm_description_el textarea').length) {
            if (!$(this).hasClass('input-desc-' + lang)) {
                $('#_wm_description_el textarea').attr('hidden', true);
            }

            if ($('#_wm_description_el textarea').hasClass('input-desc-' + lang)) {
                $('#_wm_description_el textarea.input-desc-' + lang).removeAttr('hidden');
            } else {
                $('#_wm_title_el').append('<textarea name="description[' + $lang + ']" class="form-control _wm_description input-desc-' + $lang + '" rows="3"></textarea>');
            }
        }
    });
    // END ACTIVE LANGUAGE DESCRIPTION.......................................
    
    function setAddWidgetOption(option) {
        const select = document.querySelector('#_aw_widget_name');
        const arr = $.parseJSON(option);
    
        for (const k in arr) {
            const opt = document.createElement('option');
            opt.value = k;
            opt.innerHTML = arr[k];
            select.appendChild(opt);
        }
    }
    
    function cardSection(name) {
        return `<div class="section card card-item draggable" data-widget-name="` + name + `">` +
            `<div class="card-header handle">` +
            `<h3 class="card-title">Section</h3>` +
            `<div class="card-tools">` +
            `<button type="button" class="btn btn-tool" data-card-widget="collapse">` +
            `<i class="fas fa-minus"></i>` +
            `</button>` +
            `<button type="button" class="btn btn-tool bg-default btn-sm remove-card" data-card-type="section">` +
            `<i class="fas fa-times"></i>` +
            `</button>` +
            `</div>` +
            `</div>` +
            `<div class="card-body">` +
            `<div class="nested-sortable row section-row pb-5">` +
            `</div>` +
            `<div class="text-center">` +
            `<button type="button" class="btn btn-outline-light btn-md insert-widget-in-section" data-widget-type="section">`+
            '{{ __('button.add_widget') }}'+
            `</button>`+
            `</div>`+
            `</div>`+
            `</div>`;
    }
    
    function cardWidgetInSection(text, name) {
        return `<div class="draggable card-item sub-card-item col-lg-6 col-md-6 col-12" data-widget-name="`+name+`">` +
            `<div class="card">`+
            `<div class="card-header">`+
            `<h3 class="card-title">`+
            text +
            `</h3>`+
            `<div class="card-tools" data-card-type="section">`+
            `<button type="button" class="btn btn-tool bg-default btn-sm edit-card">`+
            `<i class="fas fa-pencil-alt"></i>`+
            `</button>`+
            `<button type="button" class="btn btn-tool bg-default btn-sm active-card" data-active="enabled">` +
            `<i class="fas fa-eye"></i> ` +
            `</button>` +
            `<button type="button" class="btn btn-tool bg-default btn-sm remove-card" data-card-type="widget-section">`+
            `<i class="fas fa-times"></i>`+
            `</button>`+
            `</div>`+
            `</div>`+
            `</div>` +
            `</div>`;
    }
    
    function cardWidgetColumn(text,name) {
        return `<div class="card card-item draggable" data-widget-name="`+name+`">`+
            `<div class="card-header handle">`+
            `<h3 class="card-title">`+
                text +
            `</h3>`+
            `<div class="card-tools" data-card-type="column">`+
            `<button type="button" class="btn btn-tool bg-default btn-sm edit-card">`+
            `<i class="fas fa-pencil-alt"></i>`+
            `</button>` +
            `<button type="button" class="btn btn-tool bg-default btn-sm active-card">`+
            `<i class="fas fa-eye"></i> ` +
            `</button>`+
            `<button type="button" class="btn btn-tool bg-default btn-sm remove-card" data-card-type="widget">`+
            `<i class="fas fa-times"></i>`+
            `</button>`+
            `</div>`+
            `</div>`+
            `</div>`;
    }
    
    function cardWidget(text,name, data) {
        return `<div class="card card-item draggable" data-widget-name="`+name+`">`+
            `<div class="card-header handle">`+
            `<h3 class="card-title">`+
            text +
            `</h3>`+
            `<div class="card-tools" data-card-type="widget">`+
            `<button type="button" class="btn btn-tool bg-default btn-sm edit-card">`+
            `<i class="fas fa-pencil-alt"></i>`+
            `</button>` +
            `<button type="button" class="btn btn-tool bg-default btn-sm active-card">`+
            `<i class="fas fa-eye"></i> ` +
            `</button>`+
            `<button type="button" class="btn btn-tool bg-default btn-sm remove-card" data-card-type="widget">`+
            `<i class="fas fa-times"></i>`+
            `</button>`+
            `</div>`+
            `</div>`+
            `</div>`;
    }
    
    function createColumn(column, sizeColumn) {
        return `<section data-widget-name="`+column+`" class="section-side `+sizeColumn+` border pt-3 pb-3">`+
            `<div class="static text-right">`+
            `<button type="button" class="btn btn-light btn-flat btn-xs remove-column" data-column="`+column+`"> <i class="fas fa-times"></i> Remove</button>`+
        `</div>`+
        `<div class="section-column pb-5"></div>`+
        `<div class="static text-center">`+
            `<button type="button" class="btn btn-outline-light btn-md add-widget">`+
                `Add Widget`+
            `</button>`+
        `</div>`+
    `</section>`;
    }
    
    function columnAdjustment(column) {
        let numberOfColumns = $('#nested-widget section').length;
        console.log(numberOfColumns);
        if (numberOfColumns === 3) {
            $('#nested-widget .section-side').removeClass('col-lg-4 col-md-4').addClass('col-lg-6 col-md-6');
            if (column === 'right_column') {
                $('section[data-widget-name=middle_column]').attr('data-widget-name', 'right_column');
            }
    
            if (column === 'left_column') {
                $('section[data-widget-name=middle_column]').attr('data-widget-name', 'left_column');
            }
        } else if (numberOfColumns === 2) {
            $('#nested-widget .section-side').removeClass('col-lg-6 col-md-6').addClass('col-lg-12 col-md-12');
            $('section.section-side').attr('data-widget-name', 'column');
        }
    }
    
    function setActive() {
        let section = $(this).closest('.section').data('widgetName');
        let widget = $(this).closest('.card-item').data('widgetName');
        let url = '/ajax/themes/' + theme + '/pages/' + slug + '/' + layout + '/widget/' + widget + '/change-visible-widget';
        let active = $(this).find('.fa-eye').length === 0 ? "true" : "false";
        let type = $(this).closest('.card-tools').data('cardType');
        let column = $(this).closest('section').data('widgetName');
        $(this).find('.fas').toggleClass('fa-eye fa-eye-slash');
    
        $.ajax({
            type: "PATCH",
            dataType: "json",
            url: url,
            data: {
                "type": type, "column": column, "active": active, "section": section
            },
            success: function (response) {
                notification(response);
            },
            error: function (response) {
                toastr.error(response.responseJSON.message, {timeOut: 5000})
            }
        });
    }
    
    function readFile(input) {
        const reader = new FileReader();
        reader.onload = (e) => {
            let image = new Image();
            image.onload = function() {
                $('input[name=ad_width]').val(image.width);
                $('input[name=ad_height]').val(image.height);
            };
            image.src = reader.result;
            $('.upload-image').addClass('ready');
            $('#image_preview_container').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
    
    function serialize(sortable, selector) {
        let serialized = [];
        let children = [].slice.call(sortable.children);
        for (let i in children) {
            let nested = children[i].querySelector(selector);
            serialized.push({
                id: children[i].dataset[identifier],
                data: children[i].dataset[dataIdentifier],
                children: nested ? serialize(nested) : []
            });
        }
        return serialized
    }
    
    function sortable(selector, selectorRoot) {
        let nestedSortables = [].slice.call(document.querySelectorAll(selector));
    
        for (let i = 0; i < nestedSortables.length; i++) {
            new Sortable(nestedSortables[i], {
                group: 'nested',
                animation: 150,
                fallbackOnBody: true,
                swapThreshold: 0.65,
                handle: '.handle',
                filter: '.static',
                draggable: '.draggable',
                onEnd: function(/**Event*/evt) {
                    const root = document.getElementById(selectorRoot);
                    let widget = serialize(root, selector);
                    $.ajax({
                        type: "PUT",
                        dataType: "json",
                        url: '/admin/manage/themes/'+theme+'/pages/'+slug+'/layout/'+layout+'/change-position',
                        cache:false,
                        data: {
                            "section": "sub-column", "widget": widget
                        },
                        success: function(response){
                            notification(response);
                        }
                    });
                }
            });
        }
    }
    
    function select() {
        $('#_wm_category').select2({
            theme: 'bootstrap4',
            allowClear: true,
            ajax: {
                url: `{{ route('categories.category.search') }}`,
                dataType: 'json',
                data: function (params) {
                    let query = {
                        q: params.term,
                        lang: $('#language').val()
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
    }
    
    function alertDelColumn(url, data, removedWidgets) {
        Swal.fire({
            width: "25rem",
            title: "{{__('title.are_you_sure')}}",
            text: "{!! __('message.you_wont_be_able_to_revert_this') !!}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{__('message.yes_delete_it')}}",
        }).then((result) => {
            $.ajax({
                url: url,
                dataType: "json",
                method: "DELETE",
                data: { "data": data, "widgets": removedWidgets},
                success: function(response) {
                    Swal.fire({
                        width: "22rem",
                        title: "{{__('deleted')}}",
                        text: response.success,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });
    }
    
    function alertDel(url, cardType, data, el = null, section = null) {
    
        let $data;
    
        if ( data ) {
            $data = { "data": data }
        } else {
            if ( section ) {
                $data = { "type": cardType, "section": section }
            } else {
                $data = { "type": cardType }
            }
        }
    
        Swal.fire({
            width: "25rem",
            title: "{{__('title.are_you_sure')}}",
            text: "{!! __('message.you_wont_be_able_to_revert_this') !!}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{__('message.yes_delete_it')}}",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    dataType: "json",
                    method: "DELETE",
                    data: $data,
                    success: function(response) {
                        if (response.success) {
                            if (el) {
                                el.remove();
                            }
                            Swal.fire({
                                width: "22rem",
                                title: "{{__('Deleted!')}}",
                                text: response.success,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
    
                            if (cardType === 'widget-section') {
                                if ($('.nested-sortable .card-item').length == 1) {
                                    $('.sub-card-item').removeClass('col-lg-6 col-md-6')
                                                        .addClass('col-lg-12 col-md-12')
                                }
                            }
    
                        } else if (response.info) {
                            toastr.info(response.info)
                        } else if (response.error) {
                            Swal.fire({
                                width: "22rem",
                                title: "{{__('title.authorize')}}",
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
    
    $(function() {
        // UPLOAD AD IMAGE
        $(document).on('click', '#reset', function() {
            $('#display').removeAttr('hidden');
            $('#reset').attr('hidden');
            $('.upload-image').removeClass('ready result');
            $('#image_preview_container').attr('src', '#');
        });
    
        $(document).on('click', '.upload-msg', function() {
            $("#upload").trigger("click");
        });
    
        $(document).on('change', '#upload', function(){
            readFile(this);
        });
        // END UPLOAD AD IMAGE-----------------------------
    
        // MODAL CLOSE
        $('#add-widget-modal').on('hidden.bs.modal', function () {
            $("#_wm_carousel_autoplay_el").addClass('d-none');
            $("#_wm_post_type_el").addClass('d-none');
            $("#_wm_category_el").addClass('d-none');
            $("#_wm_term_el").addClass('d-none');
            $("#_wm_order_e").addClass('d-none');
            $("#_wm_popular_based_el").addClass('d-none');
            $("#_wm_number_of_posts_el").addClass('d-none');
            $("#_wm_description_el").addClass('d-none');
            $("#_wm_logo_el").addClass('d-none');
            $("#_wm_link_el").addClass('d-none');
    
            $("#_aw_widget_name").html("");
            $("#_awm_widget_type").val("");
        })
        // END MODAL CLOSE-----------------------------
    
    });

    // READABLE
    function readable(str) {
        var i, strip = str.split('-'),
        frags = strip[0].split('_');

        for (i=0; i<frags.length; i++) {
            frags[i] = frags[i].charAt(0).toUpperCase() + frags[i].slice(1);
        }

        return frags.join(' ');
    }
    // END READABLE-----------------------------
</script>