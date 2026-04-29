// __token value
$(document).ready(function () {
    $(document).on("submit", ".SettingsForm", function (e) {
        e.preventDefault();
        var form = this;
        var formdata = new FormData(form);
        var MainForm = $(this);
        resetErorrClasses(MainForm);
        $.ajax({
            url: form.action,
            type: "POST",
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            success: function (responseData) {
                if (responseData.status == 200) {
                    window.location = responseData.url;
                }
            },
            error: function (reject) {
                console.log(reject);
                if (reject.status == 422) {
                    $("#DistributerForm .main_tab").removeClass("active");
                    $("#DistributerForm .create_user_button").addClass(
                        "active"
                    );
                    $("#DistributerForm #create_user").addClass("active");
                    setErrorsClassToInputsFildes(reject.responseJSON.errors);
                    if (reject.responseJSON.errors.nas) {
                        $("#selectNas").parents(".form-group").addClass("error");
                        $("#selectNas")
                            .parents(".form-group")
                            .append(
                                '<div class="help-block"><ul role="alert"><li>' +
                                reject.responseJSON.errors.nas[0] +
                                "</li></ul></div>"
                            );
                    }
                } else {
                    //window.location = reject.responseJSON.url;
                }
            },
        });
        return false;
    });

});
