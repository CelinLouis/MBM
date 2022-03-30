// Function to preview image after validation
$(function() {
    $("#img").change(function() {
        $("#message").empty();
        file = this.files[0];
        var image = file.type;
        var types = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(image, types) == -1) {
            $("#message").html("<div class='alert alert-danger'>Format non accépté!</div>");
            return false;
        } else {
            var reader = new FileReader();
            reader.onload = imageLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function imageLoaded(event) {
    $('#preview').attr('src', event.target.result);
};

//Update picture
$("#updateprofileimage").submit(function(event) {
    event.preventDefault();
    //hide message
    if (!file) {
        $("#message").html('<div class="alert alert-danger">Veuillez choisir une photo!</div>');
        return false;
    }
    var imageUploded = file.type;
    var typesAccepted = ["image/jpeg", "image/png", "image/jpg"];
    if ($.inArray(imageUploded, typesAccepted) == -1) {
        $("#message").html('<div class="alert alert-danger">Format invalid!</div>');
        return false;
    } else {
        $.ajax({
            url: "updateprofilepic.php",
            type: "POST",
            data: new FormData(this),
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function(data) {
                if (data) {
                    $("#message").html(data);
                } else {
                    location.reload();
                }

            },
            error: function() {
                $("#message").html("<div class='alert alert-danger'>Erreur réessayer.</div>");
            }
        });
    }

});