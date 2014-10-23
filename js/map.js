var defaultMap = {
	center: new google.maps.LatLng(-22.9156912, -43.449703),
	zoom: 10,
	mapTypeId: google.maps.MapTypeId.ROADMAP
};

function drawStation(stationLat, stationLng, targetMap) {
	var stationPosition = new google.maps.LatLng(stationLat, stationLng);

	new google.maps.Marker({
		position: stationPosition,
		map: targetMap
	});
};

function drawMap(options) {
	var map = new google.maps.Map(document.getElementById("map_canvas"), options);

	drawStation(-22.9156912, -43.449703, map);
	drawStation(-22.929722, -43.087778, map);

};

function show_map(loc) {
	var mapOptions = {
		center: new google.maps.LatLng(loc.coords.latitude, loc.coords.longitude),
		zoom: 11,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	drawMap(mapOptions);
};

function show_map_error() {
	drawMap(defaultMap);
};

if (geoPosition.init()) {
  geoPosition.getCurrentPosition(show_map, show_map_error);
};