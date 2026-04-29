function swalLoading() {
    var content =
        '<div class="text-primary">يرجى الانتظار</div><span class="spinner-border text-info"></span>';
    Swal.fire({
            html: content,
            showCancelButton: false,
            showConfirmButton: false,
            focusConfirm: false,
            allowOutsideClick: false,
            customClass: {
                container: 'bg-dark',
                popup: 'bg-light',
            }
        });
}

function swalAlert(message) {

    return Swal.fire({
            html: message,
            showCancelButton: true,
            showConfirmButton: true,
            focusConfirm: false,
            allowOutsideClick: false,
            confirmButtonText:'نعم',
            cancelButtonText:'الغاء',
            customClass: {
                popup: 'bg-dark',
            }
        });
}

function swalConfirmBox(message,callback,runCallback = false) {

    let swalObject = Swal.fire({
            html: message,
            showCancelButton: true,
            showConfirmButton: true,
            focusConfirm: false,
            allowOutsideClick: false,
            confirmButtonText:'نعم',
            cancelButtonText:'الغاء',
            customClass: {
                popup: 'bg-dark',
            }
        });
    if(runCallback){
        swalObject.then((result) => {
            if (result.isConfirmed) {
                callback();
            }
        });
    }
}

$(document).ready(function () {
 window.addEventListener("showSwalBox", (event) => {
     Swal.fire({
        html: event.detail.html,
        showCancelButton: false,
        showConfirmButton: false,
        focusConfirm: false,
        allowOutsideClick: false,
    });
    });
 window.addEventListener("closeSwalBox", (event) => {
     Swal.close();
    });
});
