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
            <strong>Well done!</strong> Organism inserted successfully
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

            <div class="panel panel-default">
                <!--
                 <div class="panel-heading">
                     <h3 class="panel-title">title</h3>
                 </div>
                -->
                <div class="panel-body" style="padding: 25px;">
                    <h3>Insert a new organism</h3>
                    <br>
                    <div class="row">

                        <div class="col-md-6 form-group autoCompleteErro">
                            <label for="organism">Organism's Scientific Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter the organism's scientific name">
                        </div>
                        <div class="col-md-6 form-group autoCompleteErro">
                            <label for="organism">Organism's Common Name</label>
                            <input type="text" class="form-control" name="cname" id="cname" placeholder="Enter the organism's common name if exist">
                        </div>

                    </div>


                </div>
                <br><br>
                <div class="panel-footer" style="text-align: right">

                    <button type="reset" class="btn btn-default" style="margin-right: 5px;">
                        Clear
                    </button>
                    <button type="submit" class="btn btn-primary" style="margin-right: 10px;">
                        <span class="glyphicon glyphicon-floppy-disk"></span> Insert
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