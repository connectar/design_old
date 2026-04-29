$(document).ready(function () {
    const __token = $('[name="csrf-token"]').attr("content");
    $("input[type='text']").prop("dir", "auto");

    $(document).on("submit", "#FormSubmit", function (e) {
        e.preventDefault();
        swalLoading();
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
                Swal.close();
                if (reject.status == 422) {
                    if (typeof userCreateErorrsHandle === "function") {
                        // safe to use the function
                        userCreateErorrsHandle(reject.responseJSON.errors);
                    }
                    if (reject.responseJSON.captcha_url) {
                        $("#captcha_image").attr(
                            "src",
                            reject.responseJSON.captcha_url
                        );
                    }
                    setErrorsClassToInputsFildes(reject.responseJSON.errors);
                } else {
                    console.log(reject);
                    window.location = reject.responseJSON.url;
                }
            },
        });
        return false;
    });

    function setErrorsClassToInputsFildes(errors) {
        var name = "";
        $.each(errors, function (key, val) {
            // check if key is array
            if (key.indexOf(".") != -1) {
                $.each(key.split("."), function (index, keyName) {
                    name += index == 0 ? `[name="${keyName}` : `[${keyName}]`;
                });
                name += `"]`;
            } else {
                name = `[name=${key}]`;
            }
            $(name).parents(".form-group").addClass("error");
            $(name)
                .parents(".form-group")
                .append(
                    '<div class="help-block"><ul role="alert"><li>' +
                    val[0] +
                    "</li></ul></div>"
                );
            name = "";
        });
    }

    /**
     * reset Erorr Classes
     *
     */
    function resetErorrClasses(MainForm) {
        MainForm.find(".help-block").each(function () {
            $(this).remove();
        });
        MainForm.find(".form-group").each(function () {
            $(this).removeClass("error");
        });
    }

    function swalLoading() {
        var content =
            '<div class="text-primary">يرجى الانتظار</div><span class="spinner-border text-info"></span>';
        Swal.fire({
            html: content,
            showCancelButton: false,
            showConfirmButton: false,
            focusConfirm: false,
            allowOutsideClick: false,
            customClass: {
                container: 'bg-dark',
                popup: 'bg-light',
            }
        });
    }
});
