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
            <li>Statistic by Amount of Databases</li>
        </ol>

        <div class="row">
            <div class="col-md-12">
                <div class="">

                    <div class="row">

                        <div class="col-md-6 col-xs-12">
                            <h4>Information Content</h4>
                            <table class="table table-hover table-striped statistics-table table-condensed">
                                <thead>
                                <tr>
                                    <th>Content</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($array['informationcontent'] as $value){
                                    echo "<tr>";
                                    echo "<td><a href='".BASE_URL."databaseslist.php?informationcontent[]=".$value['id']."' target='_self'>".$value['text']."</a></td>";
                                    echo "<td><em>".$value['amount']."</em></td>";
                                    echo "</tr>";
                                } ?>
                                </tbody>
                            </table><br><br>


                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h4>RNA Classes</h4>

                            <table class="table table-hover table-striped  statistics-table table-condensed">
                                <thead>
                                <tr>

                                    <th>RNA</th>
                                    <th>Amount</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($array['RNAType'] as $value){
                                    echo "<tr>";
                                    echo "<td><a href='".BASE_URL."databaseslist.php?rnatype[]=".$value['id']."' target='_self'>".$value['text']."</a></td>";
                                    echo "<td><em>".$value['amount']."</em></td>";
                                    echo "</tr>";
                                } ?>
                                </tbody>
                            </table>

                            <br><br>
                            <h4>Information Source</h4>

                            <table class="table table-hover table-striped  statistics-table table-condensed">
                                <thead>
                                <tr>

                                    <th>Source</th>
                                    <th>Amount</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($array['informationsource'] as $value){
                                    echo "<tr>";
                                    echo "<td><a href='".BASE_URL."databaseslist.php?informationsource[]=".$value['id']."' target='_self'>".$value['text']."</a></td>";
                                    echo "<td><em>".$value['amount']."</em></td>";
                                    echo "</tr>";
                                } ?>
                                </tbody>
                            </table>


                            <br><br>
                            <h4>Search Method</h4>

                            <table class="table table-hover table-striped statistics-table table-condensed">
                                <thead>
                                <tr>

                                    <th>Method</th>
                                    <th>Amount</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($array['searchmethod'] as $value){
                                    echo "<tr>";
                                    echo "<td><a href='".BASE_URL."databaseslist.php?searchmethod[]=".$value['id']."' target='_self'>".$value['text']."</a></td>";
                                    echo "<td><em>".$value['amount']."</em></td>";
                                    echo "</tr>";
                                } ?>
                                </tbody>
                            </table>
                            <br>
                            <b>* Amount = Amount of Databases</b>

                        </div>

                    </div>

                </div>
            </div>
        </div>


    </div> <!-- /container -->

</div>

<?php include(BASE_URL.'infoline.php'); ?>

<?php include(BASE_URL.'footer.php'); ?>


</body>
</html>