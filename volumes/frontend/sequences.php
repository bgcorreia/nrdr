<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
</head>

<body>

<?php include(BASE_URL . 'header.php'); ?>


<div id="main">

    <div class="container">
        
    <div id="divDanger" class="alert alert-danger alert-dismissable hidden">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Error!</strong>
        <div>Blast error.</div>
    </div>



        <ol class="breadcrumb">
            <li>Blast in Databases Resource</li>
        </ol>
        <br>

        <form role="form" id="formSearch" method="post" action="" target="_self">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="database">Database</label><img src="img/info2.png" class="iconsearch"
                                                                   title="Use free-text for searching the databases name."
                                                                   data-placement="top" data-toggle="tooltip">
                        <input type="text" class="form-control" name="dbncrna[name]" id="database"
                               placeholder="Any Database" data-provide="typeahead">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="organism">Organism</label><img src="img/info2.png" class="iconsearch"
                                                                   title="Filter by organisms. Use the scientific name (e.g. Homo sapiens, Mus musculus)."
                                                                   data-placement="top" data-toggle="tooltip">
                        <input type="text" class="form-control" name="organism[name]" id="organism"
                               placeholder="Any Organism" data-provide="typeahead">
                    </div>
                </div>
                <div class="col-md-4 form-group">
                            <label for="rnatype">RNA Type</label>
                            <select id="rnatype" name="rnatype" class="form-control">
                                <option value='0'>All</option>
                                <?php
                                    foreach($rnaTypes as $values){
                                        echo "<option value='".$values['idTypeRNA']."'>".$values['RNAName']."</option>";
                                    }
                                ?>
                            </select>
                 </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="sequence">Sequence</label><img src="img/info2.png" class="iconsearch"
                                                                 title="Past your RNA Sequence for query in databases"
                                                                 data-placement="top" data-toggle="tooltip">
                        <textarea class="form-control" rows="12" name="sequence" id="sequence" style="text-transform: uppercase"></textarea>
                    </div>
                </div>

            </div>

            <br>


            <div class="row" style="margin-top: -17px">
                <div class="col-md-12 text-right btndiv">
                    <button id="fat-btn" type="submit" class="btn btn-primary lbtn" data-loading-text="Loading...">
                        Run Blast
                    </button>
                    <button type="reset" class="btn btn-default">Clear</button>

                </div>
            </div>

        </form>


    </div>
    <!-- /container -->

</div>

<?php include(BASE_URL . 'infoline.php'); ?>

<?php include(BASE_URL . 'footer.php'); ?>
<script>

   $(function () {
         $(document).on("click", "#fat-btn", function () {
            var error = false;
            if ($("#database").val() == "" &&  $("#organism").val() == "") {
                /*$("#database").parent().addClass("has-error");*/
                $('#divDanger').removeClass('hidden');
                $('#divDanger').children('div').html("Fill at least one databse name or organism name");
                error = true;
            }else{
                /*$("#database").parent().removeClass("has-error");*/
                error = false;
                $('#divDanger').addClass('hidden');
            }
            if(error){
                $("#divSuccess").addClass('hidden');
                return false;
            }
            
        });
        
        if (window.response_error) {
            $('#divDanger').removeClass('hidden');
            $('#divDanger').children('div').html(response_error);
        } else if (window.response_success) {
            $('#divSuccess').removeClass('hidden');
            $('#divSuccess').children('div').html(response_success);
        }
        
        
   });

    // button state demo
    $('#fat-btn')
        .click(function () {
            var btn = $(this)
            btn.button('loading')
            setTimeout(function () {
                btn.button('reset');
                //$('#formSearch').submit();
            }, 3000)
        });


    $('#organism').typeahead({
        source: function (query, process) {
            $.ajax({
                url: './ajax/organism.php',
                type: 'GET',
                dataType: 'JSON',
                data: 'organism-ajax=' + query,
                success: function (data) {
                    //console.log(data);
                    process(data);
                }
            });
        }
    });

    $('#database').typeahead({
        source: function (query, process) {
            $.ajax({
                url: './ajax/dbncrna.php',
                type: 'GET',
                dataType: 'JSON',
                data: 'dbncrna-ajax=' + query,
                success: function (data) {
                    //console.log(data);
                    process(data);
                }
            });
        }
    });

</script>

</body>
</html>

