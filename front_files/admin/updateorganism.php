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
            <strong>Well done!</strong> Organism update successfully
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
            <input type="hidden" id="IDOrganism" name="IDOrganism" value="<?php echo $organism->IDOrganism ;?>">
            <div class="panel panel-default">
                <!--
                 <div class="panel-heading">
                     <h3 class="panel-title">title</h3>
                 </div>
                -->
                <div class="panel-body" style="padding: 25px;">
                    <h3>Update organism</h3>
                    <br>
                    <div class="row">

                        <div class="col-md-6 form-group autoCompleteErro">
                            <label for="organism">Organism's Scientific Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $organism->Name ;?>">
                        </div>
                        <div class="col-md-6 form-group autoCompleteErro">
                            <label for="organism">Organism's Common Name</label>
                            <input type="text" class="form-control" name="cname" id="cname" value="<?php echo $organism->CName ;?>">
                        </div>

                    </div>


                </div>
                <br><br>
                <div class="panel-footer" style="text-align: right">
                    <button type="button" class="btn btn-danger pull-left" onclick="window.open('updateorganism.php?id=<?php echo $organism->IDOrganism ;?>&action=delete', '_self')">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                    </button>
                    <button type="reset" class="btn btn-default" style="margin-right: 5px;" onclick="window.open('manageorganism.php','_self');">
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

</script>