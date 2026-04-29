$(document).ready(function () {
    /**
     * fix dropdown show on table responsive;
     */
    window.addEventListener("toggleStatusForTransactions", (event) => {
        Swal.fire(event.detail.alert).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch(
                    event.detail.eventName,
                    event.detail.ids,
                    event.detail.status,
                );
            }
        });
    });

    window.addEventListener("showDeletedAllBox", (event) => {
        console.log(event.detail.ids);
        Swal.fire(event.detail.alert).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch(
                    event.detail.eventName,
                    event.detail.ids,
                );
            }
        });
    });

});
