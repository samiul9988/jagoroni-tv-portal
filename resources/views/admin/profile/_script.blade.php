<script>
    "use strict";

    $(function () {
        $('.icp-auto').iconpicker();
        $('#cp2').colorpicker();
    });

    $('#addLink').on('click', function(){
        $('#add-link-modal').modal('show');
    });

    function createInputLinks(data) {
        console.log(data);
        let count = $(".links > .row").length,
        id = count+1,
        html = `<div class="form-group row linkItem" id="link${id}">
                <label for="" class="col-sm-2 col-form-label">${data.label}</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input class="linkId" type="hidden" name="links[${id}][id]" value="${id}">
                        <input class="linkLabel" type="hidden" name="links[${id}][label]" value="${data.label}">
                        <input class="linkIcon" type="hidden" name="links[${id}][icon]" value="${data.icon}">
                        <input class="linkColor" type="hidden" name="links[${id}][color]" value="${data.color}">
                        <div class="input-group-prepend"><span class="input-group-text"> <i
                            class="${data.icon}"></i></span></div>
                        <input type="text" name="links[${id}][url]"
                                class="form-control bg-link-input" placeholder="http://www.example.com"
                                value="${data.url}" readonly>
                            <div class="input-group-append"
                                    onClick="removeInput(${id})" style="cursor:pointer"><span
                                class="input-group-text"><i class="fas fa-times"></i></span>
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

    $('select#role').select2({
        theme: 'bootstrap4',
        selectOnClose: true,
        ajax: {
            url: "{{ route('roles.search') }}",
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        }
                    })
                }
            }
        }
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

    $('#addLink').on('click', function(){
        $('#add-link-modal').modal('show');
    });

    $(function() {
        $('.upload-msg').on("click", function() {
            $('#btn-remove').attr('hidden', 'hidden');
            $('#btn-upload-result').removeAttr('hidden');
            $('#btn-upload-reset').removeAttr('hidden');
            $('#upload').trigger("click");
        })

        $('#btn-upload-reset, #btn-remove').on("click", function() {
            $('#btn-remove').attr('hidden', 'hidden');
            $('#display').removeAttr('hidden');
            $('#btn-upload-result').removeAttr('hidden');
            $('#btn-upload-reset').removeAttr('hidden');
            $('.upload-photo').removeClass('ready result');
            $("#display-i").html('');
            $('#upload').val('');
            $('input[name=isupload]').val("remove");
        });

        let $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                if (/^image/.test(input.files[0].type)) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $('.upload-photo').addClass('ready');
                        $('input[name=isupload]').val("true");
                        $uploadCrop.croppie('bind', {
                            url: e.target.result
                        }).then(function() {
                            // console.log('jQuery bind complete');
                        });
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert("__('You may only select image files')");
                }
            } else {
                alert("__('Sorry - you're browser doesn't support the FileReader API')");
            }
        }

        $uploadCrop = $('#display').croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'square'
            },
            boundary: {
                width: 300,
                height: 300
            },
        });

        function popupResult(result) {
            let html = '<img src="' + result.src + '" />';
            $("#display-i").html(html);
        }

        $('#upload').on('change', function() {
            readFile(this);
        });

        $('#btn-upload-result').on('click', function(ev) {
            let fileInput = document.getElementById('upload');
            let fileName = fileInput.files[0].name;
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {
                $('#btn-upload-result').attr('hidden', 'hidden');
                $('#display').attr('hidden', 'hidden');
                $('.upload-photo').addClass('result');
                $('input[name=image_base64]').val(resp);
                popupResult({
                    src: resp
                });
            });
        });
    });
</script>
