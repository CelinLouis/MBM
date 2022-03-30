///////////////////////////////////////////////////////////////////////////////////////////
///Script PHP/MYSQL of management of classifieds ads developed by Script PAG
///Script PAG all rights reserved. Use under license. http://www.script-pag.com
///////////////////////////////////////////////////////////////////////////////////////////

//############################################################

var watchId = null;
var windowWidth = $(window).width();
var windowHeight = $(window).height();

window.addEventListener('load', function() {
	//Manage email customer search alert
	if(document.querySelector('.search-alert-mail-active')) {
		var active_alert_buttons = document.querySelectorAll('.search-alert-mail-active');
		for(var active_button of active_alert_buttons) {
			active_button.querySelector('[type="checkbox"]').addEventListener('click', function(e) {
				var checkbox_target = this;
				var checked = this.checked;
				if(checked == true) {
					var checkbox_value = 1;
				} else {
					var checkbox_value = 0;
				}
				var data_active_search = 'id='+checkbox_target.parentNode.dataset.id+'&value='+checkbox_value;
				var xhr_active_search = new XMLHttpRequest();
				xhr_active_search.open('POST', BASEURL+'/includes/display/search_send_mail.php', true);
				xhr_active_search.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr_active_search.onload  = function(e) {
					if(this.status == 200 && this.response == 1) {
						if(checkbox_value == 1) { 
							checkbox_target.parentNode.classList.add('active');
						} else {
							checkbox_target.parentNode.classList.remove('active');
						}
					}
				};
				xhr_active_search.send(data_active_search);
			});
		}
	}
	
	//Save customer search
	if(document.querySelector('.save-shearch')) {
		var save_search_buttons = document.querySelectorAll('.save-shearch.to-saved');
		for(var save_button of save_search_buttons) {
			save_button.addEventListener('click', search_save);
		}
	}
	
	//Delete customer search
	if(document.querySelector('.delete-acc-search')) {
		var delete_search_buttons = document.querySelectorAll('.delete-acc-search');
		for(var delete_button of delete_search_buttons) {
			delete_button.addEventListener('click', search_delete);
		}
	}
	
	//Manage search form
	if(document.querySelector('form.search-form:not(.no-rewrite)')) {
		if(document.getElementById('search-type')) {
			var radios = document.getElementById('search-type').querySelectorAll('input[type="radio"]');
			if(radios.length > 0) {
				for(var radio of radios) {
					radio.addEventListener('click', function() {
						if(this.value == 5) {
							document.getElementById('search-ads').style.display = 'none';
							document.querySelector('.search-form').querySelector('[name="keywords"]').placeholder = document.querySelector('.search-form').querySelector('[name="keywords"]').dataset.texttype2;
							disabled_input_search_type();
						} else {
							document.getElementById('search-ads').style.display = 'block';
							document.querySelector('.search-form').querySelector('[name="keywords"]').placeholder = document.querySelector('.search-form').querySelector('[name="keywords"]').dataset.texttype1;
							disabled_input_search_type(true);
						}
						load_search_cat(this.value);
					});
				}
			}
		} else if(document.getElementById('search-ads')) {
			disabled_input_search_type();
		}
		if(document.getElementById('more-search')) {
			if(document.getElementById('search_radio5')) {
				if(document.getElementById('search_radio5').checked) {
					disabled_input_search_type();
				}
			}
			if(document.getElementById('option') && document.getElementById('option').childNodes.length > 0 && windowWidth < 931) {
				manage_more_button();
			}	
			window.addEventListener('resize', function() {
				manage_more_button();
			});
		}
		document.querySelector('form.search-form').addEventListener('submit', function(e) {
			e.preventDefault();
			var rewrite_search_action = true;
			var new_action = BASEURL;
			var form_fields = document.querySelector('form.search-form').querySelectorAll('input, select');
			if(form_fields.length > 0) {
				for(var field of form_fields) {
					if(field.name != 'reg' && field.name != 'county' && field.name != 'cat' && field.name != 'type' && field.name != 'sort' && field.name != 'status' && field.name.length > 0) {
						if(field.type == 'checkbox' && field.checked == true && field.disabled == false) {
							rewrite_search_action = false;
							break;
						} else if(field.type != 'checkbox' && field.value.length > 0 && field.value != 0) {
							rewrite_search_action = false;
							break;
						}
					} else if(field.name == 'type' && field.checked == true) {
						new_action += '/'+field.parentNode.dataset.slug;
					}
				}
			}
			if(rewrite_search_action == true) {
				if(document.getElementById('county').value.length > 0 && document.getElementById('county').value != 0) {
					new_action += '/'+(document.getElementById('county').querySelector('option[value="'+document.getElementById('county').value+'"]').innerHTML).cleanUrl();
				}
				if(document.querySelector('form.search-form').querySelector('select[name="county"]') && document.querySelector('form.search-form').querySelector('select[name="county"]').value.length > 0 && document.querySelector('form.search-form').querySelector('select[name="county"]').value != 0) {
					new_action += '/'+(document.querySelector('form.search-form').querySelector('select[name="county"]').querySelector('option[value="'+document.querySelector('form.search-form').querySelector('select[name="county"]').value+'"]').innerHTML).cleanUrl();
				}
				if(document.getElementById('opt') && document.getElementById('opt').value.length > 0 && document.getElementById('opt').value != 0) {
					if(document.getElementById('opt').value > 0) {
						new_action += '/'+(document.getElementById('opt').querySelector('option[value="'+document.getElementById('opt').value+'"]').innerHTML.trim()).cleanUrl();	
					} else {
						new_action += '/'+(document.getElementById('opt').querySelector('option[value="'+document.getElementById('opt').value+'"]').value.trim()).cleanUrl();
					}
				}
				if(document.getElementById('options') && document.getElementById('options').value.length > 0 && document.getElementById('options').value != 0) {
					new_action += '/'+(document.getElementById('options').querySelector('option[value="'+document.getElementById('options').value+'"]').dataset.slug.trim()).cleanUrl();
				}
// 				document.querySelector('form.search-form').method = 'POST';
				document.querySelector('form.search-form').action = new_action;
			} else {
// 				document.querySelector('form.search-form').method = 'GET';
				document.querySelector('form.search-form').action = BASEURL+'/search.php';
			}
				document.querySelector('form.search-form').submit();
		});
	}
	
	function disabled_input_search_type(remove_attr) {
		var fields = document.getElementById('search-ads').querySelectorAll('input');
		if(fields.length > 0) {
			for(field of fields) {
				if(typeof remove_attr != 'undefined' && remove_attr == true) {
					field.removeAttribute('disabled');
				} else {
					field.setAttribute('disabled', 'disabled');
				}
			}
		}
	}
	
	function load_search_cat(type) {
		var data = 'search_cat='+type;
		xhr_object = new XMLHttpRequest();
		xhr_object.open("POST", BASEURL +"/includes/display/search_cat.php", true);
		xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr_object.onreadystatechange = function() {
			if (xhr_object.readyState == 4) 
			{
				document.getElementById('cat-search').innerHTML = xhr_object.responseText;
				if(document.getElementById('opt')) {
					document.getElementById('opt').addEventListener('change', function() {
						manage_more_button();
					}, true);
				}
			}
		}
		xhr_object.send(data);

	}
	
	//Manage thumb on ad page
	if(document.querySelector('.ad-page-bloc-thumbnail')) {
		var ad_slideshow = new slideShow();
	}
	
	//Mannage menu
	var menu = new mobileMenu();
	
	//Menu language height
	if(document.querySelector('.header-flags > div > ul')) {
		var languages = document.querySelector('.header-flags > div > ul').querySelectorAll('li');
		if(languages.length > 0) {
			var language_menu_height = 0;
			var language_menu_min_height = 0;
			var i = 0;
			for(lang of languages) {
				if(i == 0) {
					language_menu_min_height += parseInt(lang.clientHeight);
				}
				language_menu_height += parseInt(lang.clientHeight);
				i++;
			}
			if(language_menu_height > 0) {
				document.querySelector('.header-flags > div').addEventListener('mouseover', function() {
					document.querySelector('.header-flags > div > ul').style.height = language_menu_height+'px';
				});
				document.querySelector('.header-flags > div').addEventListener('mouseout', function() {
					document.querySelector('.header-flags > div > ul').style.height = language_menu_min_height+'px';
				});
			}
		}
	}
});
	
function manage_more_button() {
	if(window.innerWidth < 931) {
		if(document.getElementById('option') && document.getElementById('option').childNodes.length > 0) {
			if(document.getElementById('more-search') && document.getElementById('more-search').classList.contains('more-step')) {
				show_more_search_button();
			}
		} else {
			hide_more_search_button();
		}
	} else {
		hide_more_search_button();
	}
}

function show_more_search_button() {
	document.getElementById('more-search').style.display = 'inline-block';
	document.getElementById('get_options').style.display = 'none';
	document.getElementById('more-search').addEventListener('click', more_button_listener);
}

function hide_more_search_button() {
	document.getElementById('more-search').style.display = 'none';
	document.getElementById('get_options').style.display = 'block';
	document.getElementById('more-search').classList.remove('less-step');
	document.getElementById('more-search').classList.add('more-step');
	document.getElementById('more-search').innerHTML = document.getElementById('more-search').dataset.more;
	document.getElementById('more-search').removeEventListener('click', more_button_listener);
}

function more_button_listener(e) {
	e.preventDefault();
	var element = this;
	if(element.classList.contains('more-step')) {
		document.getElementById('get_options').style.display = 'block';
		element.classList.remove('more-step');
		element.classList.add('less-step');
		document.getElementById('more-search').innerHTML = element.dataset.less;
	} else if(element.classList.contains('less-step')) {
		document.getElementById('get_options').style.display = 'none';
		element.classList.remove('less-step');
		element.classList.add('more-step');
		document.getElementById('more-search').innerHTML = element.dataset.more;
	}
	if(document.getElementById('start_date')) {
		$( "#start_date" ).datepicker({
			numberOfMonths: 1,
			minDate: 'today',
			onSelect: function(dateText) {
				$("#end_date").datepicker('option', 'minDate', dateText);		
			},
			onClose: function() {
				setTimeout(function() {$("#end_date").datepicker("show");}, 100);		
			}
		}); 
	 
		$( "#end_date" ).datepicker({
			numberOfMonths: 1,
			minDate: 'today'
		});	
	}
}

