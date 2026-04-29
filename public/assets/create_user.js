function userCreateErorrsHandle(errors) {
    let userDataErors = 0,
        userMacErors = 0;
    $('.showMacCountErorr').removeClass('hide');
    for (const key in errors) {
        if (key.includes("userData")) {
            userDataErors++;
        }
        if (key.includes("defined_macs")) {
            userMacErors++;
        }

        if (key.includes("countOfMacs")) {
            userMacErors++;
        }
    }
    $(".nav-link").removeClass('active');
    $(".tab-pane").removeClass('active');

    if (userDataErors > 0) {

        $(".create_user_button").addClass('active');
        $("#create_user").addClass('active');

    } else if(userMacErors > 0){
        $('.showMacCountErorr').removeClass('hide');
        $(".create_user_mac_button").addClass('active');
        $("#create_user_macs").addClass('active');
    }
}
$(document).ready(function () {
    $("#create_user").find("i").eq(2).addClass("text-danger");
    $("#create_user").find("i").eq(3).addClass("text-warning");
    $("#create_user").find("i").eq(4).addClass("text-info");
    $("#create_user").find("i").eq(5).css("color", "#AED6F1");
    $("#create_user").find("i").eq(6).addClass("text-danger");
    $("#create_user").find("i").eq(7).addClass("text-success");
    $("#create_user").find("i").eq(8).addClass("text-primary");
    $("#create_user").find("i").eq(9).addClass("text-primary");
    $("#create_user").find("i").eq(10).addClass("text-info");
    // $("#create_user").find("i").eq(11).addClass("text-dark");
    $("#create_user").find("i").eq(11).css("color", "#DAF7A6");
    $("#create_user").find("i").eq(13).css("color", "#E9967A");
    $(".create_user_button").click(function () {
        console.log("clicked");
    });
});
