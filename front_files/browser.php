<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
</head>

<body>

<?php include(BASE_URL.'header.php'); ?>


<div id="main">

    <div class="container">


        <ol class="breadcrumb">
            <li>Browse Databases by Topics</li>
        </ol>
        <br>

        <ul class="hypeTopicUL">
            <li id="rnatype" class="hypeTopic"><h4>RNA Class</h4></li>
            <li id="searchmethod" class="hypeTopic"><h4>Search Method</h4></li>
            <li id="informationsource" class="hypeTopic"><h4>Information Source</h4></li>
            <li id="informationcontent" class="hypeTopic"><h4>Information Content</h4></li>
        </ul>


    </div> <!-- /container -->

</div>

<?php include(BASE_URL.'infoline.php'); ?>

<?php include(BASE_URL.'footer.php'); ?>


</body>
</html>
<script>
    $(document).ready(function() {
        $("#rnatype").click();
    });
var myElement;

    $(".hypeTopic").click(function(){
        var query = $(this).attr('id');
        myElement = $(this);

         $.ajax({
         url: './ajax/browser.php',
         type: 'GET',
         dataType: 'JSON',
         data: 'browser-ajax=' + query,
         success: function(data) {
            //console.log(data);
            //process(data);
            appendValuesBrowser(data);
         }
         });

    });


    //função que é chamada dentro do ajax, que da o append dos elementos li de baixo do outro li
    function appendValuesBrowser(data){

        $('.list_auto').remove();

        var ul = document.createElement('ul');
        $(ul).addClass('list_auto');
        $(ul).appendTo($(myElement));

        $.each(data, function(id, value) {
            var array = $.map(value, function(value, index) {
                return [value];

            });

            li = document.createElement('li');
            $(li).hide().appendTo($(ul)).fadeIn('normal');
            jQuery('<a/>', {
                href: './databaseslist.php?'+myElement.attr('id')+'[]='+array[0],
                text: array[1]
            }).appendTo($(li));

        });
    }


</script>
