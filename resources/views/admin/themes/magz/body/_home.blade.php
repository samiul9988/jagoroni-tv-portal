@extends('admin.themes.widgets')

@inject('themeHlp', 'App\Helpers\ThemeHelper')

@section('section')
<section class="section-side col-lg-8 col-md-8 offset-md-2 border pt-3 pb-3 mb-5">
    <div id="sortable" class="section-row pb-5">
        @foreach($widgets as $i => $widget)
            {{-- Section --}}
            @if(Arr::first(Str::of($i)->explode('-')) == 'section')
                <div class="section card card-item draggable section-draggable" data-widget-name="{{ $i }}" data-widget-data="{{ $widget['active'] }}">
                    <div class="card-header handle">
                        <h3 class="card-title">
                            {{ Str::headline(Arr::first(Str::of($i)->explode('-'))) }}
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool bg-default btn-sm active-section">
                                @if($widget['active'] == "true")
                                    <i class="fas fa-eye"></i>
                                @else
                                    <i class="fas fa-eye-slash"></i>
                                @endif
                            </button>
                            <button type="button" class="btn btn-tool bg-default btn-sm remove-card" data-card-type="section">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="nested-sortable row section-row pb-5">
                            @foreach($widget['widget'] as $item => $value) 
                                <div class="draggable card-item sub-card-item col-lg-6 col-md-6 col-12" data-widget-name="{{ $item }}" data-widget-data="{{ json_encode($value) }}">
                                    <div class="card">
                                        <div class="card-header handle">
                                            <h3 class="card-title">
                                                @if($value['title'])
                                                    {{ $value['title'][$language] }}
                                                @else
                                                    {{ Str::headline(Arr::first(Str::of($item)->explode('-'))) }}
                                                @endif
                                            </h3>
                                            <div class="card-tools" data-card-type="section">
                                                <button type="button" class="btn btn-tool bg-default btn-sm edit-card">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool bg-default btn-sm active-card">
                                                    @if($value['active'] == "true")
                                                        <i class="fas fa-eye"></i>
                                                    @else
                                                        <i class="fas fa-eye-slash"></i>
                                                    @endif
                                                </button>
                                                <button type="button" class="btn btn-tool bg-default btn-sm remove-card" data-card-type="widget-section">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-outline-light btn-md insert-widget-in-section" data-widget-type="section">
                                {{ __('button.add_widget') }}
                            </button>
                        </div>
                    </div>
                </div>
            @else
                {{-- Widget --}}
                <div class="card card-item @if($i != 'headline' AND $i !='featured' AND $i != 'bottom_post' AND $i != 'posts') draggable widget-draggable @endif" data-widget-name="{{ $i }}" data-widget-data="{{ json_encode($widget) }}" >
                    <div class="card-header @if($i == 'headline' || $i == 'featured' || $i == 'bottom_post') static @elseif ($i == 'posts') static @else handle @endif">
                        <h3 class="card-title">
                            @if ($i == 'headline' || $i == 'featured')
                                @if($widget['title'])
                                    {{ $widget['title'][$language] }}
                                @else
                                    {{ Str::headline(Arr::first(Str::of($i)->explode('-'))) }}
                                @endif
                            @elseif ($i != 'section')
                                @if($widget['title'])
                                    @if(array_key_exists($language, $widget['title']))
                                        {{ $widget['title'][$language] }}
                                    @endif
                                @else
                                    {{ Str::headline(Arr::first(Str::of($i)->explode('-'))) }}
                                @endif
                            @endif
                        </h3>
                        @php
                        $dataCardType = ($i == 'headline' || $i == 'featured' || $i == 'bottom_post') ? 'featured': 'widget';
                        @endphp
                        <div class="card-tools" data-card-type="{{ $dataCardType }}">
                            <button type="button" class="btn btn-tool bg-default btn-sm edit-card">
                                <i class="fas fa-pencil-alt"></i>
                            </button>

                            @if($i != 'posts')
                            <button type="button" class="btn btn-tool bg-default btn-sm active-card">
                                @if($i == 'headline' || $i == 'featured' || $i == 'bottom_post')
                                    @php $icon = $themeHlp::isWidgetFeaturedActive('magz', 'home', 'body', $i) ? "fa-eye" : "fa-eye-slash" @endphp
                                @else
                                    @php $icon = $widget['active'] == "true" ? "fa-eye" : "fa-eye-slash" @endphp
                                @endif
                                <i class="fas {{ $icon }}"></i>
                            </button>
                            @endif

                            @if($i != 'headline' AND $i !='featured' AND $i != 'bottom_post' AND $i != 'posts')
                                <button type="button" class="btn btn-tool bg-default btn-sm remove-card" data-card-type="widget">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="text-center">
        <button type="button" class="btn btn-outline-light insert-widget" data-widget-type="widget">
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

            // ADD WIDGET IN SECTION (SHOW MODAL) ***
            $(document).on("click", ".insert-widget-in-section", function(e) {
                setAddWidgetOption('{"mini_post":"Mini Post", "list_label":"List Label"}');
                $('#add-widget-modal').modal('show');
                let widgetType = $(this).data('widget-type');
                let widgetName = $(this).closest('.card-item').data('widgetName');
                $('#_awm_widget_name').val(widgetName);
                $('#_awm_widget_type').val(widgetType);
            });
            // END ADD WIDGET IN SECTION....................................................

            // ADD WIDGET (SHOW MODAL) ***
            $(document).on("click", ".insert-widget", function(e) {
                setAddWidgetOption('{"post":"Post", "ads":"Ads", "section":"Section", "video":"Video", "audio":"Audio"}');
                $('#add-widget-modal').modal('show');
                let widgetType = $(this).data('widget-type');
                $('#_awm_widget_type').val(widgetType);
            });
            // END ADD WIDGET....................................................

            // ADD WIDGET (PROCESS) ***
            $(document).on("click", "#add-widget-submit", function(e) {
                let text = $('#_aw_widget_name').find(':selected').text();
                let widget = $('#add-widget-modal #_aw_widget_name').val();
                let section = $('#_awm_widget_type').val() === 'section' ? 'true' : 'false';
                let widgetName = $('#_awm_widget_name').val();

                let count = $('.nested-sortable').length;

                if (count == 1) {
                    $('.sub-card-item').removeClass('col-lg-12 col-md-12').addClass('col-lg-6 col-md-6')
                }

                let data;
                if (section === 'true') {
                    data = {
                        "widget": widget, "section": section, "sectionName": widgetName
                    }
                } else {
                    data = {
                        "widget": widget, "section": section
                    }
                }

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/ajax/themes/"+theme+"/pages/"+slug+"/"+layout,
                    data: data,
                    success: function(response){
                        notification(response);
                        if (response.widgetData == null) {
                            $('#sortable .widget-draggable:last').after(cardSection(response.widgetName));
                        } else {
                            if (section === 'true') {
                                $('[data-widget-name='+widgetName+'] .nested-sortable').append(cardWidgetInSection(text, response.widgetName));
                            } else { 
                                $('#sortable .widget-draggable:last').after(cardWidget(text, response.widgetName));
                            }
                            $('[data-widget-name='+response.widgetName+']').attr('data-widget-data', JSON.stringify(response.widgetData));
                        }

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
            $(document).on("click", ".active-section", setActive);
            // END ACTIVE WIDGET....................................................


            $('#_wm_category').select2({
                theme: 'bootstrap4'
            });

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

                        if (response.title.{{ $language }}) {
                            const title = response.title.{{ $language }}
                        } else {
                            const titleTrim = widgetName.trim().split('_');
                            const title = titleTrim[0].toUpperCase();
                        }

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
                let type = $(this).data('cardType'),
                section, widget, el, url;

                if (type === 'widget-section') {
                    section = $(this).closest('.section').data('widgetName');
                    widget  = $(this).closest('.sub-card-item').data('widgetName');
                    el      = this.parentElement.parentElement.parentElement.parentElement;
                    url     = '/admin/manage/themes/'+theme+'/pages/'+slug+'/layout/'+layout+'/widget/'+widget;
                
                    alertDel(url, type, null, el, section);
                } else {
                    widget = $(this).closest('.card-item').data('widgetName');
                    el     = this.parentElement.parentElement.parentElement;
                    url    = '/admin/manage/themes/'+theme+'/pages/'+slug+'/layout/'+layout+'/widget/'+widget;

                    alertDel(url, type, null, el);
                }
            })
            // END DELETE WIDGET....................................................















            // ADD NEW POST SECTION ***

            // $(document).on("click", "#add-post-section-button", function(e) {
            //     $.ajax({
            //         type: "POST",
            //         dataType: "json",
            //         url: "/ajax/themes/"+theme+"/pages/"+slug+"/"+layout,
            //         data: {
            //             "widget": "post"
            //         },
            //         success: function(response){
            //             notification(response);
            //             $('#sortable').append(cardWidget('post', response.widgetName));
            //         },
            //         error: function(){
            //             alert("Error");
            //         }
            //     });
            // });

            // ADD NEW WIDGET IN SECTION ***



            // SHOWING ADD WIDGET MODAL ***

            // $(document).on("click", ".add-widget-modal-button", function(e) {
            //     $(this).attr('data-status','add-card');
            //
            //     let section = $(this).data('section'),
            //         widget = $(this).data('widget'),
            //         type = $(this).closest('.card-tools').data('cardType');
            //
            //     if (widget == 'post') {
            //         $("#_wm_post_type_el").removeClass('d-none');
            //
            //         $("select#_wm_post_type").on('change', function() {
            //             if ( this.value == 'post_by_category') {
            //                 $("#_wm_category_el").removeClass('d-none');
            //             } else {
            //                 $("#_wm_category_el").addClass('d-none');
            //             }
            //         });
            //
            //         $("#_wm_title").val("");
            //
            //     } else if(widget == 'term') {
            //         $("#_wm_term_el").removeClass('d-none');
            //     } else if(widget == 'newsletter') {
            //         $("#_wm_description_el").removeClass('d-none');
            //     } else if(widget == 'about') {
            //         $("#_wm_logo_el").removeClass('d-none');
            //         $("#_wm_link_el").removeClass('d-none');
            //     } else if(widget == 'social_media_link') {
            //         $("#_wm_description_el").removeClass('d-none');
            //     }
            //
            //     $("#_wm_theme").val(theme);
            //     $("#_wm_slug").val(slug);
            //     $("#_wm_layout").val(layout);
            //     $("#_wm_type").val(type);
            //     $("#_wm_column").val(section);
            //     $("#_wm_widget").val(widget);
            //
            //     $('#edit-widget-modal').modal('show');
            // });

            // EDIT **

            // EDIT WIDGET MODAL ***

            // $("#widget-modal").submit(function(){
            //     submitUpdate(theme, slug, layout);
            //     $('#edit-widget-modal').modal('hide');
            //     $("#_wm_post_type_el, #_wm_category_el, #_wm_order_el, #_wm_popular_based_el, #_wm_number_of_posts_el, #_wm_description_el, #_wm_logo_el, #_wm_link_el").addClass('d-none');
            //
            //     return false;
            // });



            // UPDATE WIDGET ***

            // function submitUpdate(theme, slug, layout){
            //     let url = '/admin/manage/themes/'+theme+'/pages/'+slug+'/layout/'+layout+'/widget/update';
            //     $.ajax({
            //         method: "PUT",
            //         url: url,
            //         cache: false,
            //         data: $('form#widgetModalForm').serialize(),
            //         success: function(response){
            //             notification(response);
            //             $("[data-status='edit-card']").closest('.card-header').children('h3.card-title').html(response.title);
            //             $("[data-status='edit-card']").removeAttr('data-status');
            //         },
            //         error: function(){
            //             alert("Error");
            //         }
            //     });
            // }



        });
    </script>
@endpush
