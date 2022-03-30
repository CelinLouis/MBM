$(function(){
	$(".option-1, .option-2, .option-3, .option-4, .option-5, .option-6, .option-7, .option-8, .option-9, .option-10, .option-11, .option-12, .option-13, .option-14, .option-15, .option-16, .option-17, .option-19, .option-21, .option-22, .option-23, .option-24, .option-25, .option-30, .option-31").attr("disabled", true).hide();

	$("#options").on("change", function () {
  		$(".option-1, .option-2, .option-3, .option-4, .option-5, .option-6, .option-7, .option-8, .option-9, .option-10, .option-11, .option-12, .option-13, .option-14, .option-15, .option-16, .option-17, .option-19, .option-21, .option-22, .option-23, .option-24, .option-25, .option-30, .option-31").attr("disabled", true).hide();

  		$(".option-" + $(this).val()).attr("disabled", false).show();
  	});	
});