$(document).ready(function () {
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
});
