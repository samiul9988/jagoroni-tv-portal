@extends('admin.themes.widgets')

@section('section')
<section class="section-side col-lg-8 col-md-8 offset-md-2 border pt-3 pb-3 mb-5">
    <div id="sortable" class="section-row">
        @foreach($widgets as $i => $widget)
            <div class="card card-item" data-widget-name="{{ $i }}" data-widget-data="{{ json_encode($widget) }}">
                <div class="card-header handle">
                    <h3 class="card-title">
                         {{ Str::headline($i) }}
                    </h3>
                    <div class="card-tools" data-card-type="widget">
                        @if ($i == 'map')
                            <button type="button" class="btn btn-tool bg-default btn-sm edit-card">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        @endif
                        
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

            // SET ACTIVE WIDGET **
            $(document).on("click", ".active-card", setActive);
            // END ACTIVE WIDGET....................................................

            // MODAL CLOSE **

            $('#edit-widget-contact').on('hidden.bs.modal', function () {
                $("#disqus_el").addClass('d-none');
                $("#map_el").addClass('d-none');
            })

            // EDIT **

            // EDIT WIDGET (SHOW MODAL) ***
            $(document).on("click", ".edit-card", function(e) {
                e.preventDefault();

                $(this).attr('data-status','edit-card');
                let type = $(this).closest('.card-tools').data('cardType');
                let widget = $(this).closest('.card-item').data('widgetName');

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

                        $('#edit-widget-modal').modal('show');
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

            /// UPDATE WIDGET ***
            function submitUpdateWidget(){
                $.ajax({
                    type: "PUT",
                    url: "/admin/manage/themes/"+theme+"/pages/"+slug+"/layout/"+layout,
                    cache:false,
                    data: $('form#widgetModalForm').serialize(),
                    success: function(response){
                        notification(response);
                        
                        $("[data-status='edit-card']").removeAttr('data-status');
                    },
                    error: function(){
                        alert("Error");
                    }
                });
            }
            // END UPDATE WIDGET....................................................
        });

    </script>
@endpush
