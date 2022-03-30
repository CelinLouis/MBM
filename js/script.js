//set the map on div map
var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 8,
    center: { lat: 34.0132500, lng: -6.8325500 },
    mapTypeId: google.maps.MapTypeId.ROADMAP
});
//add autocomplete to inputs
var from = document.getElementById("from");
var to = document.getElementById("to");
var options = {
    types: ['(cities)']
}
var autocomplete1 = new google.maps.places.Autocomplete(from, options);
var autocomplete2 = new google.maps.places.Autocomplete(to, options);
//calculate the distance
// Instantiate a directions service.
var directionsService = new google.maps.DirectionsService;
// Create a renderer for directions and bind it to the map.
var directionsDisplay = new google.maps.DirectionsRenderer();
directionsDisplay.setMap(map);
google.maps.event.addListener(autocomplete1, "place_changed", calcDistance);
google.maps.event.addListener(autocomplete2, "place_changed", calcDistance);

function calcDistance() {
    //draw the direction
    var poly = new google.maps.Polyline({ strokeColor: "#2518DD", strokeWeight: 4 });
    //set from and to values and travel mode
    var request = {
        origin: document.getElementById("from").value,
        destination: document.getElementById("to").value,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    //send request
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            //delete all routes
            directionsDisplay.setDirections({ routes: [] });
            map.setCenter(map.center);
        }
    });

}