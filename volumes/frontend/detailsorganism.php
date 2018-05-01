<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
    </head>

    <body>

        <?php include(BASE_URL . 'header.php'); ?>


        <div id="main">

            <div class="container">


                <ol class="breadcrumb">

                    <?php
                    if ($fromDirectList) {
                        echo "<li><a class='goFirst'>Search</a></li>";
                        echo "<li><a class='goBack'>Search Result</a></li>";
                        echo "<li><a href='details.php?database={$databaseDetails['IDDB']}' target='_self'>Database Details</a></li>";
                    } else {
                        echo "<li><a class='goMoreFirst'>Search</a></li>";
                        echo "<li><a class='goFirst'>Search Result</a></li>";
                        echo "<li><a class='goBack'>Database Details</a></li>";
                    }
                    ?>

                    <li><?php echo "List of organisms from {$databaseDetails["Name"]}" ?></li>
                </ol>

                <div class="row">
                    <div class="col-md-12">


                        <div class="pageInfo">

                            <?php
                            echo "<h3><strong>List of organisms from {$databaseDetails["Name"]}</strong></h3>";

                            echo "<br>";
                            $tempWord = '';
                            echo "<dl>";
                            foreach ($organismList as $value) {
                                if ($tempWord != strtoupper($value[0])) {
                                    echo "<dt class='dtStyle'><h4>{$value[0]}</h4></dt>";
                                    $tempWord = strtoupper($value[0]);
                                }
                                echo "<dd class='ddMargin'>{$value}</dd>";
                            }
                            echo "</dl>";
                            echo "<a class='goBack pull-left'><h5><- Previous page<h5></a>";
                            ?>
                        </div>


                    </div>
                </div>


            </div>
            <!-- /container -->

        </div>

        <?php include(BASE_URL . 'infoline.php'); ?>

        <?php include(BASE_URL . 'footer.php'); ?>


    </body>
</html>