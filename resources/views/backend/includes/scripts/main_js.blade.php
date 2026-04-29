<script src="{{ asset('assets/main.js') }}"></script>
<script>
    $('#country_id').on('change', function() {
        if ($(this).val() == 1) {
            $('#governorates').show();
        } else {
            $('#governorates').hide();
        }
    });
</script>