function search_save(event) {
	event.preventDefault();
	var link = event.target;
	var data_save_search = 'search='+encodeURIComponent(link.dataset.query);
	var xhr_save_search = new XMLHttpRequest();
	xhr_save_search.open('POST', BASEURL+'/includes/display/search_save.php', true);
	xhr_save_search.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr_save_search.onload  = function(e) {
		if(this.status == 200 && this.response == true) {
			link.removeEventListener('click', search_save);
			link.innerHTML = link.dataset.textsaved;
		}
	};
	xhr_save_search.send(data_save_search);
};
	
function search_delete(event) {
	event.preventDefault();
	var link = event.target;
	var data_delete_search = 'id='+link.dataset.id;
	var xhr_delete_search = new XMLHttpRequest();
	xhr_delete_search.open('POST', BASEURL+'/includes/display/search_delete.php', true);
	xhr_delete_search.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr_delete_search.onload  = function(e) {
		if(this.status == 200 && this.response == true) {
			var total = parseInt(document.querySelector('.listing-infos').querySelector('.span-total').innerHTML) - 1;
			if(total > 0) {
				document.querySelector('.listing-infos').querySelector('.span-total').innerHTML = total;
				document.querySelector('.listing-infos').querySelector('.span-end-ads').innerHTML = parseInt(document.querySelector('.listing-infos').querySelector('.span-end-ads').innerHTML) - 1;
				link.parentNode.remove();
			} else {
				var xhr_load_search = new XMLHttpRequest();
				xhr_load_search.open('POST', BASEURL+'/acc_search.php', true);
				xhr_load_search.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr_load_search.onload  = function(e) {
					if(this.status == 200) {
						link.closest('.background-search-listing-container').remove();
						document.querySelector('.search-results-container').innerHTML = this.response;
					}
				};
				xhr_load_search.send('is_ajax=true');
			}
		}
	};
	xhr_delete_search.send(data_delete_search);
}

