<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
</head>
<body>
    <?php include('header.php'); ?>
<div id="main">
    <div class="container">
        <div class="row">
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
        </div>
        <div id="grid">

        </div>
    </div>
</div>
    <?php include(BASE_URL . 'footer.php'); ?>
</body>
</html>

<script>

    $('#database').typeahead({
        source: function (query, process) {
            $.ajax({
                url: '../ajax/dbncrna.php',
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

    $(function () {
        if (window.response == 'error') {
            $('#divDanger').removeClass('hidden');
        } else if (window.response == 'success') {
            $('#divSuccess').removeClass('hidden');
        }
        $.ajax({
            type: 'POST',
            dataType: 'HTML',
            url: 'ajax/grid_organisms.php',
            data: { parametro: ''}
        }).success(function (e) {
                $('#grid').html(e);
            });
    });

    $('#filter').click(function(){

        var btn = $(this);
        btn.button('loading');

        window.filter1 = $('#database').val();
        window.filter2 = $('#sname').val();
        window.filter3 = $('#cname').val();
        $.ajax({
            type: 'POST',
            dataType: 'HTML',
            timeout: 50000,
            url: 'ajax/grid_organisms.php',
            data: {
                filter1: window.filter1,
                filter2: window.filter2,
                filter3: window.filter3
            }
        }).done(function (e) {
                $('#grid').html(e);
                btn.button('reset');
            }).fail(function(e){
                alert('Fail: Time out');
                btn.button('reset');
            });

    });
</script>