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

function humidity(value) {
	switch(true) {
		case value < 311:
			return "solo seco"
			break;
		case value > 310 && value < 651:
			return "solo úmido"
			break;
		case value > 650:
			return "solo encharcado"
			break;
		default:
			return "sem dados"
	};
};

function attachContent(station, params) {
	stationInfo = '<div class="station-toggle"><p><img src="img/marker-' + params.type + '.png"> Estação n° ' + params.stationId + '</p><dl><dt>Latitude:</dt> <dd>' + params.latitude + '°</dd><dt>Longitude:</dt> <dd>' + params.longitude + '°</dd><dt>Última atualização:</dt> <dd>' + params.timeHuman + '</dd><dt>Temperatura ambiente:</dt> <dd>' + params.ambientTemperature + ' °C</dd><dt>Temperatura do solo:</dt> <dd>' + params.soilTemperature + ' °C</dd><dt>Umidade:</dt> <dd>' + params.airHumidity + '%</dd><dt>Umidade do solo:</dt> <dd>' + humidity(params.soilHumidity) + '</dd><dt>Pressão:</dt> <dd>' + params.pressure + ' hPa</dd></dl></div>';

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
		url: "http://gaivota.org/api.php?volume=mostrecent&timeFormat=human&callback=responder",
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