$(document).ready(function () {
    window.addEventListener("modalShow", (event) => {
        $("#userOptionalBoxModal").modal("handleUpdate");
        $("#userOptionalBoxModal").modal("show");

    });
});
