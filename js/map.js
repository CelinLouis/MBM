///////////////////////////////////////////////////////////////////////////////////////////
///Script PHP/MYSQL of management of classifieds ads developed by Script PAG
///Script PAG all rights reserved. Use under license. http://www.script-pag.com
///////////////////////////////////////////////////////////////////////////////////////////

//############################################################

var currentMousePos = { x: -1, y: -1 };

$(function()
{	
	var window_width = $( window ).width();
	
	$('#Map .regions').hover(function() 
  	{
	  	if(window_width > 768)
	  	{
			var reg_name = $(this).attr('data-name');
			var reg_count = $(this).attr('data-ann-count');		
			
			if(typeof reg_name !== "undefined")
			{
				$("#tooltip .tx_reg_tooltip").html(reg_name);
				$("#tooltip .tx_tooltip_nb").html(reg_count);
				
				display_tooltip();
				$("#tooltip").show();
			} 	
	  	}
	  	else
	  	{
		  	var reg_link = $(this).attr('data-link');
		  	$(location).attr('href',reg_link);
	  	}
		
	}, function()
	{
		$("#tooltip").hide();
	});
	
	$('#Map .regions').click( function()
	{
		var reg_link = $(this).attr('data-link');
		$(location).attr('href',reg_link);
	});
	
	if($("#Map").length > 0)
	{
		$("body").prepend($("#tooltip"));   
	}
	
	function display_tooltip()
	{
		var tooltip_height = $("#tooltip").height();
		var cursor_top = currentMousePos.y;
		var cursor_left = currentMousePos.x;
		
		$("#tooltip").css('top', (cursor_top - tooltip_height - 65)+'px');
		$("#tooltip").css('left', (cursor_left - 35)+'px');
	}
	
	$('#Map').mousemove(function(event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
        display_tooltip();
    });
    
    $("#Map .regions")
		.mouseenter(function() {
			
			var fill_over = $(this).attr("data-fillover");
			var path_parent = $(this).parent();
		  	var path_parent_id = $(this).parent().attr("id");
		  	
		  	if(path_parent.is( "g" ) && path_parent_id != "Map"){			  	
			  	path_parent.find(".regions").css("fill", fill_over);
		  	}
		  	else{			  		  	
			  	$(this).css("fill", fill_over);
		  	}		  	
		})
		.mouseleave(function() {
		  	var fill_out = $(this).attr("data-fillout");
		  	
		  	var path_parent = $(this).parent();
		  	var path_parent_id = $(this).parent().attr("id");
		  	
		  	if(path_parent.is( "g" ) && path_parent_id != "Map"){			  	
			  	path_parent.find(".regions").css("fill", fill_out);
		  	}
		  	else{			  		  	
			  	$(this).css("fill", fill_out);
		  	}		  	
		});
    
    $("#regions_list li a")
		.mouseenter(function() {
			var id_reg_link = $(this).attr("data-id");
		  	var fill_over = $("#Map .reg_" + id_reg_link).attr("data-fillover");
		  	
		  	$("#Map .reg_" + id_reg_link).css("fill", fill_over);
		})
		.mouseleave(function() {
			var id_reg_link = $(this).attr("data-id");
		  	var fill_out = $("#Map .reg_" + id_reg_link).attr("data-fillout");
		  	
		  	$("#Map .reg_" + id_reg_link).css("fill", fill_out);
		});
});


var map = document.querySelector(".map-svg");
var paths = map.querySelectorAll(".regions"); 
//var links = map.querySelectorAll("#regions_list a");
paths.forEach(function(path){
	path.addEventlistner('mouseenter', function(e){
		console.log("ok");
	});
});