$(document).ready(function () {

    const slimOption = {
        color: "#0bb2d4",
        size: "10px",
        height: "520px",
        // alwaysVisible: true,
    };

    window.addEventListener("modalShow", (event) => {
        //set pikaday here to fix Maximum call stack size exceeded
        $("#userOptionalBoxModal").modal({
            keyboard:false,
            backdrop:false,
        });
        $("#userOptionalBoxModal").modal("handleUpdate");
        $("#userOptionalBoxModal").modal("show");
        $(".collectionTable").slimScroll(slimOption);
    });
});
