var defaultMap = {
	center: new google.maps.LatLng(-22.9156912, -43.449703),
	zoom: 10,
	mapTypeId: google.maps.MapTypeId.ROADMAP
};

var map = 0;

function drawStation(stationLat, stationLng, stationType, params) {
	var stationPosition = new google.maps.LatLng(params.latitude, params.longitude);

	var station = new google.maps.Marker({
		position: stationPosition,
		map: map,
		icon: "../img/marker-" + params.type + ".png",
	});

	station.setTitle(params.statioId);
	attachContent(station, params);
};

function attachContent(station, params) {
	// station-toggle
	stationInfo = "";

	var infowindow = new google.maps.InfoWindow({
		content: stationInfo
	});

	google.maps.event.addListener(station, 'click', function() {
		infowindow.open(station.get('map'), station);
	});
};

function drawMap(options) {
	map = new google.maps.Map(document.getElementById("map_canvas"), options);
};

function show_map(loc) {
	var mapOptions = {
		center: new google.maps.LatLng(loc.coords.latitude, loc.coords.longitude),
		zoom: 7,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	drawMap(mapOptions);


	$.ajax({
		type: "GET",
		url: "http://gaivota.org/api.php?volume=mostrecent&callback=responder",
		contentType: "application/json; charset=utf-8",
		async: false,
		dataType: "jsonp",
		success: function (data) {
			for(i = 0; i < data.lines.length; i++) {
				drawStation(data.lines[i].latitude, data.lines[i].longitude, data.lines[i].type, data.lines[i]);
			};
		},
		error: function () {
			alert("Problema na leitura de dados.");
		}
	});
};

function show_map_error() {
	drawMap(defaultMap);
};

window.onload = function() {
	if (geoPosition.init()) {
		geoPosition.getCurrentPosition(show_map, show_map_error);
	};
};