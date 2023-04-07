require('./bootstrap');

// application code here:
function initMap() {

	// Get Location from show.blade hidden input fields
	const longitude = $('#longitude').val();
	const latitude = $('#latitude').val();
	
	// create map object
	var map = new google.maps.Map($('#map')[0], {
		center: {lat: parseFloat(latitude), lng: parseFloat(longitude)},
		zoom: 12
	});

	// create marker object
	var marker = new google.maps.Marker({
		position: {lat: parseFloat(latitude), lng: parseFloat(longitude)},
		map: map,
		title: 'Venue Location'
	});
}

// Reference on global variable
window.initMap = initMap;

