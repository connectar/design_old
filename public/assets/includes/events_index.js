$(document).ready(function () {


    window.addEventListener("showAlertBox", (event) => {
        Swal.fire(event.detail.alert).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch(
                    event.detail.eventName,
                    event.detail.modelId,
                );
            }
        });
    });
});
