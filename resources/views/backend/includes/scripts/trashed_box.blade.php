<script>
    /** delete from database */
$(document).on("click", ".deleteModel", function () {
        Swal.fire(@json($deleteAlert))
        .then((result) => {
            if (result.isConfirmed) {
                $.post(this.href, { _method: "DELETE" },
                     (data) => {
                          Swal.fire(data.alert).then((result) => {
                                result.isConfirmed ?location.reload():false;
                        });
                      }
                ).fail(function (data) {Swal.fire(JSON.parse(data.responseJSON.alert));});
            }
        });
        return false;
});
</script>
