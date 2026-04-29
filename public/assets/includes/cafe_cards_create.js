$(function () {

    window.addEventListener("updatedPhoto", (event) => {
        $(".card-container").attr(
            "style",
            "background:url(" +
            event.detail.photo +
            ") no-repeat;background-size: 100% 100%;"
        );
    });
    // target elements with the "draggable" class
    interact('.draggable')
        .draggable({
            // enable inertial throwing
            inertia: true,
            // keep the element within the area of it's parent
            modifiers: [
                interact.modifiers.restrictRect({
                    restriction: 'parent',
                    endOnly: true
                })
            ],
            // enable autoScroll
            autoScroll: true,

            listeners: {
                // call this function on every dragmove event
                move: dragMoveListener,

                // call this function on every dragend event
                end(event) {
                    endDragedItem(event)
                }


            }
        })

    function dragMoveListener(event) {
        var target = event.target
        // keep the dragged position in the data-x/data-y attributes
        var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
        var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy

        // translate the element
        // target.style.transform = 'translate(' + x + 'px, ' + y + 'px)'
        target.style.left = x + 'px';
        target.style.top = y + 'px';
        target.style.border = "1px dashed red";

        // update the posiion attributes
        target.setAttribute('data-x', x)
        target.setAttribute('data-y', y)
    }

    function endDragedItem(event) {
        var target = event.target

        //remove border from target
        target.style.border = "0";
        // keep the dragged position in the data-x/data-y attributes
        var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
        var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy

        var itemName = target.dataset.name;

        var cardItmes = JSON.parse(localStorage.getItem("cardItems"));
        cardItmes['items'][itemName]["x"] = x;
        cardItmes['items'][itemName]["y"] = y;
        localStorage.setItem("cardItems", JSON.stringify(cardItmes));
    }

    const __token = $('[name="csrf-token"]').attr("content");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": __token
        }
    });
    $(".addCardDesign").on("click", function () {

        Livewire.dispatch(
            'save',
            JSON.parse(localStorage.getItem("cardItems")),
        );
    });

    localStorage.setItem(
        "cardItems",
        JSON.stringify({
            card: {
                background: "",
                height: '200',
                width: '300',
                share: 1,
                name: "تصميم جديد",
            },
            items: {
                serial: {
                    opacity: 1,
                    x: "0",
                    y: "0",
                    color: "#563d7c",
                    font: "arial",
                    value: "99999999",
                    "font-size": 14,
                },
                price: {
                    opacity: 1,
                    x: "30",
                    y: "70",
                    color: "#563d7c",
                    font: "arial",
                    "font-size": 14,
                },
                qr: {
                    opacity: 0,
                    x: "30",
                    y: "70",
                    color: "#563d7c",
                    font: "arial",
                    "font-size": 14,
                    width: 75,
                    height: 75,
                },
            }
        })
    );

    let units = {
        "font-size": 'pt',
        'color': '',
        'opacity': '',
        'width': 'px',
        'height': 'px'
    }

    $(".item-change").on("change", function () {
        setItemProperty($(this), $(this).val());
    });

    $(".show-item").on("click", function () {
        let value = $(this).prop("checked") ? 1 : 0;
        setItemProperty($(this), value);
    });

    $(".share-card").on("click", function () {
        let value = $(this).prop("checked") ? 1 : 0;
        var cardItmes = JSON.parse(localStorage.getItem("cardItems"));
        cardItmes['card']['share'] = value;
        localStorage.setItem("cardItems", JSON.stringify(cardItmes));
    });

    $(".set-card-name").on("keyup", function () {
        let value = $(this).val();
        if (value.length < 1) {
            $(this).parents(".form-group").addClass("error");
            $('.cardNameError').css("display", "block");
        } else {
            $(this).parents(".form-group").removeClass("error");
            $('.cardNameError').css("display", "none");
        }
        var cardItmes = JSON.parse(localStorage.getItem("cardItems"));
        cardItmes['card']['name'] = value;
        localStorage.setItem("cardItems", JSON.stringify(cardItmes));
    });

    function setItemProperty(obj, value) {
        let name = obj.data("name");
        let property = obj.data("property");

        $('#' + name).css(property, value + units[property]);

        var cardItmes = JSON.parse(localStorage.getItem("cardItems"));
        cardItmes['items'][name][property] = value;
        localStorage.setItem("cardItems", JSON.stringify(cardItmes));
    }

    $(".changeSerialValue").on("keyup", function () {
        $("#serial").text($(this).val());
        setItemProperty($(this), $(this).val());
    });

});

function uploadedImage(image) {
    var file = image.files[0];
    $("#cardImageName").val(file.name);

    var reader = new FileReader();
    reader.onloadend = function () {
        $(".card-container").attr(
            "style",
            "background:url(" +
            reader.result +
            ") no-repeat;background-size: 100% 100%;"
        );
        var cardItmes = JSON.parse(localStorage.getItem("cardItems"));
        cardItmes.card.background = reader.result;

        localStorage.setItem("cardItems", JSON.stringify(cardItmes));
    };
    reader.readAsDataURL(file);
}
