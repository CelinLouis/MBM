///////////////////////////////////////////////////////////////////////////////////////////
///Script PHP/MYSQL of management of classifieds ads developed by Script PAG
///Script PAG all rights reserved. Use under license. http://www.script-pag.com
///////////////////////////////////////////////////////////////////////////////////////////

//############################################################

////////////////////////////////
//Geolocation google map ad form
////////////////////////////////

var pays = 0;
var region = 0;
var counties = 0;

function region_change(region, counties)
{
	$.ajax(
    {
        type: "POST",
		url: BASEURL+"/includes/display/get_geoloc_ids.php",
		data: { region: region, counties: counties }
    })
    .done(function(data)
    {
	    if(data != 0)
	    {
			var loc_infos_array = data.split("-");

			region = loc_infos_array[0];
			counties = loc_infos_array[1];

			if(region != 0 && region != '')
			{
				$("#an_region").val(region);
				$("#an_region").attr("data-counties-id", counties);
				$("#an_region").trigger("change");

				setTimeout(function()
				{
					$("#form_reg").val(counties);
					$("#form_reg").trigger("change");
				}, 1000);
			}
	    }
    });
}

function initMap()
{
	var get_lat = document.getElementById("lat").value;
	var get_lng = document.getElementById("lng").value;
	var myLatLng = 0;
	var set_zoom = 5;

	if(get_lat != 0 && get_lng != 0)
	{
		get_lat = parseFloat(get_lat);
		get_lng = parseFloat(get_lng);
		document.getElementById('geoloc-info').style.display='block';
		set_zoom = 14;

		var data_geocode = {'location': {lat: get_lat, lng: get_lng}};
	}
	else
	{
		get_lat = parseFloat(BASELAT);
		get_lng = parseFloat(BASELNG);

		if($("#an_city").length > 0 || $("#an_postcode").length > 0) {
			var address = '';
			if($("#an_address").length > 0 && $("#an_address").val().length > 0) {
				address += ' '+$("#an_address").val();
			}
			if($("#an_postcode").length > 0 && $("#an_postcode").val().length > 0) {
				address += $("#an_postcode").val();
			}
			if($("#an_city").length > 0 && $("#an_city").val().length > 0) {
				address += ' '+$("#an_city").val();
			}
			if(address.length > 0) {
				var data_geocode = {'address': String(address)};
			}
		}
	}
	if(typeof data_geocode != 'undefined') {
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode(data_geocode, function(results, status) {
			if (status === 'OK' && typeof results[0] != 'undefined') {
				$('#geolocation').val(String(results[0].formatted_address));
				if($('#an_address').length > 0) {
					$('#an_address').val(String(results[0].address_components[0].long_name+' '+results[0].address_components[1].long_name));
				}
				if($('#an_city').length > 0 && $('#an_city').val().length == 0) {
					$('#an_city').val(String(results[0].address_components[2].long_name))
				}
				if($('#an_postcode').length > 0 && $('#an_postcode').val().length == 0) {
					$('#an_postcode').val(String(results[0].address_components[6].long_name))
				}
				get_lat = results[0].geometry.location.lat();
				get_lng = results[0].geometry.location.lng();
				document.getElementById("lat").value = get_lat;
				document.getElementById("lng").value = get_lng;
				if (results[0].geometry.viewport) {
				  map.fitBounds(results[0].geometry.viewport);
				} else {
				  map.setCenter(results[0].geometry.location);
				  map.setZoom(17);
				}
				marker_aff({lat: get_lat, lng: get_lng});
			} else {
				document.getElementById('geoloc-error4').style.display='block';
			}
		});
	}

	var map = new google.maps.Map(document.getElementById('display-map'), {
		center: {lat: get_lat, lng: get_lng},
		zoom: set_zoom,
		streetViewControl: false
	});

	var input = (
		document.getElementById('geolocation'));

		var types = document.getElementById('type-selector');
		map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.bindTo('bounds', map);

		var marker = new google.maps.Marker({
		position: {lat: get_lat, lng: get_lng},
		map: map,
		draggable:true,
		animation: google.maps.Animation.DROP
	});

	if(get_lat == 46.2 && get_lng == 2.2)
		marker_aff({lat: (get_lat + 0.8), lng: (get_lng + 0.2)});
	else
		marker_aff({lat: get_lat, lng: get_lng});

	google.maps.event.addListener(marker, 'dragend', function()
	{
		clean_data();
		clean_error();

		$("#an_region").prop("disabled", false);
		if($("#an_city").length > 0) $("#an_city").prop("disabled", false);
		if($("#an_postcode").length > 0)  $("#an_postcode").prop("disabled", false);
		if($("#an_address").length > 0) $("#an_address").prop("disabled", false);

		var lat_lng = marker.getPosition();
		document.getElementById("lat").value = lat_lng.lat();
		document.getElementById("lng").value = lat_lng.lng();

		geocodePosition(marker.getPosition(), 1);

		setTimeout(function()
		{
			$("#an_city").trigger("change");
			$("#an_address").trigger("change");
			region_change(region, counties)
		}, 1000);
	});

	autocomplete.addListener('place_changed', function()
	{
		clean_data();

		$("#an_region").prop("disabled", false);
		if($("#an_city").length > 0) $("#an_city").prop("disabled", false);
		if($("#an_postcode").length > 0) $("#an_postcode").prop("disabled", false);
		if($("#an_address").length > 0) $("#an_address").prop("disabled", false);

		marker.setVisible(false);
		var place = autocomplete.getPlace();
		if (!place.geometry) {
		  document.getElementById('geoloc-error1').style.display='block';
		  document.getElementById('geoloc-info').style.display='none';
		  document.getElementById("lat").value = 0;
		  document.getElementById("lng").value = 0;
		  return;
		}
		else
		{
			document.getElementById('geoloc-error1').style.display='none';
			document.getElementById('geoloc-info').style.display='block';
			clean_data();
		}

		if (place.geometry.location.lat()) { // Latitude
			var val = place.geometry.location.lat();
			document.getElementById("lat").value = val;
		}

		if (place.geometry.location.lng()) { // Longitude
			var val = place.geometry.location.lng();
			document.getElementById("lng").value = val;
		}

		// Autocomplete

		var address_components = place.address_components;
		var components={};
		jQuery.each(address_components, function(k,v1) {jQuery.each(v1.types, function(k2, v2){components[v2]=v1.long_name});});

		if (components.postal_code) { // an_postcode
		  var val = components.postal_code;
		  if($("#an_postcode").length > 0) document.getElementById("an_postcode").value = val;
		}

		if (components.locality) { // an_city
		  var val = components.locality;
		  if($("#an_city").length > 0) document.getElementById("an_city").value = val;
		}

		if (components.street_number) { // Adress
		  var val = components.street_number+' '+components.route;
		  if($("#an_address").length > 0) document.getElementById("address").value = val;
		}
		if (components.country) { // Region - County
		  var pays = components.country;
		  if(pays == 'Mayotte' || pays == 'Réunion' || pays == 'Guadeloupe' || pays == 'Guyane française' || pays == 'Martinique') {
			var region = pays.replace(' française', '');
		  } else {
			var region = components.administrative_area_level_1;
		  }
		  var counties = components.administrative_area_level_2;
		  region_change(region, counties);
		}

		if (place.geometry.viewport) {
		  map.fitBounds(place.geometry.viewport);
		} else {
		  map.setCenter(place.geometry.location);
		  map.setZoom(17);
		}

		marker_aff(place.geometry.location);

		$("#an_city").trigger("change");
		$("#an_address").trigger("change");
	});

	$("#geolocalisation-link").click(function()
	{
		clean_data();

		if(navigator.geolocation)
		{
			$("#an_region").prop("disabled", false);
			if($("#an_city").length > 0) $("#an_city").prop("disabled", false);
			if($("#an_postcode").length > 0) $("#an_postcode").prop("disabled", false);
			if($("#an_address").length > 0) $("#an_address").prop("disabled", false);

			$("#geolocation").after('<div id="map_loading"></div>');
			$("#map_loading").css({
				'margin-top':'5px',
				'margin-bottom':'5px',
				'height':'2px',
				'background':'#777777',
	            'width': "1px"
			});

			var geolocation_width = $("#geolocation").width();
			var map_loading_width = $("#map_loading").width();
			var width_val = '+=50';

			function loading_animate()
			{
				geolocation_width = $("#geolocation").width();
				map_loading_width = $("#map_loading").width();

				if(geolocation_width <= map_loading_width)
				{
					width_val = '1px'
				}
				else
				{
					width_val = '+=10';
				}

				$("#map_loading").animate({
	            'width': width_val
		        }, 300);

		        setTimeout(function()
				{
					loading_animate();
				}, 300);
			}
			loading_animate();

			navigator.geolocation.getCurrentPosition(function(position)
			{
				var pos = {
				  lat: position.coords.latitude,
				  lng: position.coords.longitude
				};

				clean_data();
				$("#map_loading").remove();

				document.getElementById("lat").value = position.coords.latitude;
				document.getElementById("lng").value = position.coords.longitude;

				geocodePosition(pos, 2);

				map.setCenter(pos);
				map.setZoom(17);
				marker_aff(pos);

				document.getElementById('geoloc-info').style.display='block';

				}, function() {
					$("#map_loading").remove();
					document.getElementById('geoloc-error3').style.display='block';
				});
			} else {
				$("#map_loading").remove();
				document.getElementById('geoloc-error2').style.display='block';
			}
	});

	function marker_aff(pos)
	{
		marker.setIcon(({
			url: BASEURLIMG +"/template/images/icons/icon_map.png",
			size: new google.maps.Size(100, 100),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(25, 50),
			scaledSize: new google.maps.Size(50, 50)
		}));
		marker.setPosition(pos);
		marker.setVisible(true);
	}

	function geocodePosition(pos, type_geoloc)
	{
		geocoder = new google.maps.Geocoder();
		geocoder.geocode
		({
		    latLng: pos
		},
		    function(results, status)
		    {
		        if (status == google.maps.GeocoderStatus.OK)
		        {
		            $("#geolocation").val(results[0].formatted_an_address);

					var address_components = results[0].address_components;
					var components={};
					jQuery.each(address_components, function(k,v1) {jQuery.each(v1.types, function(k2, v2){components[v2]=v1.long_name});});

					if (components.postal_code) { // an_postcode
					  var val = components.postal_code;
					  if($("#an_postcode").length > 0) document.getElementById("an_postcode").value = val;
					}

					if (components.locality) { // an_city
					  var val = components.locality;
					  if($("#an_city").length > 0) document.getElementById("an_city").value = val;
					}

					if (components.street_number) { // Adress
					  var val = components.street_number+' '+components.route;
					  if($("#an_address").length > 0) document.getElementById("an_address").value = val;
					}

					if (components.country) { // Regions - Counties
						var pays = components.country;
						var region = components.administrative_area_level_1;
						var counties = components.administrative_area_level_2;
						region_change(region, counties);
					}
		        }
		    }
		);
	}

	function clean_data()
	{
		document.getElementById('geoloc-error1').style.display='none';
		document.getElementById('geoloc-error2').style.display='none';
		document.getElementById('geoloc-error3').style.display='none';
		if($("#an_city").length > 0) document.getElementById("an_city").value = '';
		if($("#an_postcode").length > 0) document.getElementById("an_postcode").value = '';
		if($("#an_address").length > 0) document.getElementById("an_address").value = '';
	}

	function clean_error()
	{
		document.getElementById('geoloc-error1').style.display='none';
		document.getElementById('geoloc-error2').style.display='none';
		document.getElementById('geoloc-error3').style.display='none';
		$("#an_city").removeClass("border_err_form");
		$("#an_address").removeClass("border_err_form");
		$("#an_city_span").remove();
		$("#an_address_span").remove();
	}

	$("#geolocation").blur(function()
	{
		var lat = $("#lat").val();

		$("#vil").removeClass("border_err_form");
		$("#add").removeClass("border_err_form");
		$("#vil_span").remove();
		$("#add_span").remove();

		if(lat == 0)
		{
			$('#geoloc-error').css("display", "block");
			$('#geoloc-info').css("display", "none");
		}
	});
}
