window.addEventListener("copyScript", (event) => {
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = event.detail.script;
    document.body.appendChild(tempInput);
    tempInput.select();
    try {
        var successful = document.execCommand("copy", false, null);
        if (successful) {
            Swal.fire(event.detail.alert.success);
            Livewire.dispatch("nextStep");
        }
    } catch (err) {
        Swal.fire(event.detail.alert.error);
        alert("Oops, unable to copy to clipboard");
    }
});
window.addEventListener("check_connection_step", (event) => {
    Livewire.dispatch("checkConnectionStatus");
});
window.addEventListener("checkInstalledStatus", (event) => {
    Livewire.dispatch("checkInstalledStatus");
});
