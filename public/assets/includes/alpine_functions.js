function online() {

    return {
        removeFromActive(username, serverIp, connection_type) {
            let message = '<span class="text-danger">';
            message += $('.swalMessage').text() + '</span>';
            message += '<span class="text-white"> ';
            message += username + ' ؟' + '</span>';

            swalConfirmBox(message, function () {
                Livewire.dispatch('removeFromActive', {
                    username: username,
                    ipAddress: serverIp,
                    connection_type: connection_type,
                });
            }, true);
        }
    }
}

function usersTabSettings() {

    return {
        doProccess(message) {
            var content = '<span class="text-primary">' + message + '</div>';
            swalConfirmBox(content, function () {
                swalLoading();
                Livewire.dispatch('do');
            }, true);
            window.addEventListener("doPaiedDebtInvoices", (event) => {
                Swal.fire({
                    html: event.detail.content,
                    showCancelButton: true,
                    showConfirmButton: false,
                    focusConfirm: false,
                    allowOutsideClick: false,
                    cancelButtonText: 'اغلاق',
                    customClass: {
                        popup: 'bg-dark',
                    }
                });
            });
        }
    }
}
function cardsTabSettings() {

    return {
        doProccess(message, allowUserToLoginByMac) {
            var content = '<span class="text-primary">' + message + '</div>';
            swalConfirmBox(content, function () {
                swalLoading();
                if (allowUserToLoginByMac === 'one_user_per_card') {
                    Livewire.dispatch('setAllowUserToLoginByMacOneTime');
                } else {
                    Livewire.dispatch('cardsTabDo', allowUserToLoginByMac);
                }
            }, true);
            window.addEventListener("cardsTabEvent", (event) => {
                Swal.fire({
                    html: event.detail.content,
                    showCancelButton: true,
                    showConfirmButton: false,
                    focusConfirm: false,
                    allowOutsideClick: false,
                    cancelButtonText: 'اغلاق',
                    customClass: {
                        popup: 'bg-dark',
                    }
                });
            });
        }
    }
}

function userIndex() {
    return {
        selectall: false,
        selectedModels: [],
        showSetting: false,
        showFilters: true,
        dropDownId: null,
        dropdwonButton: 'خيارات<i class="icon ti-settings"></i>',
        dropDownButtonDefault: 'خيارات<i class="icon ti-settings"></i>',
        dropDownButtonHide: 'اغلاق<i class="icon ti-close"></i>',
        userRenew() {
            swalLoading();
            Livewire.dispatch('doRenewUser');
        },
        changeOffer() {
            swalLoading();
            Livewire.dispatch('doChangeOffer');
        },
        setCardBorder(id) {
            return this.selectedModels.includes(id) ? 'border-primary' : 'border-dark';
        },
        showModalOptions(action, title = '') {
            if (action == 'options') {
                if (this.selectedModels.length == 0) {
                    alert('لم تختار اى مشترك');
                    return;
                }
                this.showSetting = true;
                this.showFilters = false;
            } else {
                this.showSetting = false;
                this.showFilters = true;
            }
            $('#usersIndexModal').modal({
                keyboard: false,
                backdrop: false,
            });
            $('#usersIndexModal').modal('show');
        },
        doAction(action, showSwalBox = false, messageKey = null) {
            $('#usersIndexModal').modal('hide');
            let mKey = messageKey ?? action;
            if (showSwalBox == true) {
                let message = '<span class="text-danger">';
                message += messages[mKey] + '</span>';
                message += '<span class="text-white"> ';
                message += ' ؟' + '</span>';

                let selectedModels = this.selectedModels;

                swalConfirmBox(message, function () {
                    Livewire.dispatch(action, selectedModels);
                }, true);
            } else {
                var ids = this.selectedModels;
                if (!Array.isArray(ids)) {
                    ids = ids != null && ids !== '' ? [ids] : [];
                }
                Livewire.dispatch(action, ids);
            }
            this.selectedModels = [];
        },
        toggleUserStatus(modalId, messageKey) {
            let mKey = messageKey == 0 ? 'disableUser' : 'enableUser';
            let message = '<span class="text-danger">';
            message += messages[mKey] + '</span>';
            message += '<span class="text-white"> ';
            message += ' ؟' + '</span>';

            swalConfirmBox(message, function () {
                Livewire.dispatch('toggleUserStatus', modalId);
            }, true);
        },
        deleteUser(modalId) {
            let message = '<span class="text-danger">';
            message += messages['deleteUser'] + '</span>';
            message += '<span class="text-white"> ';
            message += ' ؟' + '</span>';

            swalConfirmBox(message, function () {
                Livewire.dispatch('deleteUser', modalId);
            }, true);
        },
        closeModal() {
            $('.modal').modal('hide');
        },
        setDropdownId(modelId) {
            this.dropDownId = this.dropDownId == null ? modelId : null;
        }
    }
}

function copyNasIp(ip) {
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = ip;
    document.body.appendChild(tempInput);
    tempInput.select();
    try {
        var successful = document.execCommand("copy", false, null);
        if (successful) {
            Swal.fire({
                html: '<div class="text-success">تم النسخ بنجاح</div>',
                showCancelButton: true,
                showConfirmButton: false,
                focusConfirm: false,
                allowOutsideClick: false,
                cancelButtonText: 'اغلاق',
                customClass: {
                    popup: 'bg-dark',
                }
            });
        }
    } catch (err) {
        Swal.fire({
            html: '<div class="text-danger">فشل نسخ الايبى</div>',
            showCancelButton: true,
            showConfirmButton: false,
            focusConfirm: false,
            allowOutsideClick: false,
            cancelButtonText: 'اغلاق',
            customClass: {
                popup: 'bg-dark',
            }
        });
    }
}

window.addEventListener("selectPlanSwal", (event) => {
    Swal.close();
    if (event && event.detail && event.detail.swal) {
        Swal.fire(event.detail.swal);
    }
});
