$(document).ready(function () {
    const slimOption = {
        color: "#0bb2d4",
        size: "10px",
        height: "520px",
        alwaysVisible: true,
    };

    window.addEventListener("modalShow", (event) => {
        $("#userOptionalBoxModal").modal({
            keyboard: false,
            backdrop: false,
        });
        $("#userOptionalBoxModal").modal("handleUpdate");
        $("#userOptionalBoxModal").modal("show");
        $(".collectionTable").slimScroll(slimOption);
        $("#userOptionalBoxModal").on("hidden.bs.modal", function () {
            //very important to fix Maximum call stack size exceeded
        });
    });

    window.addEventListener("saveNewDevice", (event) => {
        Livewire.dispatch(event.detail.eventName);
    });

    window.addEventListener("checkConnection", (event) => {
        Livewire.dispatch(
            event.detail.eventName,
            event.detail.nas_address,
            event.detail.ip_address,
        );
    });


    window.addEventListener("checkDnatConnection", (event) => {
        Livewire.dispatch(
            event.detail.eventName,
            event.detail.nas_address,
            event.detail.device_uuid,
            event.detail.device_type,
            event.detail.device_ip,
            event.detail.device_port,
            event.detail.device_schema
        );
    });

    window.addEventListener("refreshIframe", (event) => {
        // Query the elements
        document.getElementById("loading").style.display = 'block';
        const iframeEle = document.getElementById('myIframe');
        iframeEle.style.opacity = "0";

        iframeEle.onload = function () {
            document.getElementById("loading").style.display = "none";
            document.getElementById("loading").style.zIndex = "0";
            iframeEle.style.opacity = "1";
            // iframeEle.style.zIndex = "1";
            console.log('loaded successfull');
        }
    });

});
