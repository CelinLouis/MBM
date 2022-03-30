<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Makes "field" required and step of 10.</title>
<!--link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css"-->

</head>
<body>
<form id="myform" method="POST" >
<label for="field">Required, step 10: </label>
<input type="text" class="left" id="field" name="field">
<br/>

<label for="nom">nom: </label>
<input class="left" type="text" id="nom" name="nom">
<br/>

<label for="email">Email: </label>
<input class="left" type="email" id="email" name="email">
<br/>

<label for="phone">phone: </label>
<input type="number" name="phone" >
<br/>

<select id="select" name="select[]">
  <option value="choisir">-- choisir --</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</select>

<fieldset>
<input type="radio" name="myoptions[]" value="blue"> Blue<br />
<input type="radio" name="myoptions[]" value="red"> Red<br />
<input type="radio" name="myoptions[]" value="green"> Green<br />
<label for="myoptions[]" class="error" style="display:none;">Please choose one.</label>
</fieldset>

<input type="checkbox" name="test[]" />a
<input type="checkbox" name="test[]"  />b
<input type="checkbox" name="test[]" />c

<br>

<input id="btn_submitS" type="submit" value="Validate!">


</form>

<script src="js/jquery-3.1.1.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
$(document).ready(function(){
  jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});

 $.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg !== value;
 }, "choisir un nombre");
$.validator.addMethod(
  "regex",
   function(value, element, regexp) {
       if (regexp.constructor != RegExp)
          regexp = new RegExp(regexp);
       else if (regexp.global)
          regexp.lastIndex = 0;
          return this.optional(element) || regexp.test(value);
   },"erreur expression reguliere"
);

$("#myform").validate({
  rules: {
    field: {
      required: true,
      step: 10
    },
    nom: {
      required: true,
    },
    email: {
      required: true,
      email: true
    }
    ,
    select: { valueNotEquals: "choisir" },
    'myoptions[]':{ required:true },
    'test[]':{ required:true, maxlength:2 },
    'phone': {
        'required': true,
        'regex': /^(\+33\.|0)[0-9]{9}$/
    }
  },
  submitHandler: function(myform) {
            work();
        },
  messages: {
   nom: { required: "Entrer votre nom!" },
   'test[]': {
                required: "You must check at least 1 box",
                maxlength: "Check no more than {0} boxes"
            }
  }


});
});

function work()
{
  var an_souscat = $("input[name='select[]:selected']").val();
  alert("an_souscat");
}


$('#btn_submit').on('click',function(){
  $("#myform").valid();
});
</script>
</body>
</html>
