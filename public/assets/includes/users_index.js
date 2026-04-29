$(document).ready(function () {
    var monthes = [
        "يناير [1]",
        "فبراير [2]",
        "مارس [3]",
        "أبريل [4]",
        "مايو [5]",
        "يونيو [6]",
        "يوليو [7]",
        "أغسطس [8]",
        "سبتمبر [9]",
        "أكتوبر [10]",
        "نوفمبر [11]",
        "ديسمبر [12]",
    ];
    var nowDate = new Date();
    var i18n = {
        previousMonth: "الشهر السابق",
        nextMonth: "الشهر القادم",
        months: monthes,
        weekdays: moment.localeData()._weekdays,
        weekdaysShort: moment.localeData()._weekdaysShort,
    };

    function tostringDate(date) {
        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();
        return `${year}/${month}/${day}`;
    }

    function parseDate(dateString) {
        const parts = dateString.split("/");
        const day = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10) - 1;
        const year = parseInt(parts[2], 10);
        return new Date(year, month, day);
    }

    const slimOption = {
        color: "#0bb2d4",
        size: "10px",
        height: "520px",
        alwaysVisible: true,
    };

    window.addEventListener("modalShow", (event) => {
        //set pikaday here to fix Maximum call stack size exceeded
        var picker = new Pikaday({
            field: document.getElementById("datepicker"),
            format: "YYYY/MM/DD",
            // minDate: nowDate,
            // maxDate: maxDate,
            i18n: i18n,
            toString(date, format) {
                return tostringDate(date);
            },
            parse(dateString, format) {
                return parseDate(dateString);
            },
        });
        picker.setDate(nowDate);
        $("#userOptionalBoxModal").modal({
            keyboard: false,
            backdrop: false,
        });
        $("#userOptionalBoxModal").modal("handleUpdate");
        $("#userOptionalBoxModal").modal("show");
        $(".collectionTable").slimScroll(slimOption);
        $("#userOptionalBoxModal").on("hidden.bs.modal", function () {
            //very important to fix Maximum call stack size exceeded
            picker.destroy();
        });
    });

    window.addEventListener("toggleUserStatus", (event) => {
        Swal.fire(event.detail.alert).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch(
                    //event.detail.componentName,
                    event.detail.eventName,
                    event.detail.userId,
                    event.detail.status
                );
            }
        });
    });

    window.addEventListener("toggleStatusForCollection", (event) => {
        Swal.fire(event.detail.alert).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch(
                    event.detail.eventName,
                    event.detail.ids,
                    event.detail.status
                );
            }
        });
    });

    window.addEventListener("activiatePikaday", (event) => {
        //set pikaday here to fix Maximum call stack size exceeded
        var picker = new Pikaday({
            field: document.getElementById("datepicker"),
            format: "YYYY/MM/DD",
            i18n: i18n,
            toString(date, format) {
                return tostringDate(date);
            },
            parse(dateString, format) {
                return parseDate(dateString);
            },
        });
        picker.setDate(nowDate);
    });

    window.addEventListener("closeSwalBox", (event) => {
     Swal.close();
    });


    window.addEventListener("nestableInit", (event) => {
     var updateOutput = function(e) {
                    var list = e.length ? e : $(e.target),
                        output = list.data('output');

                    if (window.JSON) {
                        output.val(window.JSON.stringify(list.nestable(
                            'serialize'))); //, null, 2));
                    } else {
                        output.val('JSON browser support required for this demo.');
                    }

                    console.log(window.JSON.stringify(list.nestable(
                            'serialize')));

                };
                $('#nestable2').nestable({
                    group: 1
                }).on('change', function(){
                    Livewire.dispatch('nestableColumns',$('#nestable2').nestable('serialize'));
                });

                // updateOutput($('#nestable2').data('output', $('#nestable2-output')));

    });
});
