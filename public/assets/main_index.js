// __token value
$(document).ready(function () {
    const __token = $('[name="csrf-token"]').attr("content");
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": __token } });

    $(document).on("change", ".managerActivable", function () {
        let element = this,
            admin_id = $(this).attr("id");
        $.post(`admins/${admin_id}/activable`, { _method: "PATCH" }, (data) => {
            Swal.fire(JSON.parse(data.alert));
        }).fail(function (data) {
            element.checked = !element.checked;
            Swal.fire(JSON.parse(data.responseJSON.alert));
        });
    }); //end of managerActivable

    $(document).on("change", "[name=perPage]", function () {
        window.location.replace(
            window.location.href + "&perPage=" + $(this).val()
        );
    });

    $(document).on("click", ".restoreModel", function () {
        $.post(this.href, {}, (data) => {
            Swal.fire(data.alert).then((result) => {
                result.isConfirmed ? location.reload() : false;
            });
        }).fail(function (data) {
            Swal.fire(JSON.parse(data.responseJSON.alert));
        });

        return false;
    });
    $(document).on("click", ".showOfferModel", function () {
        $.post('/admins/offers/show-offer-model', {}, (data) => {
            console.log(data);
            Swal.fire(data.alert);
        });

        return false;
    });
    /** delete from database */
    // $(document).on("click", ".deleteManager", function () {
    //     var element = this;
    //     let managerId = $(this).attr("id");
    //     const swalWithBootstrapButtons = Swal.mixin({
    //         customClass: {
    //             // container: "bg-transparent",
    //             confirmButton: "waves-effect waves-light btn btn-rounded btn-success",
    //             cancelButton: "waves-effect waves-light btn btn-rounded btn-danger m-5",
    //             popup : "bg-light p-5",
    //             htmlContainer:"bg-danger",
    //         },
    //         buttonsStyling: false,
    //     });

    //     swalWithBootstrapButtons
    //         .fire({
    //             title: "Are you sure?",
    //             text: "You won't be able to revert this!",
    //             icon: "warning",
    //             showCancelButton: true,
    //             confirmButtonText: "Yes, delete it!",
    //             cancelButtonText: "No, cancel!",
    //             reverseButtons: true,
    //         })
    //         .then((result) => {
    //             if (result.isConfirmed) {
    //                 swalWithBootstrapButtons.fire(
    //                     "Deleted!",
    //                     "Your file has been deleted.",
    //                     "success"
    //                 );
    //             } else if (
    //                 /* Read more about handling dismissals below */
    //                 result.dismiss === Swal.DismissReason.cancel
    //             ) {
    //                 swalWithBootstrapButtons.fire(
    //                     "Cancelled",
    //                     "Your imaginary file is safe :)",
    //                     "error"
    //                 );
    //             }
    //         });
    //     // $.ajaxSetup({headers: { "X-CSRF-TOKEN": __token }});
    //     // $.post(
    //     //     `managers/${managerId}/activable`,
    //     //     { _method: "DELETE" },
    //     //     (data) => {
    //     //         Swal.fire(JSON.parse(data.alert));
    //     //     }
    //     // ).fail(function (data) {
    //     //    element.checked = !element.checked;
    //     //    Swal.fire(JSON.parse(data.responseJSON.alert));
    //     // });
    // });
    // $.ajaxSetup({
    //         headers: {'X-CSRF-TOKEN': __token},
    //     });

    // $("#orderStatus").change(function () {
    //     $("#changeStatus").submit();
    // });

    // $("#customer_type").change(function () {
    //     $("#customer").submit();
    // });

    // $("#getCitiesPriceSelect").change(function () {
    //     $("#getCitiesPrice").submit();
    // });
    // $(document).on("click", ".showSingleModel", function () {
    //     $.get(this.href, {}, function (data) {
    //         mainAlertBody(data);
    //     });
    //     return false;
    // });

    // $(document).on("click", ".showInOpenModal", function () {
    //     $.get(this.href, {}, function (data) {
    //         $("#modal-default .modal-body").html("");
    //         $("#modal-default .modal-body").html(data);
    //     });
    //     return false;
    // });
    /// print order num
    // $(document).on("click", ".button-print", function () {
    //     $("#modal-print").modal("hide");
    //     $("#modal-print").on("hidden.bs.modal", function (e) {
    //         $("#modal-print").off("hidden.bs.modal");
    //         window.print();
    //     });
    //     return false;
    // });

    ////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    // $("#selectAllPlaces").click(function () {
    //     var clicks = $(this).data("clicks");
    //     if (clicks) {
    //         $(".placeIndex input[type=checkbox]").prop("checked", false);
    //     } else {
    //         $(".placeIndex input[type=checkbox]").prop("checked", true);
    //     }
    //     $(this).data("clicks", !clicks);
    //     placeEditAndDeleteMultiCitiesButtonToggle();
    // });
    // $(".placeIndex input[type=checkbox]").change(function () {
    //     placeEditAndDeleteMultiCitiesButtonToggle();
    // });

    // function placeEditAndDeleteMultiCitiesButtonToggle() {
    //     const placeEditMultiCitiesButton = $(".placeEditMultiCitiesButton");
    //     const placeDeleteMultiCitiesButton = $(".placeDeleteMultiCitiesButton");
    //     var cities_ids = [],
    //         checkedCount = 0;
    //     placeEditMultiCitiesButton.addClass("disabled");
    //     placeDeleteMultiCitiesButton.addClass("disabled");

    //     $(".placeIndex input[type=checkbox]:checked").each(function () {
    //         checkedCount += 1;
    //         cities_ids.push($(this).val());
    //     });
    //     if (checkedCount > 0) {
    //         placeEditMultiCitiesButton.removeClass("disabled");
    //         placeDeleteMultiCitiesButton.removeClass("disabled");
    //     }
    //     placeEditMultiCitiesButton.attr("cities_ids", cities_ids);
    //     $("input[name=cities_ids]").val(cities_ids);
    // }

    // $("#getAllCityForPlace").change(function () {
    //     $("#placeIndexForm").submit();
    //     //window.location.assign(`/place?governorate_id=${$(this).val()}`);
    // });

    // $(".placeEditMultiCitiesButton").click(function () {
    //     var cities_ids = $(this).attr("cities_ids");
    //     if (cities_ids != "") {
    //         window.location.assign(
    //             `/place/edit-multi-cities?cities_ids=${cities_ids}&governorate_id=${$(
    //                 "[name=governorate_id]"
    //             ).val()}`
    //         );
    //     }
    // });

    // $("select[name=paginate]").change(function () {
    //     $("#placeIndexForm").submit();
    // });
    ////////////////////////////////////////////////////////////////////////////

    // function newFunction(data) {
    //     $("#modal-default .modal-body").html("");
    //     $("#modal-default .modal-body").html(data);
    //     $("#modal-default").modal("show");
    // }

    /*** get order charge price  */
    // var loadFile = function (event) {
    //     var output = document.getElementById("image-privew");
    //     output.src = URL.createObjectURL(event.target.files[0]);
    //     output.onload = function () {
    //         URL.revokeObjectURL(output.src); // free memory
    //     };
    // };
});
