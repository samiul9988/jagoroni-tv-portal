<script>
    "use strict";

    $(function () {
        $('.icp-auto').iconpicker();
        $('#cp2').colorpicker();
    });

    $('#addLink').on('click', function(){
        $('#add-link-modal').modal('show');
    });

    $('#add-link-modal').on('hide.bs.modal', function (event) {
        $('#linkForm')[0].reset();
    })

    function createInputLinks(data) {
        let count = $(".links > .col-lg-6").length,
        id = count+1,
        html = `<div class="col-lg-6 linkItem" id="link${id}">
                    <div class="form-group">
                        <label>${data.label}</label>
                        <div class="input-group">
                            <input class="linkId" type="hidden" name="links[${id}][id]" value="${id}">
                            <input class="linkLabel" type="hidden" name="links[${id}][label]" value="${data.label}">
                            <input class="linkIcon" type="hidden" name="links[${id}][icon]" value="${data.icon}">
                            <input class="linkColor" type="hidden" name="links[${id}][color]" value="${data.color}">
                            <div class="input-group-prepend"><span class="input-group-text"> <i class="${data.icon}"></i></span></div>
                            <input type="text" name="links[${id}][url]" class="bg-link-input form-control" placeholder="http://www.example.com" value="${data.url}" title="${data.url}" readonly>
                            <div class="input-group-append" onClick="removeInput(${id})" style="cursor:pointer">
                                <span class="input-group-text"><i class="fas fa-times"></i></span>
                            </div>
                        </div>
                    </div>
                </div>`;
        $('.links').append(html);
        $('#linkForm')[0].reset();
    }

    $(document).on("click", "#submitAddLink", function(e){
        let data = {
            "label": $('#link-label').val(),
            "url"  : $('#link-url').val(),
            "icon" : $('#link-icon').val(),
            "color": $('#link-color').val(),
        }
        createInputLinks(data);
        $('#add-link-modal').modal('hide');
    });

    function removeInput(id) {
        let input = document.getElementById("link" + id);
        input.remove();

        $('.linkItem').each(function(i){
            $(this).attr('id', 'link' + (i+1));
            $(this).find('.linkId').attr('name', 'links[' + (i+1) + '][id]');
            $(this).find('.linkId').val((i+1));
            $(this).find('.linkLabel').attr('name', 'links[' + (i+1) + '][label]');
            $(this).find('.linkIcon').attr('name', 'links[' + (i+1) + '][icon]');
            $(this).find('.linkColor').attr('name', 'links[' + (i+1) + '][color]');
            $(this).find('.bg-link-input').attr('name', 'links[' + (i+1) + '][url]');
            $(this).find('.input-group-append').attr('onClick', 'removeInput(' + (i+1) + ')')
        });
    }

</script>
