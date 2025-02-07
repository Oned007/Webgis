<link rel="stylesheet" type="text/css" href="<?=base_url('assets/js/leaflet-search/dist/leaflet-search.min.css')?>">
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<style type="text/css">
    .search-tip b {
        display: inline-block;
        clear: left;
        float: right;
        padding: 0 4px;
        margin-left: 4px;
    }
    /* Penyesuaian posisi control */
    .leaflet-top.leaflet-right {
        margin-top: 10px; /* Memberi ruang untuk panel layer */
    }
    .leaflet-bottom.leaflet-right {
        right: 270px; /* Menyesuaikan posisi routing control */
    }
</style>

<!-- Scripts -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHqhgVQmhdp3XAJ91LHRdXJ3YOjP1V2Gs" async defer></script>
<script src="<?=base_url('assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js')?>"></script>
<script src="<?=base_url('assets/js/leaflet.ajax.js')?>"></script>
<script src="<?=base_url('assets/js/Leaflet.GoogleMutant.js')?>"></script>
<script src="<?=base_url('assets/node_modules/leaflet-easyprint/dist/bundle.js')?>"></script>
<script src="<?=base_url('assets/js/leaflet-search/dist/leaflet-search.src.js')?>"></script>
<script src="<?=site_url('admin/api/data/provinsi')?>"></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

<script type="text/javascript">
    var map = L.map('map').setView([-7.8032504, 110.3748449], 13);
    var layersProvinsi = [];
    var routingControl = null;

    // Base Layer
    var Layer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; OpenStreetMap contributors'
    }).addTo(map);

    // Easy Print
    L.easyPrint({
        title: 'Cetak Peta',
        position: 'topleft',
        exportOnly: true,
        filename: 'WebGIS-Asrama',
        sizeModes: ['Current', 'A4Portrait', 'A4Landscape']
    }).addTo(map);

    // Base Layers
    var baseLayers = [
        {name: "OpenStreetMap", layer: Layer},
        {name: "Satelit Google", layer: L.gridLayer.googleMutant({type: 'satellite'})},
        {name: "Roadmap Google", layer: L.gridLayer.googleMutant({type: 'roadmap'})}
    ];

    // Fungsi Popup dengan Routing
    function popUp(f, l) {
        if (f.properties) {
            let content = `
                <div style="width: 300px; font-family: Arial, sans-serif;">
                    <div style="display: flex; align-items: center; margin-bottom: 10px;">
                        <img src="${f.properties.icon}" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;">
                        <div>
                            <div style="font-weight: bold; font-size: 14px;">${f.properties.name}</div>
                            <div style="font-size: 12px; color: gray;">${f.properties.address}</div>
                        </div>
                    </div>
                    <div style="font-size: 13px; color: #555;">${f.properties.description}</div>
                    <button onclick="trackRoute(${f.geometry.coordinates[1]}, ${f.geometry.coordinates[0]})" 
                        style="margin-top: 10px; padding: 5px 10px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer;">
                        Dapatkan Rute
                    </button>
                    <a href="${f.properties.link}" target="_blank" style="display: block; margin-top: 10px; text-align: right; color: #1a73e8; font-size: 13px;">Detail Lengkap</a>
                </div>
            `;
            l.bindPopup(content, { maxWidth: 400 });
        }
    }

    // Fungsi Tracking Rute
    function trackRoute(lat, lng) {
        if(routingControl) {
            map.removeControl(routingControl);
        }

        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                routingControl = L.Routing.control({
                    waypoints: [
                        L.latLng(position.coords.latitude, position.coords.longitude),
                        L.latLng(lat, lng)
                    ],
                    routeWhileDragging: true,
                    showAlternatives: false,
                    collapsible: true,
                    position: 'bottomright', // Penempatan routing control
                    lineOptions: {styles: [{color: '#007bff', opacity: 0.7, weight: 5}]}
                }).addTo(map);
            }, function(error) {
                alert('Aktifkan izin lokasi untuk menggunakan fitur ini!');
            });
        } else {
            alert('Browser tidak mendukung geolokasi');
        }
    }

    // Layer Provinsi
    for(let i=0; i<dataProvinsi.length; i++) {
        let data = dataProvinsi[i];
        let layer = {
            name: data.nama_provinsi,
            icon: `<img src="${data.icon}" style="width:16px">`,
            layer: new L.GeoJSON.AJAX([`<?=site_url('admin/api/data/asrama/point')?>/${data.id_provinsi}`], {
                pointToLayer: (feature, latlng) => {
                    return L.marker(latlng, {
                        icon: new L.Icon({
                            iconUrl: feature.properties.icon,
                            iconSize: [38, 45]
                        })
                    });
                },
                onEachFeature: (feature, layer) => {
                    if(feature.properties) popUp(feature, layer);
                }
            })
        };
        layersProvinsi.push(layer);
    }

    // Panel Layer Control
    var panelLayers = new L.Control.PanelLayers(baseLayers, [{
        group: "Daftar Provinsi",
        layers: layersProvinsi
    }], {
        collapsibleGroups: true,
        collapsed: false,
        position: 'topright'
    }).addTo(map);

    // Inisialisasi Routing Error Control
    L.Routing.errorControl().addTo(map);
</script>