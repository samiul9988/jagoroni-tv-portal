@extends('admin.themes.widgets')

@inject('themeHlp', 'App\Helpers\ThemeHelper')

@section('section')
    <section class="section-side col-lg-8 col-md-8 offset-md-2 border pt-3 pb-3 mb-5">
        <div id="sortable" class="section-row pb-5">
            @foreach($widgets as $i => $widget)
                <div class="card card-item draggable" data-widget-name="{{ $i }}" data-widget-data="{{ json_encode($widget) }}">
                    <div class="card-header handle">
                        <h3 class="card-title">
                        @if($i != 'menu_link' && $widget['title'] && Arr::exists($widget['title'], $language))
                            {{ $widget['title'][$language] }}
                        @else
                            {{ Str::headline(Arr::first(Str::of($i)->explode('-'))) }}
                        @endif
                        </h3>
                        <div class="card-tools" data-card-type="widget">
                            <button type="button" class="btn btn-tool bg-default btn-sm edit-card">
                                 <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-tool bg-default btn-sm active-card">
                                @php $icon = $widget['active'] == "true" ? "fa-eye" : "fa-eye-slash" @endphp
                                <i class="fas {{ $icon }}"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(function () {
            'use strict';

            // EDIT **

            // SET ACTIVE WIDGET **
            $(document).on("click", ".active-card", setActive);
            // END ACTIVE WIDGET....................................................

            // EDIT WIDGET (SHOW MODAL) ***
            $(document).on("click", ".edit-card", function(e) {
                e.preventDefault();

                $(this).attr('data-status','edit-card');
                let type = $(this).closest('.card-tools').data('cardType');
                let widget = $(this).closest('.card-item').data('widgetName');

                if (type === 'section') {
                    widget = $(this).closest('.sub-card-item').data('widgetName')
                }

                let title = $(this).closest(".card-header").find('.card-title').text();

                $('#edit-widget-modal h4.modal-title').html(title)

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "/ajax/themes/"+theme+"/pages/"+slug+"/"+layout+"/edit",
                    data: {
                        "type": type, "widget": widget
                    },
                    success: function(response){
                        $('#edit-widget-modal .modal-body').html(response);
                        $.fn.modal.Constructor.prototype._enforceFocus = function() {};
                        $('#_wm_widget').val(widget);
                        $('#_wm_type').val(type);

                        select();

                        $('#edit-widget-modal').modal('show');

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
                        }

                        if ($("#_wm_ga_size").val() === "fixed") {
                            $("#_wm_ad_size_el, #_wm_ad_width_el, #_wm_ad_height_el").removeClass('d-none');
                            $("#_wm_ga_client_el, #_wm_ga_slot_el, #_wm_ga_size_el, #_wm_ga_format_el, #_wm_ga_full_width_responsive_el").addClass('d-none');
                        } else {
                            $("#_wm_ad_size_el").addClass('d-none');
                            $("#_wm_ga_format_el, #_wm_ga_full_width_responsive_el").removeClass('d-none');
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
            $("#edit-widget-modal").submit(function(event){
                submitUpdateWidget();
                $('#edit-widget-modal').modal('hide');
                return false;
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
            }
            // END UPDATE WIDGET....................................................

            // DELETE **

            // DELETE WIDGET ***
            $(document).on("click", ".remove-card", function(e) {
                let type = $(this).data('cardType');

                let widget;
                let el;
                if (type === 'section') {
                    widget = $(this).closest('.sub-card-item').data('widgetName');
                    el = this.parentElement.parentElement.parentElement.parentElement;
                } else {
                    widget = $(this).closest('.card-item').data('widgetName');
                    el = this.parentElement.parentElement.parentElement;
                }

                let url = '/admin/manage/themes/'+theme+'/pages/'+slug+'/layout/'+layout+'/widget/'+widget;

                alertDel(el, url, type);
            })
            // END DELETE WIDGET....................................................

        });
    </script>
@endpush
