@push('liveWire_styles')
    @livewireStyles
@endpush
@extends('backend.layouts.admin')

@section('content')
    <div class="box">
        <div class="box-header py-2">
            <span>اسم العميل</span>
            <span class="text-warning">{{ $user->fullname ?? '' }}</span>
        </div>
        <div class="box-body py-0" x-data="editUser">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach (trans('site.user_account.tabs') as $key => $value)
                    <li
                        class="nav-item fw-bolder @if ($loop->index > 0) hidden-sm-down @endif">
                        <a class="nav-link @if ($key == $tab) active @endif"
                            id="{{ $key }}-tab" data-bs-toggle="tab"
                            href="#{{ $key }}" role="tab"
                            aria-controls="{{ $key }}" aria-expanded="true">
                            <span>
                                <i class="{{ __('site.user_account.tabs_icons.' . $key) }}"></i>
                                {{ $value }}
                            </span>
                        </a>
                    </li>
                @endforeach
                <li class="nav-item dropdown hidden-sm-up">
                    <a class="nav-link dropdown-toggle @if ($tab != 'edit_index') active @endif"
                        data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <span>
                            <i class="fa fa-gears"></i>
                            {{ __('site.user_edit.dropdown_key') }}
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        @foreach (trans('site.user_account.tabs') as $key => $value)
                            @if ($key != 'edit_index')
                                <a class="dropdown-item" id="{{ $key }}-tab"
                                    href="#{{ $key }}" role="tab" data-bs-toggle="tab"
                                    aria-controls="{{ $key }}">
                                    {{ $value }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </li>
            </ul>
            <div class="tab-content p-0">
                @foreach (trans('site.user_account.tabs') as $key => $value)
                    <div role="tabpanel"
                        class="tab-pane fade @if ($key == $tab) show active @endif"
                        id="{{ $key }}" aria-labelledby="home-tab">

                        @include('backend.admins.users.includes.' . $key)

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function editUser() {
            return {
                tabSelected: add_account,
                addDebt() {
                    swalLoading();
                    Livewire.dispatch('save');
                },
                addPrice() {
                    let message = '<span class="text-primary">';
                    message += 'هل انت متاكد من اضافة رصيد الى العميل ؟ ';
                    message += '</span>';
                    swalAlert(message).then((result) => {
                        if (result.isConfirmed) {
                            swalLoading();
                            Livewire.dispatch('addPrice');
                        }
                    });

                },
            }
        }
        window.addEventListener("showSwalMessage", (event) => {
            Swal.fire(event.detail.swal);
        });
    </script>
@endpush
@push('livewire_scripts')
@endpush