$(function()
{	
	////////////////////////////////
	//Geolocation search
	////////////////////////////////
	
	$("#county").change(function(event)
	{
		var county_val = $(this).val();
		if(county_val == 'geoloc_search')
		{
			event.preventDefault();
			var watchOptions = {
				frequency: 15 * 60 * 1000,
				timeout : 1 * 60 * 1000,
				enableHighAccuracy: false,
				desiredAccuracy:20,
				maxWait:15000,
				maximumAge:600000
			};
							
			if(window.navigator.geolocation)
			{				
				watchId = window.navigator.geolocation.watchPosition(successCallback, errorCallback, watchOptions);
			}		    
			else
				alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
		}
	});
	
	if(visit_latitude == 0 && visit_longitude == 0 && navigator.geolocation)
	{
		setTimeout(function(){
			try
			{
				watchId = window.navigator.geolocation.watchPosition(successCallback, errorCallback, watchOptions);
		    }
		    catch(evt)
		    {
		        
		    }
		}, 2000);	
	}
	
	function successCallback(position)
	{		
		$.ajax({
			type: "POST",
			url: BASEURL+"/includes/display/valid_geolocalisation.php",
			data: { latitude: position.coords.latitude,  longitude: position.coords.longitude }
		})
		.done(function(data)
		{
				
		});	
	};
	
	function errorCallback(error)
	{
	    switch(error.code){
	        case error.PERMISSION_DENIED:
	            $('.search-geoloc-error').slideDown();
	            stopWatch();
	            $('#county').val(0);
	            $('#get_counties').html('');
	            break;          
	        case error.POSITION_UNAVAILABLE:
	            $('.search-geoloc-error').slideDown();
	            stopWatch();
	            $('#county').val(0);
	            $('#get_counties').html('');
	            break;
	        case error.TIMEOUT:
	            $('.search-geoloc-error').slideDown();
	            stopWatch();
	            $('#county').val(0);
	            $('#get_counties').html('');
	            break;
	    }
	};
	
	function stopWatch(){
	    window.navigator.geolocation.clearWatch(watchId);
	}
	
	////////////////////////////////
	//Accept cookies
	////////////////////////////////

	$('#valid-cookies a').click( function()
	{
		$.ajax({
			type: "POST",
			url: "include/display/valid_cookie.php",
			data: { cookie: 1 }
		})
		.done(function(data)
		{
			$('#valid-cookies').fadeOut();					
		});
	});
	
	////////////////////////////////
	//Form autocomplete
	////////////////////////////////	
	
	$(document).on('focus', ':input[type=radio]', function(){
        $(this).attr('autocomplete', 'off');
    });
	
	////////////////////////////////
	//Deposit photos form
	////////////////////////////////	
	
	$('#upload_photo_wrap').prepend($('#uploadForm'));
	
	$(document).on('click', '#upload a', function(event)
	{
		var href = $(this).attr("href");
		var a_this = $(this);
		
		$.ajax({
			type: "GET",
			url: href,
			dataType: "html",
			success: function(data)
		    {				
				if(data != 0)
				{
					a_this.parent().find(">img").addClass('upload_photo');					
					a_this.parent().find(".upload_photo").attr('src', 'images/upload_photo.png');
					a_this.parent().find('a').addClass('upload_delete_link');
					a_this.parent().find('.upload_delete_link').hide();
					a_this.after(data);
				}						
		    }
		})
		
		event.preventDefault();
	});
	
	$(document).on('change', '#upload input', function()
	{
		$(this).parent().find(".loading").css('display', 'flex');
		$("#err_depot_1").fadeOut();
	    $("#err_depot_2").fadeOut();
	    $("#err_depot_3").fadeOut();
	    $("#err_depot_4").fadeOut();	
		
		/*$('#uploadForm').submit(); 
		$('#uploadFormShop').submit();
		
		$('#upload input').val('');
		$('#uploadFormShop input').val('');*/
	});
	
	/*$(document).on('submit', '#uploadForm', function(event)
	{	
		var formData = new FormData();
		var form = $(this)[0];
		
		jQuery.each(form, function(i, file) {
		  if($(file).attr('type') == 'file') {
		        if($(this).val().length > 0) {
					formData.append($(file).attr("name"), form[i].files[0], $(file).val());
				}
		    } else {
				formData.append($(file).attr("name"), $(file).val());
			}
		});

		$.ajax({
			type: "POST",
			url: "ajax/upload_img.php",
			data: formData,
		    cache: false,
		    contentType: false,
		    processData: false,
		    success: function(data)
		    {
			    $("p.loading").hide();		    
			    
			    if(data == 1)
					$("#err_depot_1").fadeIn();
			    else if(data == 2)
					$("#err_depot_2").fadeIn();
			    else if(data == 3)
					$("#err_depot_3").fadeIn();
			    else if(data == 4)
			    	$("#err_depot_4").fadeIn();
			    else if(data != '')
			    {
					$("#uploadForm div .upload_photo:first").attr('src', 'annonces/images/'+ data);
					$("#uploadForm div .upload_photo:first").parent().find('.upload_delete_link').show();	
					$("#uploadForm div .upload_photo:first").parent().find('span').remove();
					$("#uploadForm div .upload_photo:first").parent().find('input').remove();
					$("#uploadForm div .upload_photo:first").parent().find('a').removeClass('upload_delete_link');				
					$("#uploadForm div .upload_photo:first").removeClass('upload_photo');   
			    }								
		    }
		})
			
		event.preventDefault();
	});*/
	
	if($("#nb_photo_free"))
	{
		var nb_photo_free = parseInt($("#nb_photo_free").attr("data-nb-photo-free"));
		var nb_photo_total = parseInt($("#nb_photo_free").attr("data-nb-photo-total"));
		
		for (var i = (nb_photo_free + 1); i <= nb_photo_total; i++)
		{
			$("#upload div:nth-child(" + i + ")").hide();
		}
	}
	
	$('#ad_photo_pack_button').click( function()
	{
		$('#upload div').show();
		$(this).hide();
	});
	
	////////////////////////////////
	//Deposit files form
	////////////////////////////////	
	
	$('#upload_file_wrap').prepend($('#uploadFileForm'));
	
	$(document).on('click', '#uploadFile a', function(event)
	{
		var href = $(this).attr("href");
		var a_this = $(this);
		
		$.ajax({
			type: "GET",
			url: href,
			dataType: "html",
			success: function(data)
		    {				
				if(data != 0)
				{
					a_this.parent().find(">img").addClass('upload_file');
					a_this.parent().find(">img").attr('data-preview', '');	
					a_this.parent().find(".upload_file").attr('src', BASEURLIMG +'/template/images/upload_file.png');
					a_this.parent().find('a').addClass('upload_delete_link');
					a_this.parent().find('.upload_delete_link').hide();
					a_this.after(data);
				}						
		    }
		})
		
		event.preventDefault();
	});
	
	$(document).on('change', '#uploadFile input', function()
	{
		$(this).parent().find(".loading").css('display', 'flex');
		$("#err_depot_5").fadeOut();
	    $("#err_depot_6").fadeOut();
	    $("#err_depot_7").fadeOut();
	    $("#err_depot_8").fadeOut();	
		
		$('#uploadFileForm').submit(); 
		$('#uploadFileForm_logo_vit').submit();
		
		$('#upload input').val('');
		$('#uploadFileForm_logo_vit input').val('');
	});
	
	$(document).on('submit', '#uploadFileForm', function(event)
	{	
		var formData = new FormData();
		var form = $(this)[0];
		
		jQuery.each(form, function(i, file) {
		  if($(file).attr('type') == 'file') {
		        if($(this).val().length > 0) {
					formData.append($(file).attr("name"), form[i].files[0], $(file).val());
				}
		    } else {
				formData.append($(file).attr("name"), $(file).val());
			}
		});
		
		$.ajax({
			type: "POST",
			url: BASEURL+"/includes/display/ad_files_upload.php",
			data: formData,
		    cache: false,
		    contentType: false,
		    processData: false,
		    success: function(data)
		    {
			    $("p.loading").hide();
			    
			    if($.isNumeric(data)) {
				   $("#uploadFileForm div .upload_file:first").parent().find('input').val('');
				}	    
			    
			    if(data == 1)
					$("#err_depot_5").fadeIn();
			    else if(data == 2)
					$("#err_depot_6").fadeIn();
			    else if(data == 3)
					$("#err_depot_7").fadeIn();
			    else if(data == 4)
			    	$("#err_depot_8").fadeIn();
			    else if(data != '')
			    {
					$('#upload_file_wrap').height('auto');
					$("#uploadFileForm div .upload_file:first").attr('src', BASEURLIMG +'/template/images/uploaded_file.png');
					$("#uploadFileForm div .upload_file:first").addClass('uploaded_file');
					$("#uploadFileForm div .upload_file:first").attr('data-preview', data);
					
					$("#uploadFileForm div .upload_file:first").parent().find('.upload_delete_link').show();
					$("#uploadFileForm div .upload_file:first").parent().find('span').remove();
					$("#uploadFileForm div .upload_file:first").parent().find('input').remove();
					$("#uploadFileForm div .upload_file:first").parent().find('a').removeClass('upload_delete_link');
					
					$("#uploadFileForm div .upload_file:first").removeClass('upload_file');
					$("#uploadFileForm div .upload_file:first").parent().css("display", "block");
			    }								
		    }
		})
			
		event.preventDefault();
	});
	
	$(document).on('click', '#uploadFile img', function(event)
	{
		var href = $(this).attr("data-preview");
		
		if(href.length > 0)
		{
			window.open(BASEURLIMG +'/upload/files/'+ href, 'preview');
		}		
	});
	
	////////////////////////////////
	//Shop logo form
	////////////////////////////////
	
	$('#upload_photo_wrap').prepend($('#uploadFormShop'));
	
	$(document).on('submit', '#uploadFormShop', function(event)
	{		
		var formData = new FormData();
		var form = $(this)[0];
		
		jQuery.each(form, function(i, file) {
		  if($(file).attr('type') == 'file') {
		        if($(this).val().length > 0) {
					formData.append($(file).attr("name"), form[i].files[0], $(file).val());
				}
		    } else {
				formData.append($(file).attr("name"), $(file).val());
			}
		});
		
		$.ajax({
			type: "POST",
			url: BASEURL+"/includes/display/shop_logo_upload.php",
			data: formData,
		    cache: false,
		    contentType: false,
		    processData: false,
		    success: function(data)
		    {
			    $("p.loading").hide();		    
			    
			    if(data == 1)
					$("#err_depot_1").fadeIn();
			    else if(data == 2)
					$("#err_depot_2").fadeIn();
			    else if(data == 3)
					$("#err_depot_3").fadeIn();
			    else if(data != '')
			    {
					$("#uploadFormShop div .upload_photo:first").attr('src', BASEURLIMG +'/upload/logos/'+ data);
					$("#uploadFormShop div .upload_photo:first").parent().find('.upload_delete_link').show();	
					$("#uploadFormShop div .upload_photo:first").parent().find('span').remove();
					$("#uploadFormShop div .upload_photo:first").parent().find('input').remove();
					$("#uploadFormShop div .upload_photo:first").parent().find('a').removeClass('upload_delete_link');				
					$("#uploadFormShop div .upload_photo:first").removeClass('upload_photo');   
			    }								
		    }
		})
			
		event.preventDefault();
	});
	
	////////////////////////////////
	//Display phone - Ad page
	////////////////////////////////
	$('.contact > .phone').on('click', function(e) {
		if($(this).attr('data-id') != 'undefined' && !$(this).hasClass('is-display')) {
			e.preventDefault();
			var link = $(this);
			$.ajax({
				type: "POST",
				url: $(this).attr('href'),
				data: { id: $(this).attr('data-id') }
			})
			.done(function(data)
			{	
				$('.display-phone').fadeOut( "normal", function() {
					if(data != 0)
					{
						$('.display-phone').html(data.replace('@', ''));
						$(link).addClass('is-display');
						var num = data.split('@');
						$(link).attr('href', 'tel:'+num[1]);
						$('.display-phone').fadeIn("normal");
					}
				});							
			});	
		}
	});

	
	////////////////////////////////
	//Credit system
	////////////////////////////////
	
	$(".forms.credits div > p > a").click( function()
	{
		$(".forms.credits div > p > a").removeClass("selected");
		$(this).addClass("selected");
	});
	
	var acc_credit_val_selected = $(".selected").attr("data-price");
	acc_credit_val_selected = parseFloat(acc_credit_val_selected);
	var acc_credit_1 = $("#credit_1").html();
	acc_credit_1 = parseFloat(acc_credit_1);
	var acc_credit_3 = acc_credit_val_selected + acc_credit_1;
	
	$("#credit_2").html(parseFloat(acc_credit_val_selected).toFixed(2));
	$("#credit_3").html(parseFloat(acc_credit_3).toFixed(2));
	
	$('.forms.credits div > p > a').click( function()
	{
		var input_credit_val = $(this).attr("data-price");
		input_credit_val = parseFloat(input_credit_val);
		
		var acc_credit_1 = $("#credit_1").html();
		acc_credit_1 = parseFloat(acc_credit_1);
		
		var acc_credit_3 = input_credit_val + acc_credit_1;
		
		$("#credit_2").html(parseFloat(input_credit_val).toFixed(2));
		$("#credit_3").html(parseFloat(acc_credit_3).toFixed(2));		
	});
	
	////////////////////////////////
	//Comments
	////////////////////////////////
	
	$(".rating-form a")
		.mouseenter(function() {
			var rating_val = $(this).attr("data-ratting-val");		
			$(".rating-form a").removeClass("actif");
		
			if(rating_val == 5) $(".rating-form a:nth-child(1)").addClass("actif");
			if(rating_val >= 4) $(".rating-form a:nth-child(2)").addClass("actif");
			if(rating_val >= 3) $(".rating-form a:nth-child(3)").addClass("actif");
			if(rating_val >= 2) $(".rating-form a:nth-child(4)").addClass("actif");
			if(rating_val >= 1) $(".rating-form a:nth-child(5)").addClass("actif");
		})
		.mouseleave(function() {
			var rating_val = $("#comment_rating").val();
			
			$(".rating-form a").removeClass("actif");
			
			if(rating_val == 5) $(".rating-form a:nth-child(1)").addClass("actif");
			if(rating_val >= 4) $(".rating-form a:nth-child(2)").addClass("actif");
			if(rating_val >= 3) $(".rating-form a:nth-child(3)").addClass("actif");
			if(rating_val >= 2) $(".rating-form a:nth-child(4)").addClass("actif");
			if(rating_val >= 1) $(".rating-form a:nth-child(5)").addClass("actif");
		});
		
	$(".rating-form a").click( function()
	{		
		var rating_val = $(this).attr("data-ratting-val");		
		$("#comment_rating").val(rating_val);
		
		$(".rating-form a").removeClass("actif");
		
		if(rating_val == 5) $(".rating-form a:nth-child(1)").addClass("actif");
		if(rating_val >= 4) $(".rating-form a:nth-child(2)").addClass("actif");
		if(rating_val >= 3) $(".rating-form a:nth-child(3)").addClass("actif");
		if(rating_val >= 2) $(".rating-form a:nth-child(4)").addClass("actif");
		if(rating_val >= 1) $(".rating-form a:nth-child(5)").addClass("actif");
	});
	
	$("#comment-form-wrap").prepend($("#form-post-comment"));
	
	$("#form-post-comment").on('submit', function(e)
	{	
		e.preventDefault();
		
		$("#error-post-form-comment").hide();
		$("#error-post-form-comment-email").hide();
		
		var comment_txt = $("#comment_txt").val();
		var placeholderText = $("#comment_txt").attr("data-placeholder");
		var comment_title = $('#comment_title').val();
		var placeholderTitle = $("#comment_title").attr("data-placeholder");		
		var comment_email = $('#comment_email').val();
		var placeholderEmail = $("#comment_email").attr("data-placeholder");
		var comment_rating = $("#comment_rating").val();
		var page_ad_com_form_valid = $("#valid-post-form-comment").html();
		
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if(comment_email == '' || comment_email == placeholderEmail || !emailReg.test(comment_email))
		{
			$("#comment_email").addClass("form-error");
			$("#error-post-form-comment-email").fadeIn();
		}
		else if(comment_title == '' || comment_title == placeholderTitle || comment_txt == '' || comment_txt == placeholderText || comment_rating == 0)
		{
			$("#comment_title").addClass("form-error");
			$("#comment_txt").addClass("form-error");
			$("#error-post-form-comment").fadeIn();	
		}
		else
		{
			$("#error-post-form-comment").hide();
			$("#error-post-form-comment-email").hide();
			$("#form-post-comment input, #form-post-comment textarea").removeClass("form-error");
		
			var comment_id = $('#comment_id').val();
			var comment_type = $('#comment_id').attr("data-type"); // 1 = Ad, 2 = shop
			var comment_pseudo = $('#comment_pseudo').val();
					
			$.ajax({
				type: "POST",
				url: BASEURL+"/includes/display/form_comment.php",
				data: { comment_id: comment_id, comment_type: comment_type, comment_pseudo: comment_pseudo, comment_title: comment_title, comment_email: comment_email, comment_txt: comment_txt, comment_rating : comment_rating }
			})
			.done(function(data)
			{
				$('#comment-form-wrap').slideUp( "normal", function() {
					$('#form-post-comment').hide();
					$('#comment-form-wrap').html('<div id="valid-post-form-comment" style="display: block;"><p>'+ page_ad_com_form_valid +'</p></div>');
					$('#comment-form-wrap').slideDown("slow");
				});
			});
		}
	});
		
	$("#button-show-comments").click( function()
	{			
		$("#comments-show").slideToggle('slow', function(e) {
			if(document.getElementById('comments-show').style.display == 'none') {
				document.getElementById('button-show-comments').innerHTML = document.getElementById('button-show-comments').dataset.moretext;
			} else {
				document.getElementById('button-show-comments').innerHTML = document.getElementById('button-show-comments').dataset.lesstext;
			}
		});
	});
	
	////////////////////////////////
	//Ad form file upload
	////////////////////////////////
	
	$("#ico_update1").on( "click", function()
	{
		var this_element = $(this);
		var msg_text = this_element.attr("data-text");
		var msg_text_valid = this_element.attr("data-valid");
		var msg_text_cancel = this_element.attr("data-cancel");

		$("#popup_msg p").text(msg_text);	
        
        if(msg_text != 0)
        {
		    $("#popup_msg").dialog(
			{
				autoOpen: true,
				show: {effect: 'fade', speed: 1000},
				resizable: false,
				height: "auto",
				minWidth: 400,
				maxWidth: windowWidth,
				minHeight: 20,
				fluid: true,
				modal: true,
				open: function() {
				    $('.ui-widget-overlay').addClass('custom-overlay');
				    $('#popup_msg p').addClass("active");
				},
				close: function() {
				    $('.ui-widget-overlay').removeClass('custom-overlay');
				    $('#popup_msg p').addClass("active");
				},
				modal: true,
				buttons: [
				{
					text: msg_text_valid,
					click: function() {
						$(this).dialog( "close" );
						
						if(this_element.is("input"))
						{
							this_element.attr("data-text", 0);
							this_element.trigger("click");
						}
						else
						{
							var this_href = this_element.attr("href");
							$(location).attr('href', this_href);
						}
					}
				},
				{
					text: msg_text_cancel,
					click: function() {
						$( this ).dialog( "close" );
						return false;
					}
				}
				]
			});
			event.preventDefault();
	        event.stopPropagation();   
			return false;
        }        
	});
	
	////////////////////////////////
	//Delete ad(s) dialog
	////////////////////////////////
	
	$("#delete").on("click", function(event)
	{
		var this_element = $(this);
		var msg_text = this_element.attr("data-text");
		var msg_text_valid = this_element.attr("data-valid");
		var msg_text_cancel = this_element.attr("data-cancel");
				
		var elt_id = this_element.attr("id");
		var popup_aff = 1;
		
		if(elt_id == "delete" && !this_element.hasClass('delete_ad'))
		{
			var n = $("input:checked").length;				
			if(n == 0) popup_aff = 0;	
		}		
        
        if(msg_text != 0 && popup_aff == 1)
        {
			$("body").prepend('<div id="popup_msg" title=""><p></p></div>');
			$("#popup_msg p").text(msg_text);

			$("#popup_msg").dialog(
			{
				autoOpen: true,
				show: {effect: 'fade', speed: 500},
				resizable: false,
				height: "auto",
				minWidth: 400,
				maxWidth: windowWidth,
				minHeight: 20,
				fluid: true,
				modal: true,
				open: function() {
				    $('.ui-widget-overlay').addClass('custom-overlay');
				    $('#popup_msg').find('button:contains("'+msg_text_valid+'")');
				    $('#popup_msg p').addClass("active");
				},
				close: function() {
				    $('.ui-widget-overlay').removeClass('custom-overlay');
				    $('#popup_msg p').removeClass("active");
				},
				buttons: [
				{
					text: msg_text_valid,
					click: function() {
						$(this).dialog( "close" );
						
						if(this_element.is("input"))
						{
							this_element.attr("data-text", 0);
							this_element.trigger("click");
						}
						else
						{
							var this_href = this_element.attr("href");
							$(location).attr('href', this_href);
						}
					}
				},
				{
					text: msg_text_cancel,
					click: function() {
						$( this ).dialog( "close" );
						return false;
					}
				}
				]
			});
			event.preventDefault();
	        event.stopPropagation();    
			return false;
        }        
	});
	
	var minWithPopup = 400;

	if(windowWidth < 500)
	minWithPopup = windowWidth;
	
	function fluidDialog()
	{
	    var $visible = $(".ui-dialog:visible");

	    $visible.each(function ()
	    {
	        var $this = $(this);
	        var dialog = $this.find(".ui-dialog-content").data("ui-dialog");
	        windowWidth = $(window).width();
	        	        
	        if (dialog.options.fluid)
	        {
	            var wWidth = $(window).width();
	            
	            if(wWidth < minWithPopup)
	            minWithPopup = wWidth;
	                        
	            if (wWidth < (parseInt(dialog.options.maxWidth) + 50))
	            {
	                $this.css("max-width", "90%");
	            } else {
		            $this.css("max-width", dialog.options.maxWidth + "px");
	            }
	            dialog.option("position", dialog.options.position);
	        }
	    });
	
	}
	
	$(window).resize(function () {
		fluidDialog();
	});
	
	$(document).on("dialogopen", ".ui-dialog", function (event, ui) {
		fluidDialog();
	});
	
	$( window ).scroll(function() {
		fluidDialog();
	});
	
	////////////////////////////////
	//Display selection
	////////////////////////////////
	
	var hearts = document.querySelectorAll('.icon-heart');
		
	if(hearts.length > 0) {
		for(var heart of hearts) {
			heart.addEventListener('click', function(e) {
				e.preventDefault();
				var element = this;
				var action = 1;
				if(element.classList.contains('selected')) {
					action = 2;
				}
				var xhr = new XMLHttpRequest();
				
				xhr.open('POST', element.href, true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.onload  = function(e) {
					if(this.status == 200) {
						if(element.classList.contains('selected')) {
							element.classList.remove('selected');
							if(parseInt(document.getElementById('nb-ads-selection').innerHTML) > 0) {
								var new_value = parseInt(document.getElementById('nb-ads-selection').innerHTML) - 1;
								document.getElementById('nb-ads-selection').innerHTML = new_value;
							}
						} else {
							element.classList.add('selected');
							var new_value = parseInt(document.getElementById('nb-ads-selection').innerHTML) + 1;
							document.getElementById('nb-ads-selection').innerHTML = new_value;
						}
					}
				};
				xhr.send('id_ad='+element.dataset.id+"&action="+action);
			});
		}
	}
	
	var del_selected = document.getElementsByClassName('icon-deleted-ad-selected');
	if(del_selected.length > 0) {
		for(var selected of del_selected) {
			selected.addEventListener('click', function(e) {
				e.preventDefault();
				var element = this;
				var xhr = new XMLHttpRequest();			
				xhr.open('POST', element.href, true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.onload  = function(e) {
					if(this.status == 200) {
						element.closest('.background-ads-listing-container').remove();
						var new_value = parseInt(document.getElementById('nb-ads-selection').innerHTML) - 1;
						if(new_value < 1) {
							new_value = 0;
							document.querySelector('.search-results-container').innerHTML = this.response;
						}
						document.getElementById('nb-ads-selection').innerHTML = new_value;
					}
				};
				xhr.send('id_ad='+element.dataset.id+"&action=2&is_ajax=true");
			});
		}
	}
});

Object.defineProperty(Object.prototype, 'jToString', {value: jToString, writable: false, enumerable: false});
Object.defineProperty(Object.prototype, 'jlength', {value: jlength, writable: false, enumerable: false});

////////////////////////////////
//Manage Mobile menu
////////////////////////////////
var mobileMenu = function(options) {
	this.container = options && options.container ? document.querySelector(options.container) : document.querySelector('.header-links');
	this.menu = options && options.menu ? this.container.querySelector(options.menu) : this.container.querySelector('.menu');
	this.container_left = options && options.container_left ? options.container_left : 0;
	this.menu_left = options && options.menu_left ? options.menu_left : '-10px';
	this.toogle_trigger = options && options.toogle_trigger ? document.getElementById(options.toogle_trigger) : document.getElementById('main-menu');
	this.main_animate_width = options && options.main_animate_width ? options.main_animate_width : '100vw';
	this.animate_width = options && options.animate_width ? options.animate_width : '80vw';
	this.breakpoint = options && options.breakpoint ? options.breakpoint : 1050;
	this.container_duration = options && options.container_duration ? options.container_duration : 1;
	this.menu_duration = options && options.menu_duration ? options.menu_duration : 400;
	
	this.init = function() {
		var _this = this;
		if(_this.container) {
			add_listener(_this);
		}
		window.addEventListener('resize', function() {
			clear_menu(_this);
		});

	};
	
	function add_listener(menu) {
		menu.toogle_trigger.addEventListener('click', function(e) {
			if(window.innerWidth <= menu.breakpoint) {
				e.preventDefault();
				if(menu.container.clientWidth == 0) {
					open_container_menu(menu);
				} else {
					close_menu(menu);
				}
			}
		});
	};
	
	function clear_menu(menu) {
		menu.container.removeAttribute('style');
		menu.menu.removeAttribute('style');
		document.querySelector('body').style.overflow = 'auto';
	};
	
	function open_container_menu(menu) {
		$(menu.container).stop(true);
		$(menu.container).animate({left: menu.container_left}, {
			duration: menu.container_duration,
			start: function() {
				document.querySelector('body').style.overflow = 'hidden';
				menu.container.style.display = 'block';
				menu.container.style.width = menu.main_animate_width;
				open_menu(menu);
			}
		});
	};
	
	function open_menu(menu) {
		$(menu.menu).stop(true);
		$(menu.menu).animate({left: menu.menu_left}, {
			duration: menu.menu_duration
		});
	};
	
	function close_container_menu(menu) {
		$(menu.container).stop(true);
		$(menu.container).animate({left: '-100vw'}, {
			duration: menu.container_duration,
			complete: function() {
				document.querySelector('body').style.overflow = 'auto';
				menu.container.style.display = 'none';
				menu.container.style.width = 0;
			}
		});
	};
	
	function close_menu(menu) {
		$(menu.menu).stop(true);
		$(menu.menu).animate({left: '-100vw'}, {
			duration: menu.menu_duration,
			start: function() {
				close_container_menu(menu);
				clear_menu(menu);
			}
		});
	};
	
	this.init();
};

////////////////////////////////
//Images slideshow with thumb managment
////////////////////////////////
var slideShow = function(options) {
	this.container = options && options.container ? document.querySelector(options.container) : document.querySelector('.ad-page-bloc-thumbnail');
	this.nav_buttons_prev = options && options.nav_buttons_prev ? document.querySelector(options.nav_buttons_prev) : document.querySelector('.nav-slide.prev');
	this.nav_buttons_next = options && options.nav_buttons_next ? document.querySelector(options.nav_buttons_next) : document.querySelector('.nav-slide.next');
	this.close_button = options && options.close_button ? options.close_button : document.querySelector('.close_modal');
	this.slider = options && options.slider ? document.querySelector(options.slider) : document.querySelector('.ad-page-bloc-thumbnail-list');
	this.slides = options && options.slides ? this.slider.querySelectorAll(options.slides) : this.slider.querySelectorAll('li');
	this.current_slide_class = options && options.current_slide_class ? options.current_slide_class : 'current-thumb';
	this.img_container = options && options.img_container ? options.img_container : 'photo';
	this.wrapper_options = options && options.wrapper ? options.wrapper : {element: 'div', id: guid()};
	this.wrapper;
	this.wrapper_width = 0;
	this.sliders_width = 0;	
	this.modal =  options && options.modal ? options.modal : {main_container: '.modal-content', container: '#modal_nav', nav_buttons_prev: '.modal.prev', nav_buttons_next: '.modal.next', slider: '.thumb_list', slides: 'li', current_slide_class: 'current-thumb', img_container: 'my_slides', wrapper_options: {element: 'div', id: 'modal_nav'}, wrapper_width: 0, sliders_width: 0};
	this.resize_timer;

	this.init = function() {
		var _this = this;
		if(_this.slider && _this.slides.length > 0) {
			for(var slide of _this.slides) {
				_this.sliders_width += parseFloat(slide.clientWidth) + 4;
				var slider_width = _this.slides.length > 1 ? _this.slider.clientWidth : _this.slider.clientWidth + 8;
				if(_this.sliders_width <= slider_width) {
					_this.wrapper_width += parseFloat(slide.clientWidth) + 4;
				}
				add_slide_listener(slide, _this);
			}
			_this.wrapper = document.createElement(_this.wrapper_options.element);
			_this.wrapper.id = _this.wrapper_options.id;
			_this.wrapper.style.display = 'inline-block';
			_this.wrapper.style.overflow = 'hidden';
			_this.wrapper.style.width = 'auto';
			_this.wrapper.style.width = _this.wrapper_width+'px';
			_this.slider.parentNode.insertBefore(_this.wrapper, _this.nav_buttons_next);
			_this.wrapper.appendChild(_this.slider);
			_this.slider.style.width = _this.sliders_width+'px';
			_this.nav_buttons_prev.addEventListener('click', function(e) {
				e.preventDefault();
				prev_slide(_this);
			});
			_this.nav_buttons_next.addEventListener('click', function(e) {
				e.preventDefault();
				next_slide(_this);
			});
			if(_this.modal && document.querySelector(_this.modal.container) != _this.container) {
				var modal_shideshow = new slideShow(_this.modal);
				document.querySelector(modal_shideshow.modal.main_container).style.display = 'none';
				document.querySelector(modal_shideshow.modal.main_container).style.opacity = 1;
				document.getElementById(_this.img_container).addEventListener('click', function() {
					document.querySelector('body').style.overflow = 'hidden';
					document.getElementById(modal_shideshow.img_container).src = this.src;
					var current_slide = this.dataset.num;
					document.getElementById(modal_shideshow.img_container).dataset.num = current_slide;
					modal_shideshow.container.querySelector('[data-num="'+current_slide+'"]').classList.add(modal_shideshow.current_slide_class);
					document.querySelector(modal_shideshow.modal.main_container).style.display = 'block';
					offset_limit = parseInt(_this.wrapper.style.width);
					if(offset_limit <= modal_shideshow.container.querySelector('[data-num="'+current_slide+'"]').offsetLeft) {
						if(_this.slider.style.marginLeft) {
							var new_margin = parseInt(_this.slider.style.marginLeft) * -1;
						} else {
							var new_margin = 0;
						}
						new_margin += modal_shideshow.container.querySelector('[data-num="'+current_slide+'"]').clientWidth + 4;
						$(_this.slider).animate({marginLeft: -new_margin});
					} else if(_this.slider.style.marginLeft) {
						$(_this.slider).animate({marginLeft: 0});
					}
				});
				modal_shideshow.close_button.addEventListener('click', function() {
					document.querySelector(modal_shideshow.modal.main_container).style.display = 'none';
					modal_shideshow.container.querySelector('.'+modal_shideshow.current_slide_class).classList.remove(modal_shideshow.current_slide_class);
					document.querySelector('body').style.overflow = 'auto';
				});
			}
			
			window.addEventListener('resize', function() {
				if(_this.slider && _this.slides.length > 1) {
					var modal_hide = false;
					if(_this.modal && document.querySelector(_this.modal.container) == _this.container && document.querySelector(_this.modal.main_container).style.display == 'none') {
						modal_hide = true;
						document.querySelector(_this.modal.main_container).style.opacity = 0;
						document.querySelector(_this.modal.main_container).style.display = 'block';
					}
					_this.wrapper_width = 0;
					_this.sliders_width = 0;
					_this.slider.style.width = 'auto';
					_this.wrapper.style.width = 'auto';
					var new_slider_width = _this.container.clientWidth - _this.nav_buttons_prev.clientWidth - _this.nav_buttons_next.clientWidth - 8;
					for(var slide of _this.slides) {
						_this.sliders_width += parseFloat(slide.clientWidth) + 4;
						if(_this.sliders_width <= new_slider_width) {
							_this.wrapper_width += parseFloat(slide.clientWidth) + 4;
						}
					}
					_this.wrapper.style.width = _this.wrapper_width+'px';
					_this.slider.style.width = _this.sliders_width+'px';
					if(_this.modal && document.querySelector(_this.modal.container) == _this.container) {
						if(modal_hide == true) {
							document.querySelector(_this.modal.main_container).style.display = 'none';
							document.querySelector(_this.modal.main_container).style.opacity = 1;
						}
					}
					if(_this.modal && document.querySelector(_this.modal.container) != _this.container) {
						_this.resize_timer = clearTimeout(_this.resize_timer);
						_this.resize_timer = setTimeout(function() {
							target_slide(_this, _this.slider.querySelector('.'+_this.current_slide_class));
						}, 100);
					}
				}
			});
		}
	};
	this.init();
	
	function target_slide(slider, target_slide) {
		var _this = slider;
		$(_this.slider).stop(true);
		if(target_slide) {
			var max_offset = _this.wrapper.offsetLeft + parseInt(_this.wrapper.style.width);
			var target_offset = target_slide.offsetLeft + parseInt(target_slide.clientWidth);
			_this.slider.style.marginLeft = 0;
			if(max_offset < target_offset) {
				var new_margin = target_offset - max_offset;
				$(_this.slider).animate({marginLeft: -new_margin});
			}
		}
		if(_this.modal) {
			var modal_wrapper =  document.getElementById(_this.modal.wrapper_options.id).querySelector(_this.modal.slider);
			var targer_slide = modal_wrapper.querySelector('.'+_this.modal.current_slide_class);
			if(modal_wrapper && targer_slide) {
				var max_offset = modal_wrapper.parentNode.offsetLeft + parseInt(modal_wrapper.parentNode.style.width);
				var target_offset = targer_slide.offsetLeft + parseInt(target_slide.clientWidth) + 4;
				modal_wrapper.style.marginLeft = 0;
				if(max_offset < target_offset) {
					var new_margin = target_offset - max_offset;
					$(modal_wrapper).animate({marginLeft: -new_margin});
				}
			}
		}
	}
	
	function prev_slide(slideshow) {
		$(slideshow.slider).finish();
		$('#'+slideshow.img_container).finish();
		var current_slide = slideshow.slider.querySelector('.'+slideshow.current_slide_class);
		current_slide.classList.remove(slideshow.current_slide_class);
		if(current_slide.previousElementSibling) {
			var target_slide = current_slide.previousElementSibling;
		} else {
			var target_slide = slideshow.slides.item(slideshow.slides.length - 1);
		}
		if(target_slide) {
			target_slide.classList.add(slideshow.current_slide_class);
			if((target_slide.parentElement.offsetLeft + slideshow.wrapper.clientWidth) <= target_slide.offsetLeft) {
				if(slideshow.slider.style.marginLeft) {
					var new_margin = parseInt(slideshow.slider.style.marginLeft) * -1;
				} else {
					var new_margin = 0;
				}
				if(target_slide.nextElementSibling) {
					new_margin -= target_slide.nextElementSibling.clientWidth + 4;
				} else {
					new_margin = slideshow.sliders_width - slideshow.wrapper_width;
				}
				$(slideshow.slider).animate({marginLeft: -new_margin});
			} else if(slideshow.slider && slideshow.slider.style.marginLeft) {
				$(slideshow.slider).animate({marginLeft: 0});
			}
			display_new_img(target_slide, slideshow);	
		}
	};
	
	function next_slide(slideshow) {
		$(slideshow.slider).finish();
		$('#'+slideshow.img_container).finish();
		var current_slide = slideshow.slider.querySelector('.'+slideshow.current_slide_class);
		current_slide.classList.remove(slideshow.current_slide_class);
		if(current_slide.nextElementSibling) {
			var target_slide = current_slide.nextElementSibling;
		} else {
			var target_slide = slideshow.slides.item(0);
		}
		if(target_slide) {
			$(slideshow.slider).stop(true);
			target_slide.classList.add(slideshow.current_slide_class);
			var offset_limit = target_slide.parentElement.offsetLeft + parseInt(slideshow.wrapper.style.width);
			if(slideshow.modal && document.querySelector(slideshow.modal.container) == slideshow.container) {
				offset_limit = parseInt(slideshow.wrapper.style.width);
			}
			if(offset_limit <= target_slide.offsetLeft) {
				if(slideshow.slider.style.marginLeft) {
					var new_margin = parseInt(slideshow.slider.style.marginLeft) * -1;
				} else {
					var new_margin = 0;
				}
				new_margin += target_slide.clientWidth + 4;
				$(slideshow.slider).animate({marginLeft: -new_margin});
			} else if(slideshow.slider.style.marginLeft) {
				$(slideshow.slider).animate({marginLeft: 0});
			}
			display_new_img(target_slide, slideshow);
		}
	};
	
	function display_new_img(target_slide, slideshow) {
		var target_img = target_slide.querySelector('img');
		$('#'+slideshow.img_container).fadeOut(100, function() {
			document.getElementById(slideshow.img_container).src = target_img.src.replace('/thumbnails/', '/photos/');
			document.getElementById(slideshow.img_container).dataset.num = target_slide.dataset.num;
			$('#'+slideshow.img_container).fadeIn(100);
		});	
	};
	
	function add_slide_listener(slide, slideshow) {
		slide.addEventListener('click', function(e) {
			event.preventDefault();
			var current_slide = slideshow.slider.querySelector('.'+slideshow.current_slide_class);
			current_slide.classList.remove(slideshow.current_slide_class);
			this.classList.add(slideshow.current_slide_class);
			display_new_img(this, slideshow);
		});
	};
	
	function guid() {
		return Math.floor((1 + Math.random()) * 0x75bcd15).toString(16).substring(1);
	};
};

////////////////////
//Dialog Box Object definition
////////////////////
var dialogBox = function() {
	this.container;
	this.width;
	this.height;
	this.maxWidth;
	this.maxHeight;
	this.isOpen = false;
	this.triggered;
	this.dialog_box;
	this.content;
	this.position;
	this.onload;
	this.breakpoint;
	this.breakpoint_dimensions;
	this.window_breakpoint;
	
	this.init = function(options) {
		this.container = document.querySelector((typeof options != 'undefined' && typeof options.container != 'undefined' ? options.container : 'body'));
		this.width = defined_width((typeof options != 'undefined' && typeof options.width != 'undefined' ? options.width : 400));
		this.height = defined_height((typeof options != 'undefined' && typeof options.height != 'undefined' ? options.height : 400));
		this.maxWidth = defined_width((typeof options != 'undefined' && typeof options.maxWidth != 'undefined' ? options.maxWidth : this.width));
		this.maxHeight = defined_height((typeof options != 'undefined' && typeof options.maxHeight != 'undefined' ? options.maxHeight : this.height));
		this.triggered = typeof options != 'undefined' && typeof options.triggered != 'undefined' ? options.triggered : {event: 'load', element: 'window'};
		this.wrapper = typeof options != 'undefined' && typeof options.wrapper != 'undefined' ? options.wrapper : {element: 'div', classes: 'dialog-box'};
		this.content = typeof options != 'undefined' && typeof options.content != 'undefined' ? options.content : '';
		this.onload = typeof options != 'undefined' && typeof options.onload != 'undefined' ? options.onload : '';
		this.active_breakpoint = typeof options != 'undefined' && typeof options.active_breakpoint != 'undefined' ? options.active_breakpoint : true;
		this.breakpoint = typeof options != 'undefined' && typeof options.breakpoint != 'undefined' ? options.breakpoint : {width: 401, height: 401};
		this.breakpoint_dimensions =  typeof options != 'undefined' && typeof options.breakpoint_dimensions != 'undefined' ? options.breakpoint_dimensions : {width: '100%', height: '100%'};
		this.window_breakpoint =  typeof options != 'undefined' && typeof options.window_breakpoint != 'undefined' ? options.window_breakpoint : {width: 801, height: 801};
			
		var wrapper = document.createElement(options.wrapper.element);
		if(typeof options.wrapper.classes != 'undefined') {
			if(options.wrapper.classes.match(' ')) {
				var classes = options.wrapper.classes.split(' ');
				for(var elt of classes) {
					if(!wrapper.classList.contains(elt)) {
						wrapper.classList.add(elt);
					}
				}
			} else if(!wrapper.classList.contains(options.wrapper.classes)) {
				wrapper.classList.add(options.wrapper.classes);
			}
		}
		if(!wrapper.classList.contains('dialog-box')) {
			wrapper.classList.add('dialog-box');
		}
		if(typeof options.wrapper.id != 'undefined') {
			wrapper.id = options.wrapper.id;
		}
		wrapper.style.display = 'none';
		
		if(this.content.length > 0 && is_url(this.content)) {
			var request_content = new jXMLHttpRequest();
			request_content.request(this.content, '', function(response) {
				wrapper.innerHTML = response;
			});
		} else {
			wrapper.innerHTML = this.content;
		}
		
		var close_button_obj = document.createElement('span');
		close_button_obj.id = 'close-button';
		close_button_obj.innerHTML = '&times;';
		close_button_obj.classList.add('dialog-box');
		this.container.appendChild(wrapper);
		this.container.insertBefore(close_button_obj, wrapper);
		this.dialog_box = wrapper;
		
		var box = this;
		if(this.triggered.element == 'window') {
			window.addEventListener(this.triggered.event, function(event) {
				display_box(event, box, options);
			}, false);
		} else {
			var buttons = document.querySelectorAll(this.triggered.element);
			if(buttons.length > 0) {
				for(var button of buttons) {
					button.addEventListener(this.triggered.event, function(event) {
						display_box(event, box, options);
					}, false);
				}
			}
		}
		
		window.addEventListener('resize', function() {
			resize(box, options);
		});
	}
	
	function display_box(event, box, options) {
		event.preventDefault();
		if(document.getElementsByClassName('dialog-box-layer').length > 0) {
			document.getElementsByClassName('dialog-box-layer').item(0).style.display = 'block';
		} else {
			var layer = document.createElement('div');
			layer.classList.add('dialog-box-layer');
			box.container.appendChild(layer);
		}
		document.querySelector('body').style.overflow = 'hidden';
		box.isOpen = true;
		box.dialog_box.style.display = 'block';
		box.dialog_box.style.position = 'fixed';
		box.dialog_box.style.zIndex = 1000;
		resize(box, options);
		var close_buttons = document.querySelectorAll('.dialog-box#close-button');
		for(close_button of close_buttons) {
			close_button.style.display = 'block';
			close_button.addEventListener('click', function(event) {
				close_box(event, box);
			});
		}
		document.addEventListener('keydown', function(event) {
			if(event.key.toLowerCase() === 'escape' || event.key.toLowerCase() === 'esc') {
				close_box(event, box);
			}
		});
		if(typeof box.onload == 'function') {
			box.onload();
		}
	};
	
	function close_box(event, box) {
		event.preventDefault();
		box.dialog_box.style.display = 'none';
		document.getElementsByClassName('dialog-box-layer').item(0).style.display = 'none';
		document.querySelector('body').style.overflow = 'auto';
		var close_buttons = document.querySelectorAll('.dialog-box#close-button');
		for(close_button of close_buttons) {
			close_button.style.display = 'none';
		}
	}
	
	function defined_width(width) {
		var newWidth = width;
		if(typeof width == 'string' && width.match('%')) {
			newWidth = window.innerWidth * parseInt(width) / 100;
		}
		if(newWidth > window.innerWidth) {
			newWidth = window.innerWidth;
		}
		return newWidth;
	};
	
	function defined_height(height) {
		var newHeight = height;
		if(typeof height == 'string' && height.match('%')) {
			newHeight = window.innerHeight * parseInt(height) / 100;
		}
		if(newHeight > window.innerHeight) {
			newHeight = window.innerHeight;
		}
		return newHeight;
	};
	
	function resize(box, options) {
		box.width = defined_width((typeof options != 'undefined' && typeof options.width != 'undefined' ? options.width : 400));
		box.height = defined_height((typeof options != 'undefined' && typeof options.height != 'undefined' ? options.height : 400));
		box.dialog_box.style.width = box.width+'px';
		box.dialog_box.style.height = box.height+'px';
		box.dialog_box.style.top = ((window.innerHeight - box.height) / 2)+'px';
		box.dialog_box.style.left = ((window.innerWidth - box.width) / 2)+'px';
		if(box.active_breakpoint == true) {
			if(box.width < box.breakpoint.width && window.innerWidth < box.window_breakpoint.width) {
				box.width = defined_width(box.breakpoint_dimensions.width);
				box.dialog_box.style.width = box.width+'px';
				var new_left = ((window.innerWidth - box.width) / 2);
				if(new_left < 0) {
					new_left = 0;
				}
				box.dialog_box.style.left = new_left+'px';

			}
			if(box.height < box.breakpoint.height && window.innerHeight < box.window_breakpoint.height) {
				box.height = defined_height(box.breakpoint_dimensions.height);
				box.dialog_box.style.height = box.height+'px';
				var new_top = ((window.innerHeight - box.height) / 2);
				if(new_top < 0) {
					new_top = 0;
				}
				box.dialog_box.style.top = new_top+'px';
			}
		}
	};
};

////////////////////
//XMLHttpRequest object clone
////////////////////
var jXMLHttpRequest =  function() {
	this.xhr = new XMLHttpRequest();
	
	this.request = function(url, data, callback, errorsObject) {
		var url_request;
		var data_request = 'is_ajax=true';
		var callback_request;
		if(typeof url == 'object') {
			url_request = is_url(url.url) ? url.url : url.jlink();
			data_request += url.data.jToString(true);
			if(typeof url.callback == 'function') {
				callback_request = url.callback;
			}
			if(typeof url.errorsObject != 'undefined') {
				errorsObj = url.errorsObject;
			}
		} else {
			url_request = is_url(url) ? url : url.jlink();
			if(typeof data == 'object') {
				data_request += data.jToString(true);
			} else {
				data_request += data;
			}
			if(typeof callback == 'function') {
				callback_request = callback;
			}
			if(typeof callback == 'undefined' && typeof data == 'function') {
				callback_request = data;
			}
			if(typeof errorsObject != 'undefined') {
				errorsObj = errorsObject;
			}
		}
		this.xhr.open('POST', url_request, true);
		this.xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		this.xhr.onload  = function(e) {
			if(this.status == 200) {
				if(this.response.status == 200) {
					if(typeof callback_request == 'function') {
						if(typeof this.response == 'object') {
							this.response.length = this.response.jlength();
						}
						return callback_request(this.response);
					} else {
						return this.response;
					}
				} else if(this.response.status == 500) {
					for(var error of this.response.response) {
						errorsObj.addError(error);
					}
					errorsObj.display();
				} else {
					if(typeof callback_request == 'function') {
						if(typeof this.response == 'object') {
							this.response.length = this.response.jlength();
						}
						return callback_request(this.response);
					} else {
						return this.response;
					}
				}
			} else {
				return {};
			}
		};
		this.xhr.send(data_request);
	};
	
	this.json = function(url, data, callback, errorsObject) {
		var url_request;
		var data_request = 'is_ajax=true';
		var callback_request;
		if(typeof url == 'object') {
			url_request = is_url(url.url) ? url.url : url.jlink();
			data_request += '&'+url.data.jToString(true);
			if(typeof url.callback == 'function') {
				callback_request = url.callback;
			}
			if(typeof url.errorsObject != 'undefined') {
				errorsObj = url.errorsObject;
			}
		} else {
			url_request = is_url(url) ? url : url.jlink();
			if(typeof data == 'object') {
				data_request += '&'+data.jToString(true);
			} else {
				data_request += '&'+data;
			}
			if(typeof callback == 'function') {
				callback_request = callback;
			}
			if(typeof callback == 'undefined' && typeof data == 'function') {
				callback_request = data;
			}
			if(typeof errorsObject != 'undefined') {
				errorsObj = errorsObject;
			}
		}
		this.xhr.responseType = 'json';
		this.xhr.open('POST', url_request, true);
		this.xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		this.xhr.onload  = function(e) {
			if(this.status == 200) {
				if(this.response.status == 200) {
					if(typeof callback_request == 'function') {
						if(typeof this.response == 'object') {
							this.response.response.length = this.response.response.jlength();
						}
						return callback_request(this.response.response);
					} else {
						return this.response;
					}
				} else if(this.response.status == 500) {
					for(var error of this.response.response) {
						errorsObj.addError(error);
					}
					errorsObj.display();
				}
			} else {
				return {};
			}
		};
		this.xhr.send(data_request);
	};
	
	this.formData = function(url, data, callback, errorsObject, responseType) {
		var url_request;
		var data_request;
		var callback_request = {};
		var errorsObj = null;
		if(typeof url == 'object') {
			url_request = is_url(url.url) ? url.url : url.jlink();
			data_request = url.data;
			if(typeof url.callback == 'function') {
				callback_request.onload = url.callback;
			}
			if(typeof url.callback == 'object') {
				callback_request = url.callback;
			}
			if(typeof url.errorsObject != 'undefined') {
				errorsObj = url.errorsObject;
			}
		} else {
			url_request = is_url(url) ? url : url.jlink();
			data_request = data;
			if(typeof callback == 'function') {
				callback_request.onload = callback;
			}
			if(typeof callback == 'object') {
				callback_request = callback;
			}
			if(typeof callback == 'undefined' && typeof data == 'function') {
				callback_request = data;
			}
			if(typeof errorsObject != 'undefined') {
				errorsObj = errorsObject;
			}
		}
		if(typeof data_request == 'object') {
			data_request.append('is_ajax', true);
		}
		if(typeof responseType == 'undefined' || responseType != 'html') {
			this.xhr.responseType = 'json';
		}
		this.xhr.open('POST', url_request, true);
		this.xhr.onload  = function(e) {
			if(this.status == 200) {
				if(typeof this.response.status != 'undefined') {
					if(this.response.status == 200) {
						if(typeof callback_request.onload == 'function') {
							if(typeof this.response == 'object') {
								this.response.length = this.response.jlength();
							}
							return callback_request.onload(this.response.response, this.response.action);
						} else {
							return this.response;
						}
					} else if(this.response.status == 500) {
						for(var error of this.response.response) {
							errorsObj.addError(error);
						}
						errorsObj.display();
					} 
				} else if(responseType != 'undefined' || responseType == 'html') {
					if(typeof callback_request.onload == 'function') {
						if(typeof this.response == 'object') {
							this.response.length = this.response.jlength();
						}
						return callback_request.onload(this.response);
					} else {
						return this.response;
					}
				}
			} else {
				return this.response;
			}
		};
		if(typeof callback_request.onstart == 'function') {
			this.xhr.onstart = function() {
				return callback_request.onload(this.response);
			};
		}
		this.xhr.send(data_request);
	};
	
	this.blob = function(url, data, callback, errorsObject) {
		var url_request;
		var callback_request = {};
		if(typeof url == 'object') {
			url_request = is_url(url.url) ? url.url : url.jlink();
			if(typeof url.callback == 'function') {
				callback_request.onload = url.callback;
			} else if(typeof url.callback == 'object') {
				callback_request = url.callback;
			}
			if(typeof url.errorsObject != 'undefined') {
				errorsObj = url.errorsObject;
			}
		} else {
			url_request = is_url(url) ? url : url.jlink();
			if(typeof callback == 'function') {
				callback_request.onload = callback;
			} else if(typeof callback == 'object') {
				callback_request = callback;
			}
			if(typeof callback == 'undefined' && typeof data == 'function') {
				callback_request.onload = data;
			}
			if(typeof errorsObject != 'undefined') {
				errorsObj = errorsObject;
			}
		}
		if(typeof data == 'object') {
			data.append('is_ajax', true);
		}
		this.xhr.responseType = 'json';
		this.xhr.open('POST', url_request, true);
		this.xhr.onload  = function(e) {
			if(this.status == 200) {
				if(this.response.status == 200) {
					if(typeof callback_request.onload == 'function') {
						if(typeof this.response == 'object') {
							this.response.length = this.response.jlength();
						}
						return callback_request.onload(this.response);
					} else {
						return this.response;
					}
				} else if(this.response.status == 500) {
					for(var error of this.response.response) {
						errorsObj.addError(error);
					}
					errorsObj.display();
				}
			} else {
				return {};
			}
		};
		if(typeof callback_request.onstart == 'function') {
			this.xhr.onstart = function() {
				return callback_request.onload(this.response);
			};
		}
		this.xhr.send(data);
	};
};

////////////////////
//Function select all checkboxes
////////////////////

function ChecktAll(check) 
{
	var tab = document.getElementsByTagName("input"); 
	
	for (var i = 0; i < tab.length; i++) 
	{ 
		if (tab[i].name == "check_all[]" || tab[i].id == "check_all")
		tab[i].checked = check.checked;
	}
}

////////////////////////////////
//Fonction affichage du nom d'entreprise et siret pour les professionnel
////////////////////////////////

function GetPro(val, comp_name, comp_num, act_comp_num)
{
	if (val == 2 && act_comp_num == 0) document.getElementById('get_pro').innerHTML = '<input type="text" id="comp_name" class="short" name="comp_name" placeholder="'+ comp_name +'" value="">';
	
	else if (val == 2 && act_comp_num == 1) document.getElementById('get_pro').innerHTML = '<input type="text" id="comp_name" class="short" name="comp_name" placeholder="'+ comp_name +'" value="">' +
	' <input type="text" id="comp_num" class="short" name="comp_num" placeholder="'+ comp_num +'" value="">';
	
	else document.getElementById('get_pro').innerHTML = '';
}

////////////////////////////////
//Function to display select of counties
////////////////////////////////

function GetCounties() 
{
	var get_counties = document.getElementById('get_counties');
	var value_county = document.getElementById('county').value;
	var xhr_object = null;

	if (window.XMLHttpRequest) 
		xhr_object = new XMLHttpRequest();
		
	else if (window.ActiveXObject) 
		xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
		
	else 
	{
		alert("Your browser does not support some applications of our website, please change browser to use our website.");
		return;
	}
	
	if(value_county == 'geoloc_search')
	{
		xhr_object.open("POST", BASEURL +"/includes/display/search_geolocation.php", true);
	
		xhr_object.onreadystatechange = function() 
		{
			if (xhr_object.readyState == 4) 
			{
				get_counties.innerHTML = xhr_object.responseText;
			}
		}
	
		xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "county=" + value_county;
		xhr_object.send(data);	
	}
	else
	{
		xhr_object.open("POST", BASEURL +"/includes/display/search_counties.php", true);
	
		xhr_object.onreadystatechange = function() 
		{
			if (xhr_object.readyState == 4) 
			{
				get_counties.innerHTML = xhr_object.responseText;
			}
		}
	
		xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var data = "county=" + value_county;
		xhr_object.send(data);	
	}	
}

////////////////////////////////
//Function to display calendar option
////////////////////////////////

function GetCalendar() 
{
	var cal_wrap = document.querySelector('.get-options-p-date');
	var options = document.getElementById('opt').value;
	var xhr_object = null;

	if (window.XMLHttpRequest) 
		xhr_object = new XMLHttpRequest();

	else if (window.ActiveXObject) 
		xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
		
	else 
	{
		alert("Votre navigateur ne prend pas en charge certaines applications de notre site internet, merci de changer de navigateur pour utiliser notre site.");
		return;
	}

	xhr_object.open("POST", BASEURL +"/includes/calendar/search_calendar.php", true);

	xhr_object.onreadystatechange = function() 
	{
		if (xhr_object.readyState == 4) 
		{
			if(xhr_object.responseText == 1)
			{
				$( "#start_date" ).datepicker({
					numberOfMonths: 1,
					minDate: 'today',
					onSelect: function(dateText) {
						$("#end_date").datepicker('option', 'minDate', dateText);		
					},
					onClose: function() {
						setTimeout(function() {$("#end_date").datepicker("show");}, 100);		
					}
				}); 
			 
				$( "#end_date" ).datepicker({
					numberOfMonths: 1,
					minDate: 'today'
				});	
				if(cal_wrap) {
					cal_wrap.style.display = 'block';
				}
			}
			else
			{
				if(cal_wrap) {
					cal_wrap.style.display = 'none';
					document.getElementById('start_date').value = '';
					document.getElementById('end_date').value = '';
				}
			}
		}
	}

	xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var data = "id_cat=" + options;
	xhr_object.send(data);
}

////////////////////////////////
//Function to display select of options
////////////////////////////////

function GetOptions() 
{
	var get_options = document.getElementById('get_options');
	var value_opt = document.getElementById('opt').value;
	var xhr_object = null;

	if (window.XMLHttpRequest) 
		xhr_object = new XMLHttpRequest();
		
	else if (window.ActiveXObject) 
		xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
		
	else 
	{
		alert("Your browser does not support some applications of our website, please change browser to use our website.");
		return;
	}

	xhr_object.open("POST", BASEURL +"/includes/display/search_options.php", true);

	xhr_object.onreadystatechange = function() 
	{
		if (xhr_object.readyState == 4) 
		{
			get_options.innerHTML = xhr_object.responseText;
			manage_more_button();
		}
	}

	xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var data = "opt=" + value_opt;
	xhr_object.send(data);
}

////////////////////////////////
//Function to display select of options child for the deposit form
////////////////////////////////

function GetOptionsChild(val) 
{
	var options_child_form = document.getElementById('options_child_form_'+ val);
	var value_opt_child = document.getElementById('options_child_'+ val).value;
	var xhr_object = null;

	if (window.XMLHttpRequest) 
		xhr_object = new XMLHttpRequest();
		
	else if (window.ActiveXObject) 
		xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
		
	else 
	{
		alert("Your browser does not support some applications of our website, please change browser to use our website.");
		return;
	}

	xhr_object.open("POST", BASEURL +"/includes/display/search_options_child.php", true);

	xhr_object.onreadystatechange = function() 
	{
		if (xhr_object.readyState == 4) 
		{
			options_child_form.innerHTML = xhr_object.responseText;
		}
	}

	xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var data = 'options_child_'+ val + '=' + value_opt_child;
	xhr_object.send(data);
}

////////////////////////////////
//Function to display select of counties for form
////////////////////////////////

function DisplayCounties()
{
	var display_counties = document.getElementById('display_counties');
	var value_county = document.getElementById('form_county').value;
	var xhr_object = null;

	if (window.XMLHttpRequest) 
		xhr_object = new XMLHttpRequest();
		
	else if (window.ActiveXObject) 
		xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
		
	else 
	{
		alert("Your browser does not support some applications of our website, please change browser to use our website.");
		return;
	}

	xhr_object.open("POST", BASEURL +"/includes/display/form_counties.php", true);

	xhr_object.onreadystatechange = function() 
	{
		if (xhr_object.readyState == 4) 
		{
			display_counties.innerHTML = xhr_object.responseText;
		}
	}

	xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var data = "form_county=" + value_county;
	xhr_object.send(data);
}

////////////////////////////////
//Function to display select of options
////////////////////////////////

function DisplayPrice() 
{
	var display_price = document.getElementById('display_price');
	var value_price = document.getElementById('options').value;
	var xhr_object = null;

	if (window.XMLHttpRequest) 
		xhr_object = new XMLHttpRequest();

	else if (window.ActiveXObject) 
		xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
		
	else 
	{
		alert("Your browser does not support some applications of our website, please change browser to use our website.");
		return;
	}

	xhr_object.open("POST", BASEURL +"/includes/display/form_price.php", true);

	xhr_object.onreadystatechange = function() 
	{
		if (xhr_object.readyState == 4) 
		{
			display_price.innerHTML = xhr_object.responseText;
		}
	}

	xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var data = "options=" + value_price;
	xhr_object.send(data);
}

////////////////////////////////
//Function to display calendar option
////////////////////////////////

function DisplayCalendar() 
{
	var cal_wrap = document.getElementById('calendar-wrap');
	var options = document.getElementById('options').value;
	var xhr_object = null;

	if (window.XMLHttpRequest) 
		xhr_object = new XMLHttpRequest();

	else if (window.ActiveXObject) 
		xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
		
	else 
	{
		alert("Votre navigateur ne prend pas en charge certaines applications de notre site internet, merci de changer de navigateur pour utiliser notre site.");
		return;
	}

	xhr_object.open("POST", BASEURL +"/includes/calendar/form_calendar.php", true);

	xhr_object.onreadystatechange = function() 
	{
		if (xhr_object.readyState == 4) 
		{
			if(xhr_object.responseText == 1)
			{
				cal_wrap.style.display = 'block';
			}
			else
			{
				cal_wrap.style.display = 'none';
			}
		}
	}

	xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var data = "id_cat=" + options;
	xhr_object.send(data);
}

////////////////////////////////
//Function to display file option
////////////////////////////////

function DisplayFile() 
{
	var form_file_wrap = document.getElementById('upload_file_wrap');
	var options = document.getElementById('options').value;
	var xhr_object = null;

	if (window.XMLHttpRequest) 
		xhr_object = new XMLHttpRequest();

	else if (window.ActiveXObject) 
		xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
		
	else 
	{
		alert("Votre navigateur ne prend pas en charge certaines applications de notre site internet, merci de changer de navigateur pour utiliser notre site.");
		return;
	}

	xhr_object.open("POST", BASEURL +"/includes/display/form_file.php", true);

	xhr_object.onreadystatechange = function() 
	{
		if (xhr_object.readyState == 4) 
		{
			if(xhr_object.responseText == 1)
			{
				form_file_wrap.style.display = 'inline-block';
			}
			else
			{
				form_file_wrap.style.display = 'none';
			}
		}
	}

	xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var data = "id_cat=" + options;
	xhr_object.send(data);
}

////////////////////////////////
//Function to display select of options for the deposit form
////////////////////////////////

function DisplayOptions() 
{
	var options_form = document.getElementById('options_form');
	var value_opt = document.getElementById('options').value;
	var xhr_object = null;

	if (window.XMLHttpRequest) 
		xhr_object = new XMLHttpRequest();
		
	else if (window.ActiveXObject) 
		xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
		
	else 
	{
		alert("Your browser does not support some applications of our website, please change browser to use our website.");
		return;
	}

	xhr_object.open("POST", BASEURL +"/includes/display/form_options.php", true);

	xhr_object.onreadystatechange = function() 
	{
		if (xhr_object.readyState == 4) 
		{
			options_form.innerHTML = xhr_object.responseText;
		}
	}

	xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var data = "options=" + value_opt;
	xhr_object.send(data);
}

////////////////////////////////
//Function to display select of options child for the deposit form
////////////////////////////////

function DisplayOptionsChild(val) 
{
	var options_child_form = document.getElementById('options_child_form_'+ val);
	var value_opt_child = document.getElementById('options_child_'+ val).value;
	var xhr_object = null;

	if (window.XMLHttpRequest) 
		xhr_object = new XMLHttpRequest();
		
	else if (window.ActiveXObject) 
		xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
		
	else 
	{
		alert("Your browser does not support some applications of our website, please change browser to use our website.");
		return;
	}

	xhr_object.open("POST", BASEURL +"/includes/display/form_options_child.php", true);

	xhr_object.onreadystatechange = function() 
	{
		if (xhr_object.readyState == 4) 
		{
			options_child_form.innerHTML = xhr_object.responseText;
		}
	}

	xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var data = 'options_child_'+ val + '=' + value_opt_child;
	xhr_object.send(data);
}

////////////////////////////////
//Function to display the note of the deposit form
////////////////////////////////

function DisplayNote() 
{
	var note_form = document.getElementById('note');
	var value_opt = document.getElementById('options').value;
	var xhr_object = null;

	if (window.XMLHttpRequest) 
		xhr_object = new XMLHttpRequest();
		
	else if (window.ActiveXObject) 
		xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
		
	else 
	{
		alert("Your browser does not support some applications of our website, please change browser to use our website.");
		return;
	}

	xhr_object.open("POST", BASEURL +"/includes/display/form_note.php", true);

	xhr_object.onreadystatechange = function() 
	{
		if (xhr_object.readyState == 4) 
		{
			note_form.innerHTML = xhr_object.responseText;
		}
	}

	xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var data = "options=" + value_opt;
	xhr_object.send(data);
}

////////////////////////////////
//Function to display video
////////////////////////////////

function GetVideo(video)
{
	document.getElementById('video').innerHTML = '<iframe src="'+ video +'" border="0" frameborder="0" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true" allowtransparency="true"></iframe>';
}

////////////////////////////////
//Function credit page
////////////////////////////////

function changeCredit(price, credits, isField)
{
	if(price != '' && price > 0)
	{
		var price = price.replace(".",",");
		price = parseFloat(price);
		
		var credits = credits.replace(".",",");
		credits = parseFloat(credits);

		document.getElementById('select_credit').value = price;
		document.getElementById('total_credit').value = credits;	
	}	
			
	return false;
}

////////////////////
//Check if the string is valid url
////////////////////
function is_url(string) {
	try {
		new URL(string);
		return true;
	} catch (_) {
		return false;  
	}
}

////////////////////
//Oject.prototype function : Transform object to string param=value
////////////////////
function jToString(start) {
	var result = '';
	if(typeof this == 'object') {
		if(typeof start != 'undefined' && start === true) {
			result = '&';
		}
		for(var i in this) {
			if(typeof this[i] != 'undefined' && this[i] != null && (this[i].length > 0 || Number.isInteger(this[i]))) {
				result += i+'='+this[i]+'&';
			} else {
				result += i+'=&';
			}
		}
	} else {
		result = this;
	}
	return result.substr(-1) == '&' ? result.substr(0, (result.length - 1)) : result;	
};

////////////////////
//Oject.prototype function : Return object length
////////////////////
function jlength() {
	var length = 0;
	if(typeof this == 'object' && (typeof this.length == 'undefined' || this.length == 0)) {
		var length = 0;
		var keys = Object.keys(this);
		for(var i in keys) {
			if(i != 'length') {
				length++;
			}
		}
	} else if(typeof this == 'object' && typeof this.length != 'undefined') {
		length = this.length;
	}
	return length;
};

////////////////////
//Return the string after replace not authorized characters
////////////////////
String.prototype.cleanUrl = function() {
	var pattern = /[^a-zA-Z0-9_\-]/gi;
	return this.noAccent().replace(pattern, '-').replace(/ /g, '-').replace(/(-){2,}/, '-');
};

////////////////////
//Return the string after replace accents
////////////////////
String.prototype.noAccent = function() {
	var to_replace = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž';
	var replace = 'AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz';
	var string = this.split('');
    var strLen = string.length;
    var i, x;
	for (i = 0; i < strLen; i++) {
		if ((x = to_replace.indexOf(string[i])) != -1) {
		  string[i] = replace[x];
		}
	}
	return string.join('');
};
