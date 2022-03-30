$(function () {
//console.log("ok");
$(".option-1, .option-2, .option-3, .option-4, .option-5, .option-6, .option-7, .option-8, .option-9, .option-10, .option-11, .option-12, .option-13, .option-14, .option-15, .option-16, .option-17, .option-19, .option-21, .option-22, .option-23, .option-24, .option-25, .option-30, .option-31").attr("disabled", true).hide();


$("#options").on("change", function () {
  $(".option-1, .option-2, .option-3, .option-4, .option-5, .option-6, .option-7, .option-8, .option-9, .option-10, .option-11, .option-12, .option-13, .option-14, .option-15, .option-16, .option-17, .option-19, .option-21, .option-22, .option-23, .option-24, .option-25, .option-30, .option-31").attr("disabled", true).hide();
  $(".option-" + $(this).val()).attr("disabled", false).show();

  console.log($(this).val());
});

$.validator.addMethod(
  "valueNotEquals",
  function(value, element, arg){
    return arg !== value;
   },
  "choisir"
);

$.validator.addMethod(
  "regex",
  function(value, element, regexp) {
      if (regexp.constructor != RegExp)
          regexp = new RegExp(regexp);
      else if (regexp.global)
          regexp.lastIndex = 0;
      return this.optional(element) || regexp.test(value);
  },
  "erreur expression reguliere"
);

$('#file_1').on('change', function(){
      var file_data = $('#file_1').prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      $.ajax({
          url: 'an_upload_image.php',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(data){
              if (data == 0) {
                $('#err_depot_1').fadeIn(1000).show();
                setTimeout(function()
                    {
                      $('#imgload_1').attr('src',"");attr('src',"");
                    }, 1000);
              }
              else
              {
                setTimeout(function()
                    {
                       $("#imgshow_1").attr('src',""+data+"");
                    }, 2000);
                    setTimeout(function()
                    {
                      $("#photo1").val(data);
                      $("#imgload_1").attr('src',"");
                      $('#imgdel_1').show();
                    }, 1000);
              }
          }
       });
    });
    $('#file_2').on('change', function(){
      var file_data = $('#file_2').prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      $.ajax({
          url: 'an_upload_image.php',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(data){

                  if (data == 0) {
                $('#err_depot_1').fadeIn(1000).show();
                setTimeout(function()
                    {
                      $('#imgload_2').attr('src',"");
                    }, 1000);
              }
              else
              {
                setTimeout(function()
                    {
                       $("#imgshow_2").attr('src',""+data+"");
                    }, 2000);
                    setTimeout(function()
                    {
                      $("#photo2").val(data);
                      $("#imgload_2").attr('src',"");
                      $('#imgdel_2').show();
                    }, 1000);
              }
          }
       });
    });
    $('#file_3').on('change', function(){
      var file_data = $('#file_3').prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      $.ajax({
          url: 'an_upload_image.php',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(data){
              if (data == 0) {
                  $('#err_depot_1').fadeIn(1000).show();
                  setTimeout(function()
                      {
                        $('#imgload_3').attr('src',"");
                      }, 1000);
                }
                else
                {
                setTimeout(function()
                    {
                       $("#imgshow_3").attr('src',""+data+"");
                    }, 2000);
                    setTimeout(function()
                    {
                      $("#photo3").val(data);
                      $("#imgload_3").attr('src',"");
                      $('#imgdel_3').show();
                    }, 1000);
                }
          }
       });
    });
    $('#file_4').on('change', function(){
      var file_data = $('#file_4').prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      $.ajax({
          url: 'an_upload_image.php',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(data){
              if (data == 0) {
                $('#err_depot_1').fadeIn(1000).show();
                setTimeout(function()
                    {
                      $('#imgload_4').attr('src',"");
                    }, 1000);
              }
              else
              {
                setTimeout(function()
                    {
                       $("#imgshow_4").attr('src',""+data+"");
                    }, 2000);
                    setTimeout(function()
                    {
                      $("#photo4").val(data);
                      $("#imgload_4").attr('src',"");
                      $('#imgdel_4').show();
                    }, 1000);
                }
          }
       });
    });
    $('#file_5').on('change', function(){
      var file_data = $('#file_5').prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      $.ajax({
          url: 'an_upload_image.php',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(data){
              if (data == 0) {
                $('#err_depot_1').fadeIn(1000).show();
                setTimeout(function()
                    {
                      $('#imgload_5').attr('src',"");
                    }, 1000);
              }
              else
              {
                setTimeout(function()
                    {
                       $("#imgshow_5").attr('src',""+data+"");
                    }, 2000);
                    setTimeout(function()
                    {
                      $("#photo5").val(data);
                      $("#imgload_5").attr('src',"");
                      $('#imgdel_5').show();
                    }, 1000);
                }
          }
       });
    });
    $('#file_6').on('change', function(){
      var file_data = $('#file_6').prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      $.ajax({
          url: 'an_upload_image.php',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(data){
              if (data == 0) {
                $('#err_depot_1').fadeIn(1000).show();
                setTimeout(function()
                    {
                      $('#imgload_6').attr('src',"");
                    }, 1000);
              }
              else
              {
                setTimeout(function()
                    {
                       $("#imgshow_6").attr('src',""+data+"");
                    }, 2000);
                    setTimeout(function()
                    {
                      $("#photo6").val(data);
                      $("#imgload_6").attr('src',"");
                      $('#imgdel_6').show();
                    }, 1000);
                }
          }
       });
    });
    $('#file_7').on('change', function(){
      var file_data = $('#file_7').prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      $.ajax({
          url: 'an_upload_image.php',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(data){
              if (data == 0) {
                $('#err_depot_1').fadeIn(1000).show();
                setTimeout(function()
                    {
                      $('#imgload_7').attr('src',"");
                    }, 1000);
              }
              else
              {
                setTimeout(function()
                    {
                       $("#imgshow_7").attr('src',""+data+"");
                    }, 2000);
                    setTimeout(function()
                    {
                      $("#photo7").val(data);
                      $("#imgload_7").attr('src',"");
                      $('#imgdel_7').show();
                    }, 1000);
                }
          }
       });
    });
    $('#file_8').on('change', function(){
      var file_data = $('#file_8').prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      $.ajax({
          url: 'an_upload_image.php',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(data){
              if (data == 0) {
                $('#err_depot_1').fadeIn(1000).show();
                setTimeout(function()
                    {
                      $('#imgload_8').hide();
                    }, 1000);
              }
              else
              {
                setTimeout(function()
                    {
                       $("#imgshow_8").attr('src',""+data+"");
                    }, 2000);
                    setTimeout(function()
                    {
                      $("#photo8").val(data);
                      $("#imgload_8").attr('src',"");
                      $('#imgdel_8').show();
                    }, 1000);
                }
          }
       });
    });

$("#form_dep_annonce").validate({
  highlight: function(element) {
    $(element).parents('.form').addClass('error');
  },
  unhighlight: function(element) {
    $(element).parents('.form').removeClass('error');
  },
  rules: {
    'an_souscat[]': {
      valueNotEquals: "0"
    },
    an_kmeterv: {
      required: true
    },
    an_kmeterm: {
      required: true
    },
    an_kmeterc: {
      required: true
    },
    'an_anneev[]': {
      valueNotEquals: "0"
    },
    'an_anneem[]': {
      valueNotEquals: "0"
    },
    'an_anneec[]': {
      valueNotEquals: "0"
    },
    'an_energyv[]': {
      valueNotEquals: "0"
    },
    'an_energyc[]': {
      valueNotEquals: "0"
    },
    'an_vitessev[]': {
      valueNotEquals: "0"
    },
    an_cylinder: {
      required: true
    },
    'an_vitessec[]': {
      valueNotEquals: "0"
    },
    an_surfacevm: {
      required: true
    },
    an_surfacelm: {
      required: true
    },
    an_surfacet: {
      required: true
    },
    an_surfacelv: {
      required: true
    },
    an_surfacecll: {
      required: true
    },
    an_surfaceg: {
      required: true
    },
    an_surfacel: {
      required: true
    },
    an_surfacebc: {
      required: true
    },
    an_piecevm: {
      required: true
    },
    an_piecelm: {
      required: true
    },
    an_piececl: {
      required: true
    },
    an_piecelv: {
      required: true
    },
    an_piecel: {
      required: true
    },
    an_piecebc: {
      required: true
    },
    an_capacityvm: {
      required: true
    },
    an_capacitylm: {
      required: true
    },
    an_capacitycl: {
      required: true
    },
    an_capacitylv: {
      required: true
    },
    an_debutlv: {
      required: true
    },
    an_finlv: {
      required: true
    },
    'an_genref[]': {
      valueNotEquals: "0"
    },
    'an_genrem[]': {
      valueNotEquals: "0"
    },
    an_nombref: {
      required: true
    },
    an_nombrem: {
      required: true
    },
    'an_temploi[]': {
      valueNotEquals: "0"
    },
    'an_tcours[]': {
      valueNotEquals: "0"
    },
    'an_cporte[]': {
      valueNotEquals: "0"
    },
    'an_tporte[]': {
      valueNotEquals: "0"
    },
    'an_pporte[]': {
      valueNotEquals: "0"
    },
    'an_cmonbij[]': {
      valueNotEquals: "0"
    },
    'an_mmonbij[]': {
      valueNotEquals: "0"
    },
    'an_pmonbij[]': {
      valueNotEquals: "0"
    },
    'an_imgson[]': {
      valueNotEquals: "0"
    },
    'an_info[]': {
      valueNotEquals: "0"
    },
    'an_tel[]': {
      valueNotEquals: "0"
    },
    'an_jeu[]': {
      valueNotEquals: "0"
    },
    'an_type[]': {
      required: true
    },
    'an_etat[]': {
      valueNotEquals: "0"
    },
    an_title: {
      required: true
    },
    an_desc: {
      required: true
    },
    an_price : {
      required: true
    },
    'an_region[]': {
      required: true
    },
    an_cond:{
      required :true
    }
  },
  messages:{
    'an_souscat[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir une catégorie.</span>"
    },
    'an_energyv[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir le carburant.</span>"
    },
    'an_energyc[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir le carburant.</span>"
    },
    'an_vitessev[]' :{
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir la boîte de vitesse..</span>"
    },
    'an_vitessec[]' :{
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir la boîte de vitesse..</span>"
    },
    'an_type[]': {
            required: "<span style=\"color: red;\"> * Veuillez indiquer le type de votre annonce.</span>"
        },
        'an_region[]': {
      required: "<span style=\"color: red;\"> * Veuillez choisir votre région.</span>"
    },
    'an_anneev[]':{
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir l'année-modèle.</span>"
    },
    'an_anneem[]':{
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir l'année-modèle.</span>"
    },
    'an_anneec[]':{
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir l'année-modèle.</span>"
    },
    an_kmeterv: {
      required: "<span style=\"color: red;\"> * Veuillez inserez le kilometrage de votre voiture.</span>"
    },
    an_kmeterm: {
      required: "<span style=\"color: red;\"> * Veuillez inserez le kilometrage de votre moto.</span>"
    },
    an_kmeterc: {
      required: "<span style=\"color: red;\"> * Veuillez inserez le kilometrage de votre camping car.</span>"
    },
    'an_genref[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir le genre des films.</span>"
    },
    'an_genrem[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir le genre des musiques.</span>"
    },
    an_nombref: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer le nombre des films.</span>"
    },
    an_nombrem: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer le nombre des musiques.</span>"
    },
    an_surfacevm: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer la surface de la maison.</span>"
    },
    an_surfacelm: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer la surface de la maison.</span>"
    },
    an_surfacet: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer la surface du terrain.</span>"
    },
    an_surfacelv: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer la surface de la maison.</span>"
    },
    an_surfacecll: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer la surface de la maison.</span>"
    },
    an_surfaceg: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer la surface du garage.</span>"
    },
    an_surfacel: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer la surface du locaux.</span>"
    },
    an_surfacebc: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer la surface du bureau.</span>"
    },
    an_piecevm: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer le nombre de piece dans la maison.</span>"
    },
    an_piecelm: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer le nombre de piece dans la maison.</span>"
    },
    an_piececl: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer le nombre de piece dans la maison.</span>"
    },
    an_piecelv: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer le nombre de piece dans la maison.</span>"
    },
    an_piecel: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer le nombre de piece dans la maison.</span>"
    },
    an_piecebc: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer le nombre de piece dans la maison.</span>"
    },
    an_capacityvm: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer la capacite de la maison.</span>"
    },
    an_capacitylm: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer la capacite de la maison.</span>"
    },
    an_capacitycl: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer la capacite de la maison.</span>"
    },
    an_capacitylv: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer la capacite de la maison.</span>"
    },
    an_debutlv: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer le debut du location.</span>"
    },
    an_finlv: {
      required: "<span style=\"color: red;\"> * Veuillez indiquer la fin du location.</span>"
    },
    'an_temploi[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir le type d'emploi.</span>"
    },
    'an_tcours[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir le type du cours.</span>"
    },
    'an_cporte[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir la qualite.</span>"
    },
    'an_tporte[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir une option.</span>"
    },
    'an_pporte[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir une option.</span>"
    },
    'an_cmonbij[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir une option.</span>"
    },
    'an_mmonbij[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir le matiere.</span>"
    },
    'an_pmonbij[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir une option.</span>"
    },
    'an_imgson[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir une option.</span>"
    },
    'an_info[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir une option.</span>"
    },
    'an_tel[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir une option.</span>"
    },
    'an_jeu[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir une option.</span>"
    },
    'an_etat[]': {
      valueNotEquals: "<span style=\"color: red;\"> * Veuillez choisir etat de votre annonce.</span>"
    },
        an_title: {
          required: "<span style=\"color: red;\"> * Veuillez inserez du titre a votre annonce.</span>"
        },
        an_desc: {
          required: "<span style=\"color: red;\"> * Veuillez inserez une description pour votre annonce.</span>"
        },
        an_price : {
      required: "<span style=\"color: red;\"> * Veuillez inserez le prix.</span>"
    },
    an_cond:{
      required :"<span style=\"color: red;\"> * Accepteriez vous nos conditions et règlements ?</span>"
    }
  },
  submitHandler: function(form) {
        post_annonce();
    }
});

