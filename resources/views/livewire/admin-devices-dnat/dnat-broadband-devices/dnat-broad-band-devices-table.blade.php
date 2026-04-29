<div>
<x-datatable :paginated-data="$paginatedData">
    <x-slot name="navBar">
        <div class="col-sm-12 col-md-12">


            <button class="btn btn-primary btn-sm mx-2 px-4 "  data-bs-toggle="modal" wire:loading.attr="disabled" data-bs-target="#bs-explain-modal-lg">
                <i class="fa fa-info-circle px-1 fa-lg" aria-hidden="true"></i>
                شرح فتح البورت
            </button>
            <button wire:click="$refresh" class="mx-2 btn btn-sm btn-outline btn-primary" wire:loading.attr="disabled">
                <i class="fa fa-refresh px-2" wire:loading.remove></i>
                <i class="fa fa-spinner fa-spin px-2" wire:loading></i>
                اعادة تحميل الاجهزة
            </button>

            <x-datatable.table-search />
        </div>
    </x-slot>
    <x-slot name="thead">
        <th wire:click="orderBy('fullname')">
            <span class="badge">
                <span class="ps-6">#</span>
                <span style="padding-right: 20px">
                    {{ __('site.devices_index.fullname') }}
                </span>
            </span>
            @if ($orderByColumn == 'fullname')
            <span>
                <i class="fa {{ $sortIcon }} text-primary"></i>
            </span>
            @endif
        </th>
        @foreach (trans('datatable.admin_broadband_devices_dnat_index') as $column => $value)
        <th class="text-center" wire:click="orderBy('{{ $column }}')">
            <span class="badge">
                {{ $value }}
            </span>
            @if ($column == $orderByColumn)
            <span>
                <i class="fa {{ $sortIcon }} text-primary"></i>
            </span>
            @endif
        </th>
        @endforeach
    </x-slot>

    <x-slot name="tbody">
        @forelse ($paginatedData as $index => $model)
            <tr class="fw-bold">
                <td class="w-auto">
                    @include(
                    'backend.includes.dnat_device.broadband.devices_index_menu'
                    )
                </td>

                <td class="no-padding">
                    <a href="">
                        <span class="badge text-primary bg-dark fs-15 fw-bold">
                            {{ $model->framedipaddress }}
                        </span>
                    </a>
                </td>
                <td class="no-padding">
                    <span class="badge badge-info fs-15 fw-bold">
                        {{ $model->nas_name }}
                    </span>
                </td>
                <td class="no-padding">
                    <span class="badge badge-danger fs-15 fw-bold">
                    {{ $model->city }}
                    </span>
                </td>
            </tr>
        @empty
            <x-datatable.empty-records />
        @endforelse
    </x-slot>
