var geocoder = new google.maps.Geocoder();
var fromLong, fromLat, destLong, destLat;
var data;
$('#addTrip').on('submit', function(e) {
    $("#loader").css("display", "block");
    e.preventDefault();
    data = $(this).serializeArray();
    getAddTripDepCoord();
});

function getAddTripDepCoord() {
    geocoder.geocode({
        "address": document.getElementById('from').value
    }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            fromLong = results[0].geometry.location.lng();
            fromLat = results[0].geometry.location.lat();
            data.push({ name: 'departureLongitude', value: fromLong });
            data.push({ name: 'departureLatitude', value: fromLat });
            getAddTripDestCoord();
        } else {
            getAddTripDestCoord();
        }
    });
}

function getAddTripDestCoord() {
    geocoder.geocode({
            "address": document.getElementById("to").value
        },
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                destLong = results[0].geometry.location.lng();
                destLat = results[0].geometry.location.lat();
                data.push({ name: 'destinationLongitude', value: destLong });
                data.push({ name: 'destinationLatitude', value: destLat });
                sendTripData();
            } else {
                sendTripData();
            }

        }
    )
};

function sendTripData() {
    console.log(data);
    $.ajax({
        url: "addTrip.php",
        data: data,
        type: "POST",
        success: function(response) {
            if (response) {
                $("#loader").css("display", "none");
                $('#result').html(response);
                $('#addTrip')[0].reset();
            } else {
                //empty form
                $('#addTrip')[0].reset();
            }
        },
        error: function() {
            $("#result").html("<div class='alert alert-danger'>Erreur réessayer plutard.</div>");

        }
    });
}