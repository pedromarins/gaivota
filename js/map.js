var defaultMap = {
	center: new google.maps.LatLng(-22.9156912, -43.449703),
	zoom: 10,
	mapTypeId: google.maps.MapTypeId.ROADMAP
};

var map = 0;

function drawStation(stationLat, stationLng) {
	var stationPosition = new google.maps.LatLng(stationLat, stationLng);

	var station = new google.maps.Marker({
		position: stationPosition,
		map: map
	});

	station.setTitle(("station" + 1).toString());
	attachContent(station, stationLat, stationLng);
};

function attachContent(station, stationLat, stationLng) {
	stationInfo = "<div class='station-toggle'><h1>" + "Estação de Niterói" + "</h1><dl><dt> Latitude </dt><dd>" + stationLat + "</dd><dt>" + "Longitude" + "</dt><dd>" + stationLng + "</dd></dl></div>";

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
		zoom: 10,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	drawMap(mapOptions);


	$.ajax({
		type: "GET",
		url: "https://209.41.75.203/api.php?volume=mostrecent&callback=responder",
		contentType: "application/json; charset=utf-8",
		async: false,
		dataType: "jsonp",
		success: function (data) {
			for(i = 0; i < data.lines.length; i++) {
				drawStation(data.lines[i].latitude, data.lines[i].longitude);
			};
		},
		error: function () {
			alert("não foi");
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