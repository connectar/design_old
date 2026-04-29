$(document).ready(function () {
    window.addEventListener("showDeletedBox", (event) => {
        Swal.fire(event.detail.alert).then((result) => {
            if (result.isConfirmed) {
                (async function () {
                    const {
                        value: password
                    } = await Swal.fire({
                        title: "Enter your password",
                        input: "password",
                        inputLabel: "كلمة سر المدير",
                        inputPlaceholder: "اكتب كلمة السر الخاصه بالدخول",
                        showCancelButton: true,
                        cancelButtonText: "الغاء",
                        confirmButtonText: "استمرار",
                        inputValidator: (value) => {
                            if (!value) {
                                return "كلمة السر ضروريه لحذف السيرفر";
                            }
                        },
                    });

                    if (password) {
                        Livewire.dispatch(
                            "confirmDeletedOperation",
                            event.detail.modelId,
                            password
                        );
                    }
                })();
            }
        });
    });

    window.addEventListener("showNasRebootBox", (event) => {
        Swal.fire(event.detail.alert).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch(
                    event.detail.eventName,
                    event.detail.modelId,
                    false
                );
            }
        });
    });

    window.addEventListener("showRestoredBox", (event) => {
        Swal.fire(event.detail.alert).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch(
                    event.detail.eventName,
                    event.detail.modelId,
                );
            }
        });
    });

    window.addEventListener("nasReboot", (event) => {
        setTimeout(() => {
            Livewire.dispatch('refresh');
        }, 2000);
    });

    window.addEventListener("showNasAdminEditPasswordBox", (event) => {
        $("#NasOptionalBoxModal").modal({
            keyboard: false,
            backdrop: false,
        });
        $("#NasOptionalBoxModal").modal("show");
    });
    window.addEventListener("setNasAdminEditPasswordBoxOpened", (event) => {
        $("#NasOptionalBoxModal").modal("show");
    });

    window.addEventListener("closeNasModal", (event) => {
        $("#NasOptionalBoxModal").modal("hide");
        if (event.detail.alert) {
            Swal.fire(event.detail.alert);
        }
        //to hide swal if user click cancel button
        event.detail.alert = false;
    });
});
