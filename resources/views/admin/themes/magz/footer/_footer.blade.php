@extends('admin.themes.widgets')

@section('section')
<section class="section-side col-lg-12 border pb-3 mb-5">
    <div class="row section-row" id="nested-widget">
        @foreach($columns as $index => $column)
            <section data-widget-name="{{ $index }}" class="section-side {{ $numberOfColumns }} col-12 border pt-3 pb-3">
                <div class="static text-right">
                    @if (count($columns) != 1)
                        <button type="button" class="btn btn-light btn-flat btn-xs remove-column" data-column="{{ $index }}"> <i class="fas fa-times"></i> Remove</button>
                    @endif
                </div>
                <div class="section-column pb-5">
                    @if($column)
                        @foreach($column as $i => $widget)
                            @if($widget)
                                <div class="card card-item draggable" data-widget-name="{{ $i }}" data-widget-data="{{ json_encode($widget) }}">
                                    <div class="card-header handle">
                                        <h3 class="card-title">
                                            @if($i != 'menu_link')
                                                @if ($widget['title'])
                                                    {{ $widget['title'][$language] }}
                                                @else
                                                    {{ Str::headline(Arr::first(Str::of($i)->explode('-'))) }}
                                                @endif
                                            @else
                                                {{ Str::headline(Arr::first(Str::of($i)->explode('-'))) }}
                                            @endif
                                        </h3>
                                        <div class="card-tools" data-card-type="column">
                                            @if($i != 'menu_link')
                                            <button type="button" class="btn btn-tool bg-default btn-sm edit-card">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            @endif
                                            <button type="button" class="btn btn-tool bg-default btn-sm active-card">
                                                @php $icon = $widget['active'] == "true" ? "fa-eye" : "fa-eye-slash" @endphp
                                                <i class="fas {{ $icon }}"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool bg-default btn-sm remove-card">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="static text-center">
                    <button type="button" class="btn btn-outline-light btn-md add-widget">
                        {{ __('button.add_widget') }}
                    </button>
                </div>
            </section>
        @endforeach
    </div>
    <div class="static text-center mt-3 @if(count($columns) == 3) d-none @endif">
        <button id="add-column" type="button" class="btn btn-outline-light btn-md">
            {{ __('button.add_column') }}
        </button>
    </div>
</section>
@endsection

@push('script')
    <script>
        $(function () {
            'use strict';

            // SORTABLE **
            sortable('.section-column', 'nested-widget');
            // END SORTABLE....................................................

            // ADD **

            // ADD WIDGET (SHOW MODAL) ***
            $(document).on("click", ".add-widget", function(e) {
                let column = $(this).closest('.section-side').data('widgetName');
                $('#add-widget-modal').modal('show');
                $("#_awm_widget_type").val(column);
                setAddWidgetOption('{"about": "About", "links": "Links", "menu_link": "Menu Link", "newsletter_footer": "Newsletter", "post_footer": "Post", "box_label": "Label" }');
            });
            // END ADD WIDGET....................................................

            // ADD WIDGET (PROCESS) ***
            $(document).on("click", "#add-widget-submit", function(e) {
                let text = $('#_aw_widget_name').find(':selected').text();
                let column = $('#_awm_widget_type').val();
                let widget = $('#add-widget-modal #_aw_widget_name').val();

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/ajax/themes/"+theme+"/pages/"+slug+"/"+layout,
                    data: {
                        "widget": widget, "column": column
                    },
                    success: function(response){

                        if (response.widgetData) {
                            $('section[data-widget-name='+column+'] .section-column').append(cardWidgetColumn(text, response.widgetName));
                            $('[data-widget-name='+response.widgetName+']').attr('data-widget-data', JSON.stringify(response.widgetData));
                        }

                        notification(response);

                        $('#add-widget-modal').modal('hide')
                    },
                    error: function(){
                        alert("Error");
                    }
                });
            });
            // END ADD WIDGET....................................................

            // ADD COLUMN ***
            $(document).on("click", "#add-column", function(e) {

                let numberOfColumns = $('#nested-widget section').length;

                if (numberOfColumns == 2) {
                    $(this).addClass('d-none');
                }

                if (numberOfColumns < 3) {
                    if (numberOfColumns == 2) {
                        $('.section-side').removeClass('col-lg-6 col-md-6').addClass('col-lg-4 col-md-4')
                        $('section[data-widget-name=right_column]').attr('data-widget-name', 'middle_column');
                        $('#nested-widget').append(createColumn('right_column', 'col-lg-4 col-md-4 col-12'));
                    } else if (numberOfColumns == 1) {
                        $('#nested-widget .section-side').removeClass('col-lg-12 col-md-12').addClass('col-lg-6 col-md-6')
                        $('section[data-widget-name=column]').attr('data-widget-name', 'left_column');
                        $('#nested-widget').append(createColumn('right_column', 'col-lg-6 col-md-6 col-12'));
                    }
                }

                const root = document.getElementById('nested-widget');
                let data = serialize(root);
            });
            // END ADD COLUMN....................................................

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
                let column = $(this).closest('section.section-side').data('widgetName');
                let title = $(this).closest(".card-header").find('.card-title').text();

                $('#edit-widget-modal h4.modal-title').html(title)

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "/ajax/themes/"+theme+"/pages/"+slug+"/"+layout+"/edit",
                    data: {
                        "type": type, "column": column, "widget": widget
                    },
                    success: function(response){
                        $('#edit-widget-modal .modal-body').html(response);
                        $.fn.modal.Constructor.prototype._enforceFocus = function() {};
                        $('#_wm_widget').val(widget);
                        $('#_wm_type').val(type);
                        $('#_wm_column').val(column);

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

            // DELETE **

            // DELETE WIDGET ***
            $(document).on("click", ".remove-card", function(e) {
                let el = this.parentElement.parentElement.parentElement;
                let column = $(this).closest('.section-side').data('widgetName');
                let widget = $(this).closest('.card-item').data('widgetName');
                let url = '/admin/manage/themes/'+theme+'/pages/'+slug+'/layout/'+layout+'/widget/'+widget;
                alertDel(url, 'widget-column', column, el);
            })
            // END DELETE WIDGET....................................................

            // DELETE COLUMN ***
            $(document).on("click", ".remove-column", function(e) {
                $('#add-column').removeClass('d-none');
                $('.static').removeClass('d-none');
                const column = $(this).parent().parent().data('widgetName');
                const url = '/admin/manage/themes/'+theme+'/pages/'+slug+'/layout/'+layout+'/column/'+column;
                const root = document.getElementById('nested-widget');

                const removedWidgets = $(this).parent().next().find("div.card").map(function() {
                    return $(this).data('widgetName')}
                ).toArray();

                columnAdjustment(column);
                this.parentElement.parentElement.remove();

                let data = serialize(root, '.section-column');
                alertDelColumn(url, data, removedWidgets)
            });
            // END DELETE COLUMN....................................................

        });
    </script>
@endpush
