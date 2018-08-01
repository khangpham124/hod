var service = new google.maps.DistanceMatrixService;
var directionsService = new google.maps.DirectionsService;
var directionsDisplay = new google.maps.DirectionsRenderer;

$(function() {
    initMap();
    initAutocomplete();
});

var placeSearch, autocomplete;
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */
        (document.getElementById('autocomplete')), { types: ['geocode'] });
    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    var coordinate = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
    //console.log(place, coordinate);

    // for (var component in componentForm) {
    //     document.getElementById(component).value = '';
    //     document.getElementById(component).disabled = false;
    // }
    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    // for (var i = 0; i < place.address_components.length; i++) {
    //     var addressType = place.address_components[i].types[0];
    //     if (componentForm[addressType]) {
    //         var val = place.address_components[i][componentForm[addressType]];
    //         document.getElementById(addressType).value = val;
    //     }
    // }
    calculateAndDisplayRoute(directionsService, directionsDisplay, coordinate);
    getDistance(coordinate);
}

function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}

function initMap() {

    var map = new google.maps.Map(document.getElementById('ggmap'), {
        zoom: 7,
        center: { lat: 10.779782, lng: 106.703049 }
    });
    directionsDisplay.setMap(map);
    // calculateAndDisplayRoute(directionsService, directionsDisplay);
    var onChangeHandler = function() {
        calculateAndDisplayRoute(directionsService, directionsDisplay);
    };
    document.getElementById('autocomplete').addEventListener('change', onChangeHandler);
}



function calculateAndDisplayRoute(directionsService, directionsDisplay, destination = '') {
    directionsService.route({
        origin: new google.maps.LatLng(10.779782, 106.703049),
        destination: destination || document.getElementById('autocomplete').value,
        travelMode: 'DRIVING'
    }, function(response, status) {
        if (status === 'OK') {
            directionsDisplay.setDirections(response);
        } else {

        }
    });
}

function getDistance(destination = '') {
    service.getDistanceMatrix({
        origins: [new google.maps.LatLng(10.779782, 106.703049)],
        destinations: [destination || document.getElementById('autocomplete').value],
        travelMode: 'DRIVING',
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false
    }, function(response, status) {
        if (status !== 'OK') {

        } else {
            var originList = response.originAddresses;
            var destinationList = response.destinationAddresses;
            $('#add_field').val(response.rows[0].elements[0].distance.text);
            var dis = response.rows[0].elements[0].distance.text;
            var km = parseInt(dis.replace(' km', ''));
            var costship = 25000;
            if (km > 1) {
                var km_large = km - 1;
                costship = 25000 + (km_large * 5000);
            } else {
                var costship = 25000;
            }
            $('#shipcost').val(costship);
            createCookie('shipcost', costship, 24);
            var currentCost = parseInt($('.currentCost').text());
            var shipCost_now = parseInt(readCookie('shipcost'));
            if (shipCost_now) {
                var grandCost = ((currentCost * 10) / 100) + currentCost + shipCost_now;
            } else {
                var grandCost = ((currentCost * 10) / 100) + currentCost;
            }
            $('.grandCost').text(grandCost.toLocaleString());
        }
    });
}

var currentCost = parseInt($('.currentCost').text());
var shipCost_now = parseInt(readCookie('shipcost'));
if (shipCost_now) {
    var grandCost = ((currentCost * 10) / 100) + currentCost + shipCost_now;
} else {
    var grandCost = ((currentCost * 10) / 100) + currentCost;
}
$('.grandCost').text(grandCost.toLocaleString());
$('.button').hide();