</x-datatable>
    <!-- explain Modal -->
    <div class="modal fade " id="bs-explain-modal-lg"  tabindex="-1" style="z-index:9998" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl " >
            <div class="modal-content " >
                    <div class="modal-header" >
                        <h4 class="modal-title text-white" id="myLargeModalLabel">

                        </h4>
                        <button type="button" data-bs-dismiss="modal"  aria-label="Close"
                            class="btn btn-danger py-1 px-2 " style="height:50%;">
                            <i class="fa fa-times fa-x"></i>
                        </button>
                    </div>
                    <div  class="modal-body text-center p-2  "  >
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    شرح فتح بورت
                                    <span class="px-1 text-primary">
                                        [ HTTP/80 ]
                                    </span>
                                    في اجهزة البرودباند
                                </h4>
                            </div>
                            <div class="box-body">
                                <div id="image-popups" class="row">
                                    <div class="col-sm-3 my-3">
                                        <a href="{{asset('images/broadband/open_port/dd-wrt.jpg')}}" data-effect="mfp-zoom-in"  >
                                            <img src="{{asset('images/broadband/open_port/dd-wrt.jpg')}}" class="img-fluid" alt="" />
                                            <br/>
                                            DD-WRT
                                        </a>
                                    </div>
                                    <div class="col-sm-3 my-3">
                                        <a href="{{asset('images/broadband/open_port/airOS.jpg')}}" data-effect="mfp-zoom-in"  >
                                            <img src="{{asset('images/broadband/open_port/airOS.jpg')}}" class="img-fluid" alt="" />
                                            <br/>
                                            Ubnt - يبكوتى
                                        </a>
                                    </div>
                                    <div class="col-sm-3 my-3">
                                        <a href="{{asset('images/broadband/open_port/advandced_tomato.jpg')}}" data-effect="mfp-zoom-in"  >
                                            <img src="{{asset('images/broadband/open_port/advandced_tomato.jpg')}}" class="img-fluid" alt="" />
                                            <br/>
                                            Advanced Tomato - توميتوا
                                        </a>
                                    </div>
                                    <div class="col-sm-3 my-3">
                                        <a href="{{asset('images/broadband/open_port/edimax.jpg')}}" data-effect="mfp-zoom-in"  >
                                            <img src="{{asset('images/broadband/open_port/edimax.jpg')}}" class="img-fluid" alt="" />
                                            <br/>
                                            EDIMAX - ايدمكس
                                        </a>
                                    </div>
                                    <div class="col-sm-3 my-3">
                                        <a href="{{asset('images/broadband/open_port/lg-6000.jpg')}}" data-effect="mfp-zoom-in"  >
                                            <img src="{{asset('images/broadband/open_port/lg-6000.jpg')}}" class="img-fluid" alt="" />
                                            <br/>
                                            سوفت لينكس
                                        </a>
                                    </div>
                                    <div class="col-sm-3 my-3">
                                        <a href="{{asset('images/broadband/open_port/netis.jpg')}}" data-effect="mfp-zoom-in"  >
                                            <img src="{{asset('images/broadband/open_port/netis.jpg')}}" class="img-fluid" alt="" />
                                            <br/>
                                            NETIS - نتيس
                                        </a>
                                    </div>
                                    <div class="col-sm-3 my-3">
                                        <a href="{{asset('images/broadband/open_port/te-data.jpg')}}" data-effect="mfp-zoom-in"  >
                                            <img src="{{asset('images/broadband/open_port/te-data.jpg')}}" class="img-fluid" alt="" />
                                            <br/>
                                            TE-DATA - تي اي داتا
                                        </a>
                                    </div>
                                    <div class="col-sm-3 my-3">
                                        <a href="{{asset('images/broadband/open_port/tp_link.jpg')}}" data-effect="mfp-zoom-in"  >
                                            <img src="{{asset('images/broadband/open_port/tp_link.jpg')}}" class="img-fluid" alt="" />
                                            <br/>
                                            TP-LINK - تي بي لينك
                                        </a>
                                    </div>
                                    <div class="col-sm-3 my-3">
                                        <a href="{{asset('images/broadband/open_port/tp-link.jpg')}}" data-effect="mfp-zoom-in"  >
                                            <img src="{{asset('images/broadband/open_port/tp-link.jpg')}}" class="img-fluid" alt="" />
                                            <br/>
                                            TP-LINK - تي بي لينك الجديد
                                        </a>
                                    </div>
                                </div>
                            </div>
                          </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-danger text-start" id="closeModalBtn" data-bs-dismiss="modal" >{{ __('new_trans.close') }}</button>
                    </div>
            </div>
        </div>

    </div>
</div>

@push('styles')


	<link rel="stylesheet" href="{{asset('assets/vendor_components/Magnific-Popup-master/dist/magnific-popup.css')}}">

@endpush
@push('scripts')

	<script src="{{ asset('assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#image-popups').magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-with-zoom',
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out',
                    opener: function(openerElement) {
                        return openerElement.is('img') ? openerElement : openerElement.find('img');
                    }
                },
                callbacks: {
                    open: function() {
                        $('.mfp-wrap, .mfp-bg').css('z-index', 9999);
                    }
                }
            });
        });
    </script>

@endpush
