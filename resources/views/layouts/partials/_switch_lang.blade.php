<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
        }
    })

    // Change language dashboard
    $(document).on("click", ".setting-language", function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: "/admin/settings/change-dashboard-language",
            dataType: "json",
            method: "GET",
            data: {
                'id': id
            },
            success: function() {
                window.location.reload();
            }
        });
    });
</script>
