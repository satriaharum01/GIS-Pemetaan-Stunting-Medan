
<head>
	<base target="_top">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Monitoring Stunting</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
    <link rel="stylesheet" href="{{ asset('/')}}bootstrap/css/bootstrap.min.css"> 
    <script href="{{ asset('/')}}bootstrap/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>

	<style>
		html, body {
			height: 100%;
			margin: 0;
            font-family: 'Source Sans Pro', sans-serif;
            color: #222;
		}
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
		}
		 
#map { width: 800px; height: 500px; }
/* dibagian ini kena info profilenya */
.info { padding: 6px 8px; font: 14px/16px Arial, Helvetica, sans-serif; background: white; background: rgba(255,255,255,0.8); box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 5px; } .info h4 { margin: 0 0 5px; color: #777; }
.legend { text-align: left; line-height: 18px; color: #555; } .legend i { width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7; }

</style>
</head>
<body>
   
<div class="container-fluid padding">
	<div class="row justify-content-center" style="margin-top:10px;">		
        <div id='map' class="col-xs-12 col-md-10 col-lg-8"></div>
	</div>
</div>



<script type="text/javascript" src="{{asset('/json')}}/kota-medan.js"></script>

<script type="text/javascript">

	var map = L.map('map').setView([3.618955, 98.693587], 11);

	var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

	// control that shows state info on hover
	var info = L.control();

	info.onAdd = function (map) {
		this._div = L.DomUtil.create('div', 'info');
		this.update();
		return this._div;
	};

	info.update = function (props) {
		this._div.innerHTML = '<h4>Stunting Kota Medan</h4>' +  
        (props ? '<b>' + props.name + '</b><br />' + props.priority + ' people / mi<sup>2</sup>' : 'Arahkan cursor ke wilayah berwarna');
	};

	info.addTo(map);


	// get color depending on population density value
	function getColor(d) {
		return d > 100 ? '#E31A1C' :
			d > 50  ? '#FC4E2A' :
			d > 1   ? '#FEB24C' : '#FEB24C';
	}

	function style(feature) {
		return {
			weight: 2,
			opacity: 1,
			color: 'white',
			dashArray: '3',
			fillOpacity: 0.7,
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
		onEachFeature: onEachFeature
	}).addTo(map);

	map.attributionControl.addAttribution('Population data &copy; <a href="http://census.gov/">US Census Bureau</a>');


	var legend = L.control({position: 'bottomright'});

	legend.onAdd = function (map) {

		var div = L.DomUtil.create('div', 'info legend');
		var grades = [100, 50, 0];
		var status = ['Prioritas','Perlu diperhatikan', 'Normal'];
		var labels = [];
		var from, to;

		for (var i = 0; i < grades.length; i++) {
			from = grades[i];
			to = grades[i + 1];

			labels.push(
				'<i style="background:' + getColor(from + 1) + '"></i> ' +
				status[i]);
		}

		div.innerHTML = labels.join('<br>');
		return div;
	};

	legend.addTo(map);

</script>



</body>
