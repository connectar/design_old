$(document).ready(function () {
    window.addEventListener("showDeletedBox", (event) => {
        Swal.fire(event.detail.alert).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch("confirmDeletedOperation", event.detail.modelId);
            }
        });
    });
    window.addEventListener("sweetAlertShow", (event) => {
        Swal.fire(event.detail.alert);
    });
});
