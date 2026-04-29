@extends('backend.layouts.livewire.admin')

@section('content')
    @livewire('admin-change-plan', [
        'type' => $type,
    ])
@endsection

@push('scripts')
    <script>
        function changePlan() {
            return {
                async selectPlan(planId) {
                    Swal.fire({
                        html: '<span>هل انت متاكد من اختيار هذه الخطة ؟</span>',
                        showCancelButton: true,
                        showConfirmButton: true,
                        focusConfirm: false,
                        allowOutsideClick: false,
                        confirmButtonText: 'نعم افعل ذلك!',
                        cancelButtonText: 'الغاء'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.swalLoading();
                            Livewire.dispatch('selectPlan', { planId: planId });
                        }
                    });
                },
                swalLoading() {

                    var content =
                        '<div>يرجى الانتظار</div><span class="spinner-border text-info"></span>';
                    Swal.fire({
                        html: content,
                        showCancelButton: false,
                        showConfirmButton: false,
                        focusConfirm: false,
                        allowOutsideClick: false,
                    });

                }
            }
        }

        window.addEventListener("selectPlanSwal", (event) => {
            Swal.close();
            if (event && event.detail && event.detail.swal) {
                Swal.fire(event.detail.swal);
            }
        });
    </script>
@endpush
