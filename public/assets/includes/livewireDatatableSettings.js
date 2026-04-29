$(document).ready(function () {
    /**
     * fix dropdown show on table responsive;
     */

    $(".table-responsive")
        .on("shown.bs.dropdown", function (e) {
            var normalHeight = $(this).outerHeight();
            var menuHeight = $('.dropdown-menu').innerHeight();
            $('.table-responsive').css("overflow", "inherit");
            if (menuHeight > 100) {
                $('.table-responsive').css("min-height", (menuHeight + normalHeight + 100) + 'px');
            }

        })
        .on("hidden.bs.dropdown", function () {
            $('.table-responsive').css("min-height", "300px");
            $('.table-responsive').css("overflow", "auto");
        });

    const slimOption = {
        color: "#0bb2d4",
        size: "10px",
        height: "420px",
        alwaysVisible: true,
    };
    $(".collectionTable").slimScroll(slimOption);
    window.addEventListener("updatedSlimScroll", (event) => {
        $(".collectionTable").slimScroll(slimOption);
    });


    //listeners

    window.addEventListener("showDeletedBox", (event) => {
        Swal.fire(event.detail.alert).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch("confirmDeletedOperation", event.detail.modelId);
            }
        });
    });

    window.addEventListener("modalClose", (event) => {
        $("#userOptionalBoxModal").modal("hide");
        // unchecked items
        $('#checkAllItems').prop('checked', false);
        $('.usersIds').each(function () {
            $(this).prop('checked', false);
        });
        $("#userOptionalBoxModal").on("hidden.bs.modal", function () {
            if (event.detail.alert) {
                Swal.fire(event.detail.alert);
            }
            //to hide swal if user click cancel button
            event.detail.alert = false;
        });
    });

    window.addEventListener("sweetAlertShow", (event) => {
        Swal.fire(event.detail.alert);
        $('.usersIds').each(function () {
            $(this).prop("checked", false);
        });
        $('#checkAllItems').prop("checked", false);
    });
    /// select all menu

    $("#checkAllItems").change(function () {
        $(".usersIds").prop('checked', this.checked);
    });

    $('.deleteAll').on('click', function () {
        doProccess('showDeletedAllBox');
    });

    $('.renewCollectionOfUsers').on('click', function () {
        doProccess('renewCollectionOfUsers');
    });

    $('.moveToNas').on('click', function () {
        doProccess('moveUsersToNas');
    });

    $('.ChangeOfferForCollectionOfUsers').on('click', function () {
        doProccess("ChangeOfferForCollectionOfUsers", getAllCheckedIds());
    });

    $('.editQutaForCollection').on('click', function () {
        doProccess("editQutaForCollection", getAllCheckedIds());
    });

    $('.toggleStatusForCollection').on('click', function () {
        var ids = getAllCheckedIds();
        if (ids.length > 0) {
            Livewire.dispatch('toggleStatusForCollection', getAllCheckedIds(), $(this).data('status'));
            return;
        }
        alert('لم تختار شىء!');
    });

    $('.toggleStatusForTransactions').on('click', function () {
        var ids = getAllCheckedIds();
        if (ids.length > 0) {
            Livewire.dispatch('toggleStatusForTransactions', getAllCheckedIds(), $(this).data('status'));
            return;
        }
        alert('لم تختار شىء!');
    });

    $('.editExpiredDateForCollection').on('click', function () {
        doProccess('editExpiredDateForCollection');
    });

    window.addEventListener("hideAlert", (event) => {
        setTimeout(Livewire.dispatch("hideAlertBox"), 3000);
    });

});

function doProccess(action) {
    var ids = getAllCheckedIds();
    if (ids.length > 0) {
        Livewire.dispatch(action, getAllCheckedIds());
        return;
    }
    alert('لم تختار شىء!');
}

function getAllCheckedIds() {
    var selected = [];
    $('.usersIds').each(function () {
        if ($(this).is(":checked")) {
            selected.push($(this).val());
        }
    });
    return selected;
}