$('#btn_submit_annonce').click(function() {
        $("#form_dep_annonce").valid();
    });

function post_annonce(){
  //e.preventDefault();

  /*var an_nom =  $("#an_nom").val();
  var an_email = $("#an_email").val();
  var an_password = $("#an_password").val();
  var an_conf_password = $("#an_conf_password").val();*/
  var id_membres = $("#iduser").val();
  var an_souscat = $("#options").val();
  var an_marquev = $("#an_marquev").val();
  var	an_anneev = $("#an_anneev").val();
  var an_kmeterv = $("#an_kmeterv").val();
  var an_energyv = $("#an_energyv").val();
  var an_vitessev = $("#an_vitessev").val();
  var an_kmeterm = $("#an_kmeterm").val();
  var an_anneem = $("#an_anneem").val();
  var an_cylinder = $("#an_cylinder").val();
  var an_kmeterc = $("#an_kmeterc").val();
  var an_anneec = $("#an_anneec").val();
  var an_energyc = $("#an_energyc").val();
  var an_vitessec = $("#an_vitessec").val();
  var an_surfacevm = $("#an_surfacevm").val();
  var an_piecevm = $("#an_piecevm").val();
  var an_capacityvm = $("#an_capacityvm").val();
  var an_surfacelm = $("#an_surfacelm").val();
  var an_piecelm = $("#an_piecelm").val();
  var an_capacitylm = $("#an_capacitylm").val();
  var an_surfacet = $("#an_surfacet").val();
  var an_surfacecl = $("#an_surfacecl").val();
  var an_piececl = $("#an_piececl").val();
  var an_capacitycl = $("#an_capacitycl").val();
  var an_debutlv = $("#an_debutlv").val();
  var an_finlv = $("#an_finlv").val();
  var an_surfacelv = $("#an_surfacelv").val();
  var an_piecelv = $("#an_piecelv").val();
  var an_capacitylv = $("#an_capacitylv").val();
  var an_surfacel = $("#an_surfacel").val();
  var an_piecel = $("#an_piecel").val();
  var an_surfaceg = $("#an_surfaceg").val();
  var an_surfacebc = $("#an_surfacebc").val();
  var an_piecebc = $("#an_piecebc").val();
  var an_temploi = $("#an_temploi").val();
  var an_tcours = $("#an_tcours").val();
  var an_cporte = $("#an_cporte").val();
  var an_tporte = $("#an_tporte").val();
  var an_pporte = $("#an_pporte").val();
  var an_cmonbij = $("#an_cmonbij").val();
  var an_mmonbij = $("#an_mmonbij").val();
  var an_pmonbij = $("#an_pmonbij").val();
  var an_imgson = $("#an_imgson").val();
  var an_info = $("#an_info").val();
  var an_tel = $("#an_tel").val();
  var an_jeu = $("#an_jeu").val();
  var an_genref = $("#an_genref").val();
  var an_nombref = $("#an_nombref").val();
  var an_genrem = $("#an_genrem").val();
  var an_nombrem = $("#an_nombrem").val();
  var an_etat = $("#an_etat").val();
  var an_type = $("input[name='an_type[]']:checked").val();
  var an_title = $("#an_title").val();
  var an_desc = $("#an_desc").val();
  var an_price = $("#an_price").val();
  var an_region = $("#an_region").val();
  var an_city = $("#an_city").val();
  var an_postcode = $("#an_postcode").val();
  var an_address = $("#an_address").val();
  var an_cond = $("#an_cond").val();
  var an_photo1 =  $("#photo1").val();
  var an_photo2 =  $("#photo2").val();
  var an_photo3 =  $("#photo3").val();
  var an_photo4 =  $("#photo4").val();
  var an_photo5 =  $("#photo5").val();
  var an_photo6 =  $("#photo6").val();
  var an_photo7 =  $("#photo7").val();
  var an_photo8 =  $("#photo8").val();

  if($.trim($('#photo1').val()) == "" && $.trim($('#photo2').val()) == "" && $.trim($('#photo3').val()) == ""
  && $.trim($('#photo4').val()) == "" && $.trim($('#photo5').val()) == "" && $.trim($('#photo6').val()) == ""
  && $.trim($('#photo7').val()) == "" && $.trim($('#photo8').val()) == "")
  {
    an_photo1 = "images/no_photo1.png";
  }

  //alert(id_membres);

  swal({
          background:'purple',
          title: "",
          text: "Voulez vous vraiement ajouter cette annonce? ",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: false,
          cancelButtonClass: 'btn-danger',
          cancelButtonText: 'Non',
          confirmButtonText: 'Oui',
          confirmButtonClass: "btn-primary",
          showLoaderOnConfirm: true
          }, function () {
            $.post('ajax/post_annonce.php', {

      id_membres : id_membres,
      an_souscat : an_souscat,
      an_marquev : an_marquev,
      an_anneev : an_anneev,
      an_kmeterv : an_kmeterv,
      an_energyv : an_energyv,
      an_vitessev : an_vitessev,
      an_kmeterm : an_kmeterm,
      an_anneem : an_anneem,
      an_cylinder : an_cylinder,
      an_kmeterc : an_kmeterc,
      an_anneec : an_anneec,
      an_energyc: an_energyc,
      an_vitessec : an_vitessec,
      an_surfacevm : an_surfacevm,
      an_piecevm : an_piecevm,
      an_capacityvm : an_capacityvm,
      an_surfacelm : an_surfacelm,
      an_piecelm : an_piecelm,
      an_capacitylm : an_capacitylm,
      an_surfacet : an_surfacet,
      an_surfacecl : an_surfacecl,
      an_piececl : an_piececl,
      an_capacitycl : an_capacitycl,
      an_debutlv : an_debutlv,
      an_finlv : an_finlv,
      an_surfacelv : an_surfacelv,
      an_piecelv  : an_piecelv,
      an_capacitylv  : an_capacitylv,
      an_surfacel  : an_surfacel,
      an_piecel : an_piecel,
      an_surfaceg  : an_surfaceg,
      an_surfacebc  : an_surfacebc,
      an_piecebc  : an_piecebc,
      an_temploi : an_temploi,
      an_tcours : an_tcours,
      an_cporte : an_cporte,
      an_tporte : an_tporte,
      an_pporte : an_pporte,
      an_cmonbij : an_cmonbij,
      an_mmonbij : an_mmonbij,
      an_pmonbij : an_pmonbij,
      an_imgson : an_imgson,
      an_info : an_info,
      an_tel : an_tel,
      an_jeu : an_jeu,
      an_genref : an_genref,
      an_nombref : an_nombref,
      an_genrem : an_genrem,
      an_nombrem : an_nombrem,
      an_etat : an_etat,
      an_type : an_type,
      an_title : an_title,
      an_desc : an_desc,
      an_price : an_price,
      an_region : an_region,
      an_city : an_city,
      an_postcode : an_postcode,
      an_address : an_address,
      an_cond : an_cond,
      an_photo1 : an_photo1,
      an_photo2 : an_photo2,
      an_photo3 : an_photo3,
      an_photo4 : an_photo4,
      an_photo5 : an_photo5,
      an_photo6 : an_photo6,
      an_photo7 : an_photo7,
      an_photo8 : an_photo8

              },
              function(data) {

                  if (data= "inserted") {
                    setTimeout(function()
                    {
                       swal({
                              title: "",
                              text: "Votre annonce a été publié avec succès!",
                              type: "success"
                          }, function() {
                            window.location.href = "index.php";
                        });

                    }, 500);
                  }



                  },
              'text');
        });

}


});
