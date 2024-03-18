@extends('admin.themes.widgets')

@inject('themeHlp', 'App\Helpers\ThemeHelper')

@section('section')
<section class="section-side col-lg-8 col-md-8 offset-md-2 border pt-3 pb-3 mb-5">
    <div id="sortable" class="section-row pb-5">
        @foreach($widgets as $i => $widget)
            <div class="card card-item draggable" data-widget-name="{{ $i }}" data-widget-data="{{ json_encode($widget) }}">
                <div class="card-header handle">
                    <h3 class="card-title">
                        {{ $themeHlp->getWidgetTitle($i, $widget['title'], $language) }}
                    </h3>
                    <div class="card-tools" data-card-type="widget">
                        <button type="button" class="btn btn-tool bg-default btn-sm edit-card">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-tool bg-default btn-sm active-card">
                            @php $icon = $widget['active'] == "true" ? "fa-eye" : "fa-eye-slash" @endphp
                            <i class="fas {{ $icon }}"></i>
                        </button>
                        <button type="button" class="btn btn-tool bg-default btn-sm remove-card" data-card-type="widget">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center">
        <button type="button" class="btn btn-outline-light btn-md" data-toggle="modal" data-target="#add-widget-modal">
            {{ __('button.add_widget') }}
        </button>
    </div>
</section>
@endsection



