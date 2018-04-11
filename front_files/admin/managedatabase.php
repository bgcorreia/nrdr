<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
</head>
<body>
<?php include('header.php'); ?>
<div id="main">
    <div class="container">
        <!--<div class="row">
            <div class="form-group col-md-2">
                <label for="header">Database</label>
                <input type="text" class="form-control" name="database" id="database">
            </div>
            <div class="form-group col-md-4">
                <label for="header">Organism's Scientific Name</label>
                <input type="text" class="form-control" name="sname" id="sname">
            </div>
            <div class="form-group col-md-4">
                <label for="header">Organism's Common Name</label>
                <input type="text" class="form-control" name="cname" id="cname">
            </div>
            <div class="col-md-1" style="padding-top: 25px;">
                <button name="filter" id="filter" type="button" class="btn btn-success" data-loading-text="Loading...">
                    <span class="glyphicon glyphicon-filter"></span>
                    Filter
                </button>
            </div>
        </div>-->
        <div id="grid">

        </div>
    </div>
</div>
<?php include(BASE_URL . 'footer.php'); ?>
</body>
</html>

<script>

    $(function () {
        if (window.response == 'error') {
            $('#divDanger').removeClass('hidden');
        } else if (window.response == 'success') {
            $('#divSuccess').removeClass('hidden');
        }
        $.ajax({
            type: 'POST',
            dataType: 'HTML',
            url: 'ajax/grid_databases.php',
            data: { parametro: ''}
        }).success(function (e) {
                $('#grid').html(e);
            });
    });

</script>