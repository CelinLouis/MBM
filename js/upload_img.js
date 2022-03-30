$(function(){
	var photos = new Array();
	$("#an_photo1").on("click", function(){
		photos[0] = $(this).val();
	});
	$("#an_photo2").on("change", function(){
		photos[1] = $(this).val();
	});
	$("#an_photo3").on("change", function(){
		photos[2] = $(this).val();
	});
	$("#an_photo4").on("change", function(){
		photos[3] = $(this).val();
	});
	$("#an_photo5").on("change", function(){
		photos[4] = $(this).val();
	});
	$("#an_photo6").on("change", function(){
		photos[5] = $(this).val();
	});
	$("#an_photo7").on("change", function(){
		photos[6] = $(this).val();
	});
	$("#an_photo8").on("change", function(){
		photos[7] = $(this).val();
	});

	for (var i = 0; i < photos.length; i++) {
		console.log(photos[i]);
	}
});