var geocoder = new google.maps.Geocoder();
var fromLong, fromLat, destLong, destLat;
var data;

$('#editTrip').on('submit', function(e) {
    $("#loader").css("display", "block");
    e.preventDefault();
    data = $(this).serializeArray();
    getEditTripDepCoord();
});

function getEditTripDepCoord() {
    geocoder.geocode({
        "address": document.getElementById('from').value
    }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            fromLong = results[0].geometry.location.lng();
            fromLat = results[0].geometry.location.lat();
            data.push({ name: 'departureLongitude', value: fromLong });
            data.push({ name: 'departureLatitude', value: fromLat });
            getEditTripDestCoord();
        } else {
            getEditTripDestCoord();
        }
    });
}

function getEditTripDestCoord() {
    geocoder.geocode({
            "address": document.getElementById("to").value
        },
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                destLong = results[0].geometry.location.lng();
                destLat = results[0].geometry.location.lat();
                data.push({ name: 'destinationLongitude', value: destLong });
                data.push({ name: 'destinationLatitude', value: destLat });
                sendUpdatedTripData();
            } else {
                sendUpdatedTripData();
            }

        }
    )
};

function sendUpdatedTripData() {
    console.log(data);
    $.ajax({
        url: "updateTrip.php",
        data: data,
        type: "POST",
        success: function(response) {
            if (response) {
                $("#loader").css("display", "none");
                $('#result').html(response);
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

function deleteTrip($id) {
    $("#loader").css("display", "block");
    $.ajax({
        url: "deleteTrip.php",
        method: "POST",
        data: { trip_id: $id },
        success: function(data) {
            $("#loader").css("display", "none");
            $("#result").html(data);
            location.reload();
        },
        error: function() {
            $("#result").html("<div class='alert alert-danger'>Erreur réessayer plutard.</div>");
        }

    });
}