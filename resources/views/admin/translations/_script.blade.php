<script>
    // LANGUAGE
    $("#language").select2({
        theme:"bootstrap4",
        allowClear: true,
        selectOnClose: false,
        tokenSeparators: [",", " "],
        ajax: {
            url: "{{ route('getdatalanguage') }}",
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.language_code,
                            text: item.language
                        }
                    })
                }
            }
        }
    });

    function htmlEntities(str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
</script>