@push('script')
<script>
    $(function () {
        'use strict';

        // SORTABLE **
        sortable('.section-row', 'sortable');
        // END SORTABLE....................................................

        // ADD **

        // ADD WIDGET (SHOW MODAL) ***
        $('#add-widget-modal').on('show.bs.modal', function () {
            setAddWidgetOption('{"post_sidebar": "Post", "newsletter_sidebar": "Newsletter", "ads_sidebar": "Ads", "video_sidebar":"Video", "audio_sidebar":"Audio"}');
        });
        // END ADD WIDGET

        // ADD WIDGET (PROCESS) ***
        $(document).on("click", "#add-widget-submit", function(e) {
            let text = $('#_aw_widget_name').find(':selected').text();
            let widget = $('#add-widget-modal #_aw_widget_name').val();

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/ajax/themes/"+theme+"/pages/"+slug+"/"+layout,
                data: {
                    "widget": widget
                },
                success: function(response){
                    notification(response);
                    $('#sortable').append(cardWidget(text, response.widgetName));
                    $('[data-widget-name='+response.widgetName+']').attr('data-widget-data', JSON.stringify(response.widgetData));
                    $('#add-widget-modal').modal('hide')
                },
                error: function(){
                    alert("Error");
                }
            });
        });
        // END ADD WIDGET....................................................

        // EDIT **

        // SET ACTIVE WIDGET **
        $(document).on("click", ".active-card", setActive);
        // END ACTIVE WIDGET....................................................

        // EDIT WIDGET (SHOW MODAL) ***
        $(document).on("click", ".edit-card", function(e) {
            e.preventDefault();

            $(this).attr('data-status','edit-card');

            let type = $(this).closest('.card-tools').data('cardType');
            let typeName = '';
            let widget = $(this).closest('.card-item').data('widgetName');
            let data = {
                "type": type, "widget": widget
            };

            if (type === 'section') {
                widget = $(this).closest('.sub-card-item').data('widgetName');
                typeName = $(this).closest('.section').data('widgetName');
                data = {
                    "type": type, "widget": widget, "typeName": typeName
                }
            }

            let title = $(this).closest(".card-header").find('.card-title').text();

            $('#edit-widget-modal h4.modal-title').html(title)

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/ajax/themes/"+theme+"/pages/"+slug+"/"+layout+"/edit",
                data: data,
                success: function(response){
                    $('#edit-widget-modal .modal-body').html(response);
                    $.fn.modal.Constructor.prototype._enforceFocus = function() {};
                    $('#_wm_widget').val(widget);
                    $('#_wm_type').val(type);
                    $('#_wm_type_name').val(typeName);

                    $('#edit-widget-modal').modal('show');

                     $('#_wm_category').select2({
                        theme: 'bootstrap4'
                    });

                    $("select#_wm_post_type").on('change', function () {
                        if (this.value == 'post_by_category') {
                            $("#_wm_category_el").removeClass('d-none');
                        } else {
                            $("#_wm_category_el").addClass('d-none');
                        }
                    });

                    $("select#_wm_order").on('change', function() {
                        if ( this.value === 'popular') {
                            $("#_wm_popular_based_el").removeClass('d-none');
                        } else {
                            $("#_wm_popular_based_el").addClass('d-none');
                        }
                    });

                    if ($("#_wm_ad_type").val() === "image") {
                        $("#_wm_ad_image_el, #_wm_ad_size_el, #_wm_ad_url_el").removeClass('d-none');
                    } else if($('#_wm_ad_type').val() === "script") {
                        $("#_wm_ad_script_el").removeClass('d-none');
                        $("#_wm_ad_image_el, #_wm_ad_size_el, #_wm_ad_url_el").addClass('d-none');
                    } else {
                        $("#_wm_ga_client_el, #_wm_ga_slot_el, #_wm_ga_size_el").removeClass('d-none');

                        if ($("#_wm_ga_size").val() === "fixed") {
                            $("#_wm_ad_size_el, #_wm_ad_width_el, #_wm_ad_height_el").removeClass('d-none');
                            $("#_wm_ga_client_el, #_wm_ga_slot_el, #_wm_ga_size_el, #_wm_ga_format_el, #_wm_ga_full_width_responsive_el").addClass('d-none');
                        } else {
                            $("#_wm_ad_size_el").addClass('d-none');
                            $("#_wm_ga_format_el, #_wm_ga_full_width_responsive_el").removeClass('d-none');
                        }
                    }

                    $("select#_wm_ad_type").on('change', function () {
                        if (this.value === "image") {
                            $("#_wm_ad_script_el").addClass('d-none');
                            $("#_wm_ga_client_el, #_wm_ga_slot_el, #_wm_ga_size_el, #_wm_ga_format_el, #_wm_ga_full_width_responsive_el, #_wm_ad_script_el").addClass('d-none');
                            $("#_wm_ad_image_el, #_wm_ad_size_el, #_wm_ad_url_el").removeClass('d-none');
                        } else if (this.value === "script") {
                            $("#_wm_ad_script_el").removeClass('d-none');
                            $("#_wm_ga_client_el, #_wm_ga_slot_el, #_wm_ga_size_el, #_wm_ga_format_el, #_wm_ga_full_width_responsive_el, #_wm_ad_image_el, #_wm_ad_size_el, #_wm_ad_url_el").addClass('d-none');
                        } else {
                            $("#_wm_ga_client_el, #_wm_ga_slot_el, #_wm_ga_size_el, #_wm_ad_size_el").removeClass('d-none');
                            $("#_wm_ad_image_el, #_wm_ad_url_el, #_wm_ad_script_el").addClass('d-none');
                        }
                    });

                    $("select#_wm_ga_size").on('change', function () {
                        if (this.value === "fixed") {
                            $("#_wm_ad_size_el").removeClass('d-none');
                            $("#_wm_ga_client_el, #_wm_ga_slot_el, #_wm_ga_format_el, #_wm_ga_full_width_responsive_el").addClass('d-none');
                        } else if (this.value === 'responsive') {
                            $("#_wm_ad_size_el").addClass('d-none');
                            $("#_wm_ga_format_el, #_wm_ga_full_width_responsive_el").removeClass('d-none');
                        }
                    });
                },
                error: function(){
                    alert("Error");
                }
            });
        });
        // END EDIT WIDGET....................................................

        // EDIT WIDGET MODAL (PROCESS) ***
        $(document).on("click", "#widget-modal-button", function (e) {
            e.preventDefault();

            let data = new FormData($('#widgetModalForm')[0]);
            data.append('_method', 'PUT');
            let widgetName = $('#_wm_widget').val();

            $.ajax({
                url: "/admin/manage/themes/"+theme+"/pages/"+slug+"/layout/"+layout,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                success: function(response){
                    notification(response);

                    let title;

                    if (response.title.{{ $language }}) {
                        title = response.title.{{ $language }}
                    } else {
                        title = readable(widgetName);
                    }            

                    $("[data-status='edit-card']").closest('.card-header').children('h3.card-title').text(title);
                    $("[data-status='edit-card']").removeAttr('data-status');
                },
                error: function(){
                    alert("Error");
                }
            });

            $('#edit-widget-modal').modal('hide');
        });
        // END EDIT WIDGET....................................................

        // UPDATE WIDGET ***
        function submitUpdateWidget(){
            $.ajax({
                type: "PUT",
                url: "/admin/manage/themes/"+theme+"/pages/"+slug+"/layout/"+layout,
                cache:false,
                data: $('form#widgetModalForm').serialize(),
                success: function(response){
                    notification(response);
                    $("[data-status='edit-card']").closest('.card-header').children('h3.card-title').html(response.title);
                    $("[data-status='edit-card']").removeAttr('data-status');
                },
                error: function(){
                    alert("Error");
                }
            });
        }
        // END UPDATE WIDGET....................................................

        // DELETE **

        // DELETE WIDGET ***
        $(document).on("click", ".remove-card", function(e) {
            let type = $(this).data('cardType');
            let widget = $(this).closest('.card-item').data('widgetName');
            let el = this.parentElement.parentElement.parentElement;

            let url = '/admin/manage/themes/'+theme+'/pages/'+slug+'/layout/'+layout+'/widget/'+widget;

            alertDel(url, type, null, el);
        })
        // END DELETE WIDGET....................................................

    });
</script>
@endpush
