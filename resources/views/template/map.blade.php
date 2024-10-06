<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }} - <?= $title; ?></title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/img/logo-medan.gif') }}" rel="icon">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- SweetAlert 2 -->
    <script src="{{ asset('assets/dist/sweetalert2/sweetalert2.all.min.js') }}">
    </script>
    <link rel="{{ asset('assets/dist/sweetalert2/sweetalert2.min.css') }}">
    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
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

        .new-alert {
            position: relative;
            padding: 0.75rem;
            margin-bottom: 1rem;
            margin-top: 1rem;
            border: 1px solid transparent;
            border-radius: 0.35rem
        }

        .alert-error {
            position: absolute;
            width: 100%;
            top: 0;
            z-index: 100;
        }
    </style>
</head>
<!-- Validator -->
<?php if (isset($validation)) : ?>
    <div class="alert alert-danger alert-error"><?= $validation->listErrors() ?></div>
<?php endif; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">

                    <div style="float-left">
                        Sistem Informasi Geografis Monitoring Daerah Prioritas Penanganan Stunting pada Anak di Kota Medan
                    </div>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">

                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= ucwords($userthis); ?></span>
                                <img class="img-profile rounded-circle" src="{{ asset('assets/img/undraw_profile_1.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <?php if (isset(Auth::user()->id)) { ?>
                                    <a class="dropdown-item" href="{{route('dashboard')}}">
                                        <i class="fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Beranda
                                    </a>
                                    <a class="dropdown-item btn-password" href="#" data-id="<?= Auth::user()->id ?>">
                                        <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Ubah Password
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                <?php } else { ?>
                                    <a class="dropdown-item" href="{{route('login')}}">
                                        <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Login
                                    </a>
                                <?php } ?>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <section id="petapublic" class="service-wrapper pb-3">
                    <div class="card py-3 mt-3 text-center">
                        Peta Kecamatan di Kota Medan
                    </div>
                    <div class="">
                        <div class="map-box">
                            <div class="mapouter">
                                <div class="gmap_canvas" id="map">
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- End of Main Content -->
            <section id="service" class="service-wrapper py-3 bg-white my-3">
                <div class="container">
                    <div class="col-lg-12 text-center">
                        <h3 class="title py-3">Tentang Stunting</h3>
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row flex-column">
                                <div class="px-3">
                                    <div class="services-content mt-40 d-sm-flex">
                                        <div class="services-icon">
                                            <i class="lni-map"></i>
                                        </div>
                                        <div class="services-content media-body">
                                            <h4 class="services-title">Penjelasan Tentang Stunting</h4>
                                            <p class="text-justify">Stunting atau balita pendek merupakan suatu kondisi gagal tumbuh yang terjadi pada anak balita karena kekurangan gizi kronis, terutama pada periode 1.000 Hari Pertama Kehidupan (HPK) (4). Kondisi stunting umumnya disebabkan oleh rendahnya asupan gizi dan status kesehatan dalam waktu yang cukup lama, kurangnya akses sanitasi dan air bersih sehingga timbul infeksi yang terjadi secara berulang, serta pola asuh tidak memadai, terutama pada periode 1000 HPK (Hari pertama kehidupan). </p>
                                        </div>
                                    </div> <!-- services content -->
                                </div>
                                <div class="px-3">
                                    <div class="services-content mt-40 d-sm-flex">
                                        <div class="services-icon">
                                            <i class="lni-laptop-phone"></i>
                                        </div>
                                        <div class="services-content media-body">
                                            <h4 class="services-title">Apa Penyebab Stunting ?</h4>
                                            <p class="text-justify">Stunting disebabkan oleh masalah asupan gizi yang dikonsumsi selama kandungan maupun masa balita. Kurangnya pengetahuan ibu mengenai kesehatan dan terbatasnya layanan kesehatan seperti pelayanan antenatal ( pemeriksaan kehamilan yang bertujuan untuk meningkatkan kesehatan fisik dan mental pada ibu hamil secara optimal, hingga mampu menghadapi masa persalinan, nifas, menghadapi persiapan pemberian ASI secara eksklusif, serta kembalinya kesehatan alat reproduksi dengan wajar). pelayanan postnatal dan rendahnya akses makanan bergizi, rendahnya akses sanitasi dan air bersih juga merupakan penyebab stunting.</p>
                                        </div>
                                    </div> <!-- services content -->
                                </div>
                            </div> <!-- row -->
                        </div> <!-- row -->
                        <div class="col-md-6">
                            <img src="{{asset('assets/img/')}}/Stunting_di_Indonesia_2018.jpg" alt="Stunting" class="img-fluid">
                            <!-- services image -->
                        </div> <!-- row -->
                    </div> <!-- conteiner -->

            </section>

            <section id="pencegahan" class="service-wrapper py-3 bg-white my-3">
                <div class="container">
                    <div class="col-lg-12 text-center">
                        <h3 class="title py-3">Mengatasi Stunting</h3>
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row flex-column">
                                <div class="px-3 pb-3">
                                    <div class="services-content mt-40 d-sm-flex">
                                        <div class="services-icon">
                                            <i class="lni-map"></i>
                                        </div>
                                        <div class="services-content media-body">
                                            <h4 class="services-title">Ciri - Ciri Stunting</h4>
                                            <p class="text-justify">
                                            <table width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td width="10%">1</td>
                                                        <td>Keterlambatan pertumbuhan</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Performa buruk pada tes perhatian dan memori belajar</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Tanda pubertas terlambat</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Anak menjadi pendiam, sulit melakukan eye contact saat usia 8-10 tahun</td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Wajah tampak lebih muda dari usianya</td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Mudah mengalami penyakit infeksi</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- services content -->
                                </div>
                                <div class="px-3 pb-3">
                                    <div class="services-content mt-40 d-sm-flex">
                                        <div class="services-icon">
                                            <i class="lni-map"></i>
                                        </div>
                                        <div class="services-content media-body">
                                            <h4 class="services-title">Langkat Langkah Pencegahan Stunting</h4>
                                            <p class="text-justify">
                                            <table width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td width="10%">1</td>
                                                        <td>Pemberian tablet tambah darah sebanyak minimal 90 buah selama kehamilan</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Pemberian makanan tambahan pada ibu hamil</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Persalinan ibu hamil dengan dokter atau bidan ahli</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Implementasi Inisiasi Menyusui Dini (IMD)</td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Pemberian Asi Ekslusif pada bayi s/d usia 6 bulan</td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Pemberian MP-ASI mulai usia 6 bulan hingga 24 bulan/2 tahun</td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>Pemberian imunisasi dasar lengkap serta tablet vitamin A</td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td>Memantau pertumbuhan dan perkembangan balita melalui kegiatan Posyandu di lingkungan tempat tinggal</td>
                                                    </tr>
                                                    <tr>
                                                        <td>9</td>
                                                        <td>Menerapkan perilaku hidup bersih dan sehat</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div> <!-- services content -->
                                </div>
                                <div class="px-3 py-3">
                                    <div class="services-content mt-40 d-sm-flex">
                                        <div class="services-icon">
                                            <i class="lni-map"></i>
                                        </div>
                                        <div class="services-content media-body">
                                            <h4 class="services-title">Dampak Stunting</h4>
                                            <p class="text-justify">
                                                Apabila tidak dicegah dan ditangani secara tepat, stunting dapat memberikan dampak negatif pada kualitas sumber daya manusia. Dampak jangka pendek, stunting dapat menyebabkan terhambatnya tumbuh kembang anak, pertumbuhan otak terganggu, timbul gangguan kognitif dan motorik anak, gangguan metabolisme, serta ukuran fisik tubuh anak tidak berkembang secara optimal sesuai dengan umurnya
                                            </p>
                                            <p class="text-justify">
                                                Dampak jangka panjang, stunting dapat menyebabkan menurunnya kapasitas intelektual anak yang berdampak pada menurunnya konsentrasi belajar dan kesulitan memahami materi yang disampaikan di sekolah, sehingga dapat berpengaruh pada prestasi belajar dan produktivitasnya ketika dewasa, menurunnya imunitas/kekebalan tubuh, serta munculnya risiko mengalami penyakit degeneratif ketika dewasa . </p>
                                        </div>
                                    </div> <!-- services content -->
                                </div>
                            </div> <!-- row -->
                        </div> <!-- row -->
                        <div class="col-md-6">
                            <img src="{{asset('assets/img/')}}/POSTER-STUNTING-A3.png" alt="Stunting" class="img-fluid">
                            <!-- services image -->
                        </div> <!-- row -->
                    </div> <!-- conteiner -->

            </section>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <!-- Section For Custom Script -->
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js')}}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js')}}"></script>
    <!-- Money Format plugins -->
    <link rel="{{ asset('assets/dist/simple.money.format.js')}}">
    <!-- Section For Custom Script -->

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
                layer.bindPopup('<h3>' + feature.properties.name + '</h3>');
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
                            layer.bindPopup('<h3>' + feature.properties.name + '</h3>');
                        }
                    }).addTo(map);
                }
            });
            console.log(kecKotaMedan.features);

        }
    </script>
</body>

</html>