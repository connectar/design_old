<div>
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css" />
<style>
        /* .pointer {
            cursor: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iY3VydmVudCIgY2xhc3M9ImZhLXNvY2lhbC1mYS1tYXJrZXIiPjxwYXRoIGQ9Ik0xMiAyQzguNjg2IDIgNiA0LjY4NiA2IDggNiA2IDguNjYgNiAxMCAuNzc1IDYuMTQgMTEuNzc1IDE2IDAgMy4zMTQgMi02IDQgNiA0IDYuMzcgNiAyIDAgMi05IDAtMiA2LTEgNy4yODUtNiAxMC4xODYtNiB6Ii8+PC9zdmc+'), auto;
        } */
        .pointer {
            cursor:crosshair;
        }
        .text-pointer {
            cursor: text;
        }

        @media (max-width: 768px) {
            .hiddenInMobile
            {
                display:none !important;
            }
            .btn-sm-on-mobile {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
                line-height: 1.5;
                border-radius: 0.2rem;
            }
        }
        .leaflet-control-layers h6 {
            display: flex; /* Align items */
            align-items: center; /* Center items vertically */
            cursor: pointer; /* Pointer cursor */
            padding: 5px 10px; /* Add padding */
            transition: background 0.3s; /* Smooth transition */
            margin: 0px;
        }

        .leaflet-control-layers h6:hover {
            background: #f0f0f0; /* Background color on hover */
        }

        </style>
@endpush
{{-- <div class="pointer w-100 h-100 bg-dark"></div> --}}
@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="https://connect4ar.com"></script>
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>
@endpush

<div class="box pt-3 bs-3 border-primary">
    <div class="box-header with-border d-flex align-items-center">
        <img src="{{ asset('images/pin/map/map.png') }}" class="px-3 pb-4  " style="width:100px;">
        <h3 class="box-title text-white">
                الخريطة
                <a href="https://www.youtube.com/watch?v=UZGXWIYmiI8" target="__blank" class="btn btn-danger mx-3">
                    <i class="fa fa-youtube fa-lg px-1"></i>
                    الشرح
                </a>
            <p class="p-3 text-light" style="font-size:14px;">
                يمكنك من خلال الخريطة تحديد اماكن الاجهزة علي الخريطة وتحديد المناطق وحساب مساحتها وتحديد اماكن الاجهزة الغير متصلة بشكل دقيق والكتابة علي الخريطة.
            </p>
        </h3>
    </div>
