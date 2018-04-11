<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
</head>

<body>

<?php include('header.php'); ?>


<div id="main">


    <div class="container">

        <div id="divSuccess" class="alert alert-success alert-dismissable hidden">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Well done!</strong> Sequence update successfully
        </div>
        <div id="divDanger" class="alert alert-danger alert-dismissable hidden">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Error!</strong> Organism or Database has incorrect.
        </div>

        <div id="divDangerDB" class="alert alert-danger alert-dismissable hidden">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Error!</strong> Database error.
        </div>

        <form method="post" action="#" class="form">
            <input type="hidden" id="IDSequence" name="IDSequence" value="<?php echo $sequence->IDSequence ;?>">
            <div class="panel panel-default">
                <!--
                 <div class="panel-heading">
                     <h3 class="panel-title">title</h3>
                 </div>
                -->
                <div class="panel-body" style="padding: 25px;">
                    <h3>Update sequence</h3>
                    <br>
                    <div class="row">
                        <div class="col-md-4 form-group autoCompleteErro">
                            <label for="database">Database Name</label>
                            <input type="text" class="form-control" name="database" id="database" value="<?php echo $sequence->dbName ;?>">
                        </div>

                        <div class="col-md-4 form-group autoCompleteErro">
                            <label for="organism">Organism's Name</label>
                            <input type="text" class="form-control" name="organism" id="organism" value="<?php echo $sequence->organismName ;?>">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="rnatype">RNA Type</label>
                            <select id="rnatype" name="rnatype" class="form-control">
                                <?php
                                foreach($rnaTypes as $values){
                                    if($values['idTypeRNA'] == $sequence->IDTypeRNA){
                                        echo "<option selected";
                                    }else{
                                        echo "<option";
                                    }
                                    echo " value='".$values['idTypeRNA']."'>".$values['RNAName']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="header">Sequence's Header</label>
                        <input type="text" class="form-control" name="header" id="header" value="<?php echo $sequence->Header ;?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description" id="description" value="<?php echo $sequence->Descricao ;?>">
                    </div>

                    <div class="form-group">
                        <label for="sequence">Sequence</label>
                        <textarea class="form-control" rows="5" name="sequence" id="sequence" style="text-transform: uppercase"><?php echo $sequence->Sequence; ?></textarea>
                    </div>



                </div>
                <div class="panel-footer" style="text-align: right">
                    <button type="button" class="btn btn-danger pull-left" onclick="window.open('updatesequence.php?id=<?php echo $sequence->IDSequence ;?>&action=delete', '_self')">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                    </button>
                    <button type="reset" class="btn btn-default" style="margin-right: 5px;" onclick="window.open('managesequence.php','_self');">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary" style="margin-right: 10px;">
                        <span class="glyphicon glyphicon-floppy-disk"></span> Save
                    </button>
                </div>
            </div>
        </form>

    </div>

</div>


<?php include(BASE_URL.'footer.php'); ?>


</body>
</html>

<script>

    $(function () {
        if (window.response == 'error') {
            $('.autoCompleteErro').addClass('has-error');
            $('#divDanger').removeClass('hidden');
        }else if(window.response == 'success'){
            $('#divSuccess').removeClass('hidden');
        }else if(window.response == 'errordb'){
            $('#divDangerDB').removeClass('hidden');
        }

    });

    $('#organism').typeahead({
        source: function (query, process) {
            $.ajax({
                url: '../ajax/organism.php',
                type: 'GET',
                dataType: 'JSON',
                data: 'organism-ajax=' + query,
                success: function(data) {
                    //console.log(data);
                    process(data);
                }
            });
        }
    });

    $('#database').typeahead({
        source: function (query, process) {
            $.ajax({
                url: '../ajax/dbncrna.php',
                type: 'GET',
                dataType: 'JSON',
                data: 'dbncrna-ajax=' + query,
                success: function(data) {
                    //console.log(data);
                    process(data);
                }
            });
        }
    });

</script>