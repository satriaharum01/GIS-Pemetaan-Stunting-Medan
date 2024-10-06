@extends('template.header')

@section('content')
<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js"></script>
<style>
    .legend {
        text-align: left;
        padding: 6px 8px;
        font: 14px Arial, Helvetica, sans-serif;
        background: white;
        background: rgba(255, 255, 255, 1);
        /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
        /*border-radius: 5px;*/
        line-height: 24px;
        color: #555;
    }

    .legend h4 {
        text-align: center;
        font-size: 16px;
        margin: 2px 12px 8px;
        color: black;
    }

    .legend span {
        position: relative;
        bottom: 3px;
        color: black;
    }

    .legend i {
        border: 1px solid black;
        width: 18px;
        height: 18px;
        float: left;
        margin: 0 8px 0 0;
        opacity: 1;
    }

    .legend i.icon {
        background-size: 18px;
        background-color: rgba(255, 255, 255, 1);
    }

    .mapouter {
        position: relative;
        text-align: right;
        height: 100%;
        width: 100%;
    }

    .map-box {
        margin: auto;
        height: 600px;
        width: 100%;
    }

    .gmap_canvas {
        overflow: hidden;
        background: none !important;
        height: 100%;
        width: 100%;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>
 -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="" style="float: right;"> Pilih Tahun :
                <select name="tahun" id="tahun" style="padding:5px;border-radius:10%;" onchange="reload_map()">
                    <option value="0">Global</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                </select>
            </div>
            <h6 class="m-0 font-weight-bold text-primary" style="padding: 12px 6px;">Data {{$title}}</h6>
        </div>
        <div class="card-body">
            <div class="map-box">
                <div class="mapouter">
                    <div class="gmap_canvas" id="map">
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- /.container-fluid -->
@endsection
@section('custom_script')
<script>
    var myTextOptions = new Object(Object());
    myTextOptions['Medan Amplas'] = new Object();
    myTextOptions['Medan Amplas']['comic'] = 'Calvin & Hobbes';
    /*myTextOptions = {
        'Medan Amplas': {
            comic: 'Calvin & Hobbes',
            published: '1993'
        },
        'Medan Tuntungan': {
            kid: 'Calvin',
            tiger: 'Hobbes'
        }
    }
    */

    var datakecamatan = <?= $datakecamatan ?>;
    $(function() {
        var datasultan = new Object();
        $.ajax({
            url: "{{ url('/data/kecamatan/json')}}",
            type: "GET",
            cache: true,
            dataType: 'json',
            success: function(dataResult) {
                //console.log(dataResult);
                var resultData = dataResult.data;
                $.each(resultData, function(index, row) {

                    datasultan = Object.assign({
                        name
                    }, row.nama);
                    //alert(row.path);
                })
            }
        });

        //console.log(myTextOptions);
        console.log(datakecamatan);
        //alert(datakecamatan["Medan Amplas"]);
        //var datasultan = datakecamatan;
        //console.log(datasultan);
    })
</script>

<script type="text/javascript" src="{{asset('/assets/json/kota-medan.js')}}"></script>
<script>
    $(function() {

    });
</script>
<script>
    function loadmap() {
        window.LRM = {
            tileLayerUrl: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
            osmServiceUrl: 'https://routing.openstreetmap.de/routed-car/route/v1',
            orsServiceUrl: 'https://api.openrouteservice.org/geocode/',
            apiToken: '5b3ce3597851110001cf6248ff41dc332def43858dff1ecccdd19bbc'
        };
        var map = L.map('map').setView([3.586506, 98.735657], 11);
        L.tileLayer(LRM.tileLayerUrl, {
            attribution: 'Maps and routes from <a href="https://www.openstreetmap.org">OpenStreetMap</a>. ' +
                'data uses <a href="http://opendatacommons.org/licenses/odbl/">ODbL</a> license'
        }).addTo(map);
    }
</script>

<script type="text/javascript">
    var map = L.map('map').setView([3.618955, 98.693587], 11);

    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // control that shows state info on hover
    var info = L.control();

    info.onAdd = function(map) {
        this._div = L.DomUtil.create('div', 'info');
        this.update();
        return this._div;
    };

    info.update = function(props) {
        this._div.innerHTML = '<h4>Stunting Kota Medan</h4>' +
            (props ? '<b>' + props.name + '</b><br />' + props.priority + ' people / mi<sup>2</sup>' : 'Arahkan cursor ke wilayah berwarna');
    };

    //info.addTo(map);


    // get color depending on population density value
    function getColor(d) {
        return d > 40 ? '#DD4A48' :
            d > 30 ? '#FF7B54' :
            d > 20 ? '#FFB26B' :
            d > 10 ? '#FFD56F' : '#FCF9BE';
    }

    function style(feature) {
        return {
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.9,
            fillColor: getColor(feature.properties.priority)
        };
    }

    function highlightFeature(e) {
        var layer = e.target;

        layer.setStyle({
            weight: 5,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.7
        });

        if (!L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }

        info.update(layer.feature.properties);
    }

    var geojson;

    function resetHighlight(e) {
        geojson.resetStyle(e.target);
        info.update();
    }

    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }

    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });
    }

    /* global statesData */
    geojson = L.geoJson(kecKotaMedan, {
        style: style,
        onEachFeature: function(feature, layer) {
            layer.bindPopup('<h3>' + feature.properties.name + '</h3><br>Balita : ' + +feature.properties.jumlah + '<br>Stunting: ' + feature.properties.sangat + '</h3><br>Pendek: ' + feature.properties.pendek + '</h3><br>Normal: ' + feature.properties.normal);
        }
    }).addTo(map);
    console.log(kecKotaMedan);
    /*Legend specific*/
    var legend = L.control({
        position: "bottomleft"
    });

    legend.onAdd = function(map) {
        var div = L.DomUtil.create("div", "legend");
        div.innerHTML += "<h4>Keterangan</h4>";
        div.innerHTML += '<i style="background: #DD4A48"></i><span>Sangat Prioritas</span><br>';
        div.innerHTML += '<i style="background: #FF7B54"></i><span>Prioritas</span><br>';
        div.innerHTML += '<i style="background: #FFB26B"></i><span>Tidak Prioritas</span><br>';
        div.innerHTML += '<i style="background: #FCF9BE"></i><span>Sangat Tidak Prioritas</span><br>';
        return div;
    };

    legend.addTo(map);
    //map.attributionControl.addAttribution('Population data &copy; <a href="http://census.gov/">US Census Bureau</a>');
</script>
<script>
    function reload_map() {
        var id = $("#tahun option:selected").val();
        map.removeLayer(geojson);
        $.ajax({
            url: "{{ url('/laporan/map/json')}}/" + id,
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult) {
                //console.log(dataResult);
                var resultData = dataResult;
                var calcData = kecKotaMedan.features;
                $.each(resultData, function(lowindex, rowew) {
                    $.each(calcData, function(index, row) {
                        //console.log(row);
                        if (row.properties.name === lowindex) {
                            row.properties.jumlah = rowew.jumlah;
                            row.properties.priority = rowew.val;
                            row.properties.sangat = rowew.sangat;
                            row.properties.pendek = rowew.pendek;
                            row.properties.normal = rowew.normal;
                        }

                    })
                })

                geojson = L.geoJson(kecKotaMedan, {
                    style: style,
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup('<h3>' + feature.properties.name + '</h3><br>Balita : ' + +feature.properties.jumlah + '<br>Stunting: ' + feature.properties.sangat + '</h3>Pendek: ' + feature.properties.pendek + '</h3><br>Normal: ' + feature.properties.normal);
                    }
                }).addTo(map);
            }
        });
        console.log(kecKotaMedan.features);

    }
</script>
@endsection