</div>
<div id="MapBox" class="box {{ $isMapFullScreen ? 'box-fullscreen' : '' }}">


    <div   x-data="mapComponent()" style="position: relative;" x-init="initMap()">
        <div wire:ignore id="{{ $mapId }}" :class="{ 'pointer': positioningEnabled, 'text-pointer': textDrawEnabled }" style="height:80vh; z-index: 0;"></div>

        <div style="position: absolute; top: 10px; right: 10px; padding: 10px; z-index: 1; border-radius: 5px; width: 300px;">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-server"></i>
                        <span class="px-2">اختر السيرفر</span>
                    </div>
                    <select class="form-select"  wire:model="selectedNas" wire:loading.attr="disabled" x-model="selectedNas" @change="updateMarkers()">
                        <option value="0">عرض الجميع</option>
                        @foreach($nas_servers as $nas)
                            <option value="{{ $nas->serial }}" {{ $nas->serial == $selectedNas ? 'selected' : '' }}>
                                {{ $nas->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-podcast"></i>
                        <span class="px-2">اختر الجهاز</span>
                    </div>
                    <select class="form-select" wire:model="selectedDevice" wire:loading.attr="disabled" x-model="selectedDevice" @change="updateMarkers()">
                        <option value="0">عرض الجميع</option>
                        @foreach($devicesMarkers as $device)
                            <option value="{{ $device['id'] }}" {{ $device['id'] == $selectedDevice ? 'selected' : '' }}>
                                {{ $device['popupData']['device_name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="button"
                    :class="positioningEnabled ? 'btn btn-danger' : 'btn btn-warning'"
                    class="mt-3 d-block btn-sm-on-mobile"
                    title="تحديد المكان الافتراضي للاجهزة المحددة"
                    wire:loading.attr="disabled"
                    wire:target="updateMarkerPosition"
                    @click="togglePositioning()">
                    <i class="fa fa-map-marker fa-lg px-2" ></i>
                <span class="hiddenInMobile" x-text="positioningEnabled ? 'ايقاف النقل' : 'تفعيل النقل'"></span>
            </button>

            <!-- Button to enable/disable dragging -->
            <button type="button"
                    :class="draggingEnabled ? 'btn btn-danger' : 'btn btn-success'"
                    class="mt-3  d-block btn-sm-on-mobile "
                    title="سحب ووضع الاجهزة في اماكن مختلفة"
                    wire:loading.attr="disabled"
                    wire:target="updateMarkerPosition"
                    @click="toggleDragging()">
                    <i class="fa fa-arrows px-2" ></i>
                <span class="hiddenInMobile" x-text="draggingEnabled ? 'ايقاف السحب' : 'تفعيل السحب'"></span>
            </button>
            <div class="d-flex">
                <button type="button"
                        :class="textDrawEnabled ? 'btn btn-danger' : 'btn btn-info'"
                        class="mt-3 d-block btn-sm-on-mobile "
                        title="الكتابة علي الخريطة"
                        @click="toggleTextDraw()">
                    <i class="fa fa-pencil px-2"></i>
                    <span class="hiddenInMobile" x-text="textDrawEnabled ? 'ايقاف الكتابة' : 'تفعيل الكتابة'"></span>
                </button>
                @if (count($textDrawAreas) > 0)
                    <button type="button"
                            class="btn btn-danger  mt-3 d-block btn-sm-on-mobile mx-2"
                            title="مسح الكتابة التي بداخل الخريطة"
                            wire:loading.attr="disabled"
                            wire:target="clearTextDrawMarkers"
                            @click="clearTextLayer()">
                            <i class="fa fa-eraser px-2"  ></i>
                        {{-- <span class="hiddenInMobile">مسح الكتابة</span> --}}
                    </button>
                @endif
            </div>
            <button type="button"
                    class="btn btn-danger  mt-3 d-block btn-sm-on-mobile"
                    title="مسح المناطق المحددة بداخل الخريطة"
                    wire:loading.attr="disabled"
                    wire:target="clearAllDrawnAreas"
                    @click="clearAllLayers()">
                    <i class="fa fa-eraser px-2"  ></i>
                <span class="hiddenInMobile">مسح المناطق</span>
            </button>

            <button id="fullscreenbtn"
                    type="button"
                    class="btn btn-dark btn-sm  box-btn-fullscreen mt-3 d-block btn-sm-on-mobile"
                    style="font-size: 0px;"
                    title="توسيع الخريطة لتشمل الصفحة كاملة"
                    wire:loading.attr="disabled"
                    wire:target="toggleIsMapFullScreen"
                    @click="setFullScreenMap()"
                    >
                <li class="fa fa-expand px-2" style="font-size: 16px!important;"></li>
            </button>

        </div>
    </div>

</div>
<script>
function mapComponent() {
    return {
        map: null,
        selectedDevice: 0,
        selectedNas: 0,
        changeLayerTime:1,
        markersLayer: null,
        drawControl: null,
        textMarkersLayer: null,
        textDrawEnabled: false,
        textMarkers: [],
        textMarkersObjects: null,
        draggingEnabled: false,
        positioningEnabled: false,
        isMapFullScreen: false,
        connected_icon: '{{ asset("images/pin/6.svg") }}',
        disconnected_icon: '{{ asset("images/pin/5.svg") }}',
        openDeviceRoute: '{{ route("admins.devices.map.open", ["device_id" => "__DEVICE_ID__"]) }}',
        devicesMarkers: @json($devicesMarkers),
        filteredDevicesMarkers: null,
        centerPoint: @json($centerPoint),
        zoomLevel: {{ $zoomLevel }},
        tileHost: '{{ $tileHost }}',
        mapId: "{{ $mapId }}",
        drawnItems: new L.FeatureGroup(),
        updateMarkerPosition: debounce((deviceId, lat, lng) => {
            @this.call('updateMarkerPosition', deviceId, lat, lng);
        }, 100),
        saveDrawnAreas: debounce((geojson) => {
            @this.call('saveDrawnAreas', geojson);
        }, 300),
        initMap() {
            // Base Layers
            let openStreetMapLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            });

            // Esri World Imagery Layer
            let esriWorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: '&copy; <a href="https://www.esri.com/">Esri</a> ',
                maxZoom: 18
            });


            let baseMaps = {
                "<h6 class='text-black'><i class='fa fa-wifi px-2'></i> قمر صناعي</h6>": esriWorldImagery,
                "<h6 class='text-black'> <i class='fa fa-map px-2'></i> مخطط</h6>": openStreetMapLayer
            };

            this.map = L.map('{{ $mapId }}', {
                center: [this.centerPoint.lat ?? this.centerPoint[0], this.centerPoint.long ?? this.centerPoint[1]],
                zoom: this.zoomLevel,
                zoomControl: true,
                scrollWheelZoom: true,
                doubleClickZoom: false,
                boxZoom: false,
                dragging: true,
                layers: [openStreetMapLayer, esriWorldImagery]
            });

            // Add the layer control to the map
            L.control.layers(baseMaps, null, { position: 'topleft' }).addTo(this.map);
            L.control.scale().addTo(this.map);

            // Listen for zoom events // This is fix for bug in drawControl when zoom i need to Reinitialize it again or draw polygon doesn't work.
            this.map.on('zoomend', () => {
                if (this.drawControl) {
                    this.map.removeControl(this.drawControl);
                }
                // Reinitialize the draw control
                this.initDrawControl();
            });

            L.GeometryUtil = L.GeometryUtil || {};
            L.GeometryUtil.readableArea = function(area, locale) {
                locale = locale || 'ar'; // Set locale to Arabic
                var sqMeters = area;
                var sqKilometers = sqMeters / 1000000; // Convert square meters to square kilometers
                return `${sqKilometers.toFixed(2)} كم²`;
            };

            const textDrawAreas = @json($textDrawAreas);
            const areasArray = Object.values(textDrawAreas);

            this.textMarkersObjects = areasArray;

            this.textMarkers = this.textMarkersObjects;

            this.textMarkersLayer = L.layerGroup().addTo(this.map);

            this.drawnItems.clearLayers();

            const drawnAreasData = @json($drawnAreas);
            const drawnAreas = Object.values(drawnAreasData);

            drawnAreas.forEach(area => {
                let layer = L.geoJSON(area, {
                    onEachFeature: (feature, layer) => {
                        if (feature.geometry.type === 'Polygon') {
                            this.updatePolygonDrawopupContent(layer);
                        }
                        if (feature.properties && feature.properties.id) {
                            layer.feature = feature;
                        }
                    }
                });

                this.drawnItems.addLayer(layer);
            });


            // hotfix for bug when change the layer more than 2 times the zoom doesn't work!
            this.map.on('baselayerchange', (event) => {
                this.changeLayerTime++
                if (this.changeLayerTime > 1) {
                    location.reload();
                }
            });

            this.map.addLayer(this.drawnItems);
            this.initDrawControl();
            this.checkDrawEventListeners();
            this.updateMarkers();

        },
        initDrawControl() {
            this.drawControl = new L.Control.Draw({
                edit: {
                    featureGroup: this.drawnItems,
                    remove: false,
                    edit: true
                }
            });
            this.map.addControl(this.drawControl);

            this.map.addLayer(this.drawnItems);
        },
        setFullScreenMap() {
            const mapElement = document.getElementById(this.mapId);
            mapElement.style.height = '80vh';
            if (!this.isMapFullScreen) {
                mapElement.style.height = '100vh';
            }
            this.isMapFullScreen = !this.isMapFullScreen;
            this.map.invalidateSize();
            @this.call('toggleIsMapFullScreen');
        },
        checkDrawEventListeners() {
            this.map.on('draw:created', (event) => {
                // Add layer to drawnItems And serialize drawnItems then save them
                const layer = event.layer;
                this.drawnItems.addLayer(layer);

                this.updatePolygonDrawopupContent(layer);

                const geojson = this.drawnItems.toGeoJSON();

                this.saveDrawnAreas(geojson);

            });

            this.map.on('draw:edited', (event) => {
                // Serialize the updated shapes and save them
                const editedLayers = event.layers;

                editedLayers.eachLayer((layer) => {
                    this.updatePolygonDrawopupContent(layer);
                });

                const geojson = this.drawnItems.toGeoJSON();

                this.saveDrawnAreas(geojson);
            });
        },
        toggleTextDraw() {
            this.textDrawEnabled = !this.textDrawEnabled;
            this.updateMarkers();
        },
        addTextMarker(latlng) {
            this.textDrawEnabled = false;
            const text = prompt("اكتب ملاحظاتك علي الخريطة :");
            if (text) {
                const textMarker = L.marker(latlng, {
                    icon: L.divIcon({
                        className: 'text-marker',
                        html: `
                            <div class=''>
                                <h6 class='badge-info badge-pill p-2 text-center'>${text}</h6>
                            </ي>
                            `,
                        iconSize: [100, 40]
                    }),
                    draggable: this.draggingEnabled
                }).addTo(this.textMarkersLayer);

                    // Generate random id
                    const id = `${Math.random().toString(36).substr(2, 18) + Math.random().toString(36).substr(2, 18)}`;

                    // marker object for js (don't send this to Livewire)
                    var textMarkerObject = {
                        id: id,
                        text: text,
                        marker: textMarker,
                        latlng: latlng
                    };

                    this.textMarkers.push(textMarkerObject);

                    // marker object for livewire here we don't send the marker only the text, id and the latlng
                    const serializableData = {
                        type: 'textDrawJson',
                        id: id,
                        text: text,
                        latlng: latlng
                    };

                    @this.call('saveTextDraw', serializableData);
            }
        },
        toggleDragging() {
            this.draggingEnabled = !this.draggingEnabled;
            this.updateMarkers(); // Reinitialize markers with new dragging state
        },
        togglePositioning() {
            this.positioningEnabled = !this.positioningEnabled;
            this.updateMarkers();
        },
        clearAllLayers() {
            this.drawnItems.clearLayers();
            @this.call('clearAllDrawnAreas');
            this.updateMarkers(); // Reinitialize markers without drawn areas
        },
        clearTextLayer() {
            if (this.textMarkersLayer) {
                this.textMarkersLayer.clearLayers();
            }

            this.textMarkers = [];
            @this.call('clearTextDrawMarkers');
        },
        isWritingClick(latlng) {
            if (this.textDrawEnabled) {
                this.addTextMarker(latlng);
            }
        },
        isPositioningClick(latlng) {
            if (this.positioningEnabled) {
                let i = .001;
                this.filteredDevicesMarkers.forEach((device) =>
                {
                    // Move only one device if selected
                    if (this.selectedDevice != 0 && this.selectedDevice == device.id )
                    {
                        device.lat = latlng.lat;
                        device.long = latlng.lng;
                        @this.call('updateMarkerPosition', device.id, device.lat, device.long);
                    } else if(this.selectedDevice == 0) {
                        // Move all devices on the selected nas if selected or all devices if no filter selected
                        device.lat = latlng.lat;
                        device.long = latlng.lng + i;
                        i += .001;
                    }
                });

                if(this.selectedDevice == 0) {
                    @this.call('updateFilteredDevicesMarkerPosition', this.filteredDevicesMarkers);
                }

                this.positioningEnabled = false;
                this.updateMarkers();
            }
        },
        updatePolygonDrawopupContent(layer) {
            if (layer instanceof L.Polygon) {
                const latLngs = layer.getLatLngs()[0];
                let perimeter = 0;
                const area = L.GeometryUtil.geodesicArea(latLngs); // in square meters

                for (let i = 0; i < latLngs.length - 1; i++) {
                    perimeter += latLngs[i].distanceTo(latLngs[i + 1]);
                }
                // Calculate width and height
                const bounds = L.latLngBounds(latLngs);
                const width = bounds.getEast() - bounds.getWest(); // in degrees
                const height = bounds.getNorth() - bounds.getSouth(); // in degrees

                // Convert degrees to kilometers
                const widthKm = width * 111.32; // Approximation: 1 degree ≈ 111.32 km
                const heightKm = height * 111.32;
                const perimeterKm = perimeter / 1000; // Convert meters to kilometers
                const areaKm2 = area / 1000000; // Convert square meters to square kilometers

                const popupContent = `
                    <div>
                        <div>المساحة: ${areaKm2.toFixed(2)} كم²</div>
                        <div>المحيط: ${perimeterKm.toFixed(2)} كم</div>
                        <div>الطول: ${heightKm.toFixed(2)} كم</div>
                        <div>العرض: ${widthKm.toFixed(2)} كم</div>
                    </div>
                `;

                layer.bindPopup(popupContent).openPopup();
            }
        },
        updateMarkers() {
            if (this.markersLayer) {
                this.markersLayer.clearLayers();
            } else {
                this.markersLayer = L.layerGroup().addTo(this.map);
            }

            let centerLatLng = null;

            if (this.textMarkersLayer) {
                this.textMarkersLayer.clearLayers();
            }

            this.textMarkers.forEach(area => {
                const { id, text, latlng } = area;

                const textMarker = L.marker([latlng.lat, latlng.lng], {
                    icon: L.divIcon({
                        className: 'text-marker',
                        html: `<div class=''><h6 class='badge-info badge-pill p-2 text-center'>${text}</h6></div>`,
                        iconSize: [100, 40]
                    }),
                    draggable: this.draggingEnabled
                }).addTo(this.textMarkersLayer);

                textMarker.on('dragend', (e) => {
                    if (this.draggingEnabled) {

                        //save position after darged on the map
                        const newLatLng = e.target.getLatLng();
                        const markerIndex = this.textMarkers.findIndex(m => m.id === id);
                        if (markerIndex !== -1) {
                            textMarker.latlng = newLatLng;
                            this.textMarkers[markerIndex].latlng = newLatLng;
                        }

                        //save position after darged on the server
                        const updatedSerializableData = {
                            type: 'textDrawJson',
                            id: id,
                            text: text,
                            latlng: newLatLng
                        };

                        @this.call('updateTextDraw', updatedSerializableData);
                    }
                });


            });


            this.map.on('click', (e) => {
                const latlng = e.latlng;
                this.isPositioningClick(latlng);
                this.isWritingClick(latlng);
                this.zoomLevel = 16;
                this.map.zoom = 16;
            });

            this.filteredDevicesMarkers = this.devicesMarkers.filter(device => {
                return this.selectedNas == 0 || device.nas_serial == this.selectedNas;
            });


            this.filteredDevicesMarkers.forEach(device => {

                if (this.selectedDevice == 0 || this.selectedDevice == device.id) {

                    if (this.selectedDevice == device.id || this.selectedNas == device.nas_serial) {
                        centerLatLng = [device.lat ?? device[0], device.long ?? device[1]];
                    }

                    let iconUrl = device.is_connected ? this.connected_icon : this.disconnected_icon;
                    let iconOptions = {
                        iconUrl: iconUrl,
                        iconSize: [120, 120],
                        iconAnchor: [60, 50],
                        popupAnchor: [0, -15],
                        shadowSize: [50, 64],
                        shadowAnchor: [0, 0]
                    };

                    let icon = L.icon(iconOptions);

                    let marker = L.marker([device.lat ?? device[0], device.long ?? device[1]], {
                        icon: icon,
                        draggable: this.draggingEnabled
                    }).addTo(this.markersLayer);

                    marker.on('dragend', (e) => {
                        let newLatLng = e.target.getLatLng();
                        device.lat = newLatLng.lat;
                        device.long = newLatLng.lng;
                        this.updateMarkerPosition(device.id, device.lat, device.long);
                    });

                    if (device.popupData) {
                        marker.bindTooltip(device.popupData.device_name, {
                            permanent: true,
                            direction: 'top',
                            offset: [58, -20]
                        });

                        let popupContent = `
                            <div class="bg-dark p-4 m-0 rounded text-center">
                                <h4 class='text-primary text-bold'>
                                    <strong>${device.popupData.device_name ?? ''}</strong>
                                    <br>
                                    <h6 class='text-${device.is_connected ? 'success' : 'danger'} text-sm'>
                                        (${device.is_connected ? 'متصل' : 'غير متصل'})
                                    </h6>
                                </h4>
                                <h5 class='text-sm text-${device.is_connected ? 'success' : 'danger'}'>${device.popupData.ip_address ?? ''}</h5>
                                <h6 class='text-sm text-light'>${device.popupData.nas_name ?? ''}</h6>
                                <button  @click="openDevice('${device.id}')" class='btn btn-${device.is_connected ? 'success' : 'danger'} mt-3'>
                                    <h6 class='p-0 m-0'>
                                        <i class="fa ${device.is_connected ? 'fa-external-link-square' : 'fa-times-circle'} px-1 " aria-hidden="true"></i>
                                        {{ __('site.devices_index.show_device') }}
                                    </h6>
                                </button>
                            </div>
                        `;

                        marker.bindPopup(popupContent);

                        if (device.id == this.selectedDevice) {
                            selectedMarker = marker;
                        }
                    }
                }
            });

            if (selectedMarker) {
                selectedMarker.openPopup();
            }

            if (centerLatLng) {
                this.map.setView(centerLatLng, this.zoomLevel);
            }
        },
        openDevice(deviceId) {
            var content = '<h4 class="text-lg-center text-primary py-2">جاري الاتصال بالسيرفر وتجهيز الرولات</h4><span class="spinner-border text-success my-2"></span>';
            if (this.isMapFullScreen) {
                var fullscreenbtn = document.getElementById('fullscreenbtn');
                fullscreenbtn.click();
            }
            Swal.fire({
                html: content,
                showCancelButton: false,
                showConfirmButton: false,
                focusConfirm: false,
                allowOutsideClick: false,
                background: "#0c1b32"
            });
            @this.call("openDevice", deviceId)
        }
    }

    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            const context = this;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }
}

window.addEventListener("sweetAlertShow", (event) => {
    Swal.fire(event.detail.alert);
});

</script>
</div>
