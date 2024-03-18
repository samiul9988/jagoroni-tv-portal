<script>

    "use strict";

    function changeStatus(event)
    {
        var status = event.target.getAttribute("data-status");
        var id = event.target.getAttribute("data-id");

        $.ajax({
            type: "PATCH",
            dataType: "json",
            url: "/ajax/comments/status/"+id,
            data: { status: status },
            success: function (rsp) {
                toastr.success(rsp.success);

                event.target.innerText = (status === "approved") ? "{{ __('button.approved') }}" : "{{ __('button.pending') }}";

                event.target.classList.toggle('badge-success');
                event.target.classList.toggle('badge-danger');

                if (status == "approved") {
                    event.target.setAttribute("data-status", "pending");
                    event.target.setAttribute("data-original-title", "{{__('button.unapprove') }}");
                } else {
                    event.target.setAttribute("data-status", "approved");
                    event.target.setAttribute("data-original-title", "{{__('button.approve') }}");
                }
            }
        });
    }

    $(document).on("click", ".reply", setReply);

    function setReply() {
        let replyId = $(this).data('reply'),
        mainReply = $(this).data('main'),
        postId = $(this).data('post');
        
        $('#postId').val(postId);
        $('#replyId').val(replyId);
        $('#mainReply').val(mainReply);
        $('#commentModal').modal('show');
        $('#comment').val('');
    }

    $(document).on("click", "#comment-submit", sendComment);

    function sendComment() {
        $("#comment-submit").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('message.loading') }}</span></div> {{ __('message.sending') }}");

        var $this = $('#commentForm');
        var url = $('.comment-form').attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: $this.serialize(),
            dataType: 'json',
            success: function(resp) { 
                let errors = resp.errors,
                success = resp.success,
                failed = resp.failed;
                
                $("#comment-table").DataTable().ajax.reload();
                
                if (errors) {
                    if (errors.comment) {
                        $('#comment').addClass('is-invalid');
                    }else {
                        $('#comment').removeClass('is-invalid');
                    }
                } else if (success) {
                    notification(resp);
                    $this[0].reset();
                    $('#commentModal').modal('hide');
                } else {

                }   

                $(".spinner-grow").attr("hidden");
                $("#comment-submit").html("{{ __('button.reply') }}");
            }
        });
    }

    $(document).on("click", ".edit", showEdit);

    function showEdit() {
        var comment = $(this).closest('tr').find('td:eq(4)').text();
        let replyId = $(this).data('reply'),
        url = $(this).data('url');

        $('#replyId').val(replyId);
        $('#comment').val(comment);

        $('.comment-form').attr('action', url);
        $('#commentForm').append('<input type="hidden" name="_method" value="PUT">');
        $('#commentModal').modal('show');
    }

    $(document).ready(function () {
        $('#commentModal').on('hidden.bs.modal', function (event) {
            var url = '{{ route("comments.store") }}';
            $('input[name="_method"]').detach();
            $('#comment').val('');
            $('#replyId').val('');
            $('#mainReply').val('');
            $('#name').val('');
            $('#email').val('');
            $('#url').val('');
            $('.comment-form').attr('action', url);
            $('.comment-form').attr('data-action', '');
            $('.form-control').removeClass('is-invalid');
            $('.spinner-grow').attr('hidden');
            $('#comment-submit').html("{{ __('button.reply') }}");
        });
    });
</script>
