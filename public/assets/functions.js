function chooseDistributer(distributer) {
    $(".select_distributor").on(
        "changed.bs.select",
        function (e, clickedIndex, isSelected, previousValue) {
            if (
                (clickedIndex == 0 && isSelected == true) ||
                distributer.length == 0
            ) {
                $(".select_distributor").selectpicker("val", 0);
            } else if (clickedIndex != 0) {
                if (distributer[0] == 0) {
                    distributer.shift();
                }
                $(".select_distributor").selectpicker("val", distributer);
            }
        }
    );
    // console.error('form chooseDistributer');
}

function togglePhoneInput(phoneIsEnabled, phone) {
    if (phoneIsEnabled == false) {
        localStorage.setItem("phone", phone);
    }
    return phoneIsEnabled == false ? "" : localStorage.getItem("phone");
}

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
