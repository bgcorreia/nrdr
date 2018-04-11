<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
    </head>

    <body>

        <?php include(BASE_URL . 'header.php'); ?>

        <?php
        if (count($databaseList) > 0 AND $databaseList[0] != '') {
            $searhResult = count($databaseList) . " Databases Found";
        } else {
            $searhResult = "No Databases Found";
        }
        ?>


        <div id="main">

            <div class="container">


                <ol class="breadcrumb">
                    <li><a class="goBack">Search</a></li>
                    <li><?php echo $searhResult; ?></li>
                </ol>

                <div class="row">
                    <div class="col-md-12">


                        <div class="pageInfo">

                            <?php
                            if (count($databaseList) > 0 AND $databaseList[0] != '') {
                                ?>

                                <table class="table table-hover table-databaselist">
                                    <thead>
                                      <tr>

                                        <th style="width: 200px;"><h4>Database Name</h4></th>
                                        <th style="width: 280px;"><h4>Amount of Organisms</h4></th>
                                        <th><h4>Address database website</h4></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($databaseList as $value) {
                                            echo "<tr>";
                                            echo "<td><a href='" . BASE_URL . "details.php?database=" . $value['IDDB'] . "' target='_self'>" . $value['Name'] . "</a></td>";

                                            if ($value["count_org"] > 6) {
                                                echo "<td class='ajustaListagem'>" . $value['qtd_org'] . " and <a href='detailsorganism.php?from=1&database={$value['IDDB']}' target='_self'>" . $value["count_org"] . " others.</a></td>";
                                            } else {
                                                echo "<td class='ajustaListagem'>" .$value["qtd_org"] . ".</td>";
                                            }
                                            echo "<td><a href='{$value['Site']}' target='_blank'>" . (strlen($value['Site']) > 30 ? substr($value['Site'], 0, 30)."..." : $value['Site']) . "</a></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <?php
                            } else {
                                ?>
                                <h3 class="text-center">No Databases Found</h3>
    <?php
}
?>

                        </div>


                    </div>
                </div>




            </div> <!-- /container -->

        </div>

<?php include(BASE_URL . 'infoline.php'); ?>

<?php include(BASE_URL . 'footer.php'); ?>


    </body>
</html>