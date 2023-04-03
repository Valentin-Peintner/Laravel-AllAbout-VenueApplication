require('./bootstrap');

// application code here:

// $(document).ready(function() {
// 	console.log('JS up and running...');
// });


// richtig??
function initMap() {
    // Adresse aus der Laravel-Variable auslesen
    var fullAddress = "{{ $fullAddress }}";

    // Geocoder-Objekt erstellen, um LatLng aus Adresse zu ermitteln
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': fullAddress }, function(results, status) {
        if (status === 'OK') {
            // LatLng des Orts aus Ergebnissen des Geocoders auslesen
            var location = results[0].geometry.location;

            // Karte mit LatLng des Orts zentrieren
            var map = new google.maps.Map(document.getElementById('map'), {
                center: location,
                zoom: 10
            });

            // Marker an Ort setzen
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        } else {
            // Fehlermeldung ausgeben, falls Geocoding nicht erfolgreich war
            console.log('Geocode was not successful for the following reason: ' + status);
        }
    });
}

