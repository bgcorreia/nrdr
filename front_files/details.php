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
            <li><a class="goFirst">Search</a></li>
            <li><a class="goBack">Search Result</a></li>
            <li>Database Details</li>
        </ol>

        <div class="row">
            <div class="col-md-12">


                <div class="pageInfo">

                    <h3><strong><?php echo $databaseDetails["Name"]; ?> </strong></h3>
                    <?php
                        if(!empty($databaseDetails['Version'])){
                              echo "<h6>Database version: {$databaseDetails['Version']} </h6>";
                        }                      
                    ?>                    
                    <h5><strong>RNA Type: </strong> <?php echo $databaseDetails["RNAType"]; ?></h5>
                    <h5><strong>Overview: </strong> <?php echo $databaseDetails["Overview"]; ?></h5>

                    <?php
                    if (is_array($databaseDetails['searchmethod'])) {
                        echo "<h5><strong>Search Methods:</strong></h5>";
                        echo "<ul>";
                        foreach ($databaseDetails['searchmethod'] as $value) {
                            echo "<li><strong>" . $value['Method'] . ": </strong>" . $value['Description'] . "</li>";
                        }
                        echo "</ul>";
                    }
                    ?>
                    <?php
                        if($databaseDetails["Source"] != ''){
                            echo "<h5><strong>Source: </strong>{$databaseDetails['Source']}</h5>";
                        }
                    ?>

                    <h5><strong>Information Source: </strong> <?php echo $databaseDetails["informationsource"]; ?></h5>
                    <h5><strong>Information Content: </strong> <?php echo $databaseDetails["informationcontent"]; ?>
                    </h5>
                    <h5><strong>Reference: </strong> <?php echo $databaseDetails["Reference"]; ?></h5>
                    <h5><strong>PubmedID: </strong> <?php echo $databaseDetails["pubmedid"]; ?></h5>
                    <h5><strong>Year: </strong> <?php echo $databaseDetails["Year"]; ?></h5>
                    <h5><strong>Multiple search: </strong> <?php if ($databaseDetails["MultipleSearch"] == 1) {
                            echo "Yes";
                        } else {
                            echo "No";
                        } ?></h5>
                    <h5><strong>Download: </strong> <?php echo $databaseDetails["TypeDownload"]; ?></h5>
                    <h5><strong>Genomic Overview: </strong> <?php if ($databaseDetails["GraphicView"] == 1) {
                            echo "Yes";
                        } else {
                            echo "No";
                        } ?></h5>
                    <h5><strong>Organism: </strong> <?php
                        if ($databaseDetails["CountOrganism"] > 1) {
                            echo "{$databaseDetails["Organism"]} and <a href='detailsorganism.php?database={$databaseDetails['IDDB']}' target='_self'> {$databaseDetails["CountOrganism"]} others.</a>";
                        } else {
                            echo "{$databaseDetails["Organism"]}.";
                        }
                        ?></h5>
                    <br>
                    <h5><strong>Url: </strong><a href="<?php echo $databaseDetails["Site"]; ?>"
                                                 target="_blank"><?php echo $databaseDetails["Site"]; ?> </a></h5>


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