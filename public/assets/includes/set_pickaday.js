function initPickaday() {
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
}
