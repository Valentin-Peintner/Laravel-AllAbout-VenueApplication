require('./bootstrap');

// application code here:

function initMap() {

	const longitude = $('#longitude').val();
	const latitude = $('#latitude').val();

	console.log(longitude, latitude);
	
	// create map object
	var map = new google.maps.Map($('#map')[0], {
		center: {lat: parseFloat(latitude), lng: parseFloat(longitude)},
		zoom: 12
	});

	// create marker object
	var marker = new google.maps.Marker({
		position: {lat: parseFloat(latitude), lng: parseFloat(longitude)},
		map: map,
		title: 'Your Event Location'
	});
}

window.initMap = initMap;

