<?php require "include/header.php"; ?>
<title>Liste tous les annonces</title>
<div class="container-100 header-end"></div>

<div class="container-100" style="">
        <div class="container-100-child index-container">
		    <?php require "include/search_form.php"; ?>
	    </div>
</div>

<?php require "include/footer.php"; ?>
<script>


$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var type = get_filter('type');
        var title = get_filter('title');
        var region = get_filter('region');
        var categorie = get_filter('categorie');
        var recherche = $('#keywords').val();
        var postal = $('#an_code_p').val();
        $.ajax({
            url:"fetch_data1.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, type:type, region:region , categorie:categorie, recherche:recherche, postal:postal, title:title},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });

        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#keywords').keyup(function(){
                filter_data();
            });
    $('#an_code_p').keyup(function(){
                filter_data();
            });

    $('#price_range').slider({
        range:true,
        min:1000,
        max:1000000,
        values:[1000, 1000000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });
   

});
</script>