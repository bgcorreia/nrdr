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
            <li>Search in Databases Resource</li>
        </ol>
        <br>
        <form role="form" id="formSearch" method="post"  action="<?php echo BASE_URL ?>databaseslist.php" target="_self">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="database">Database</label><img src="img/info2.png" class="iconsearch" title="Use free-text for searching the databases name, complete at least three letters to display the options" data-placement="top" data-toggle="tooltip">
                        <input type="text" class="form-control" name="dbncrna[name]" id="database" placeholder="Any Database" data-provide="typeahead">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="overview">Overview (Description)</label><img src="img/info2.png" class="iconsearch" title="Use free-text for searching the databases description field." data-placement="top" data-toggle="tooltip">
                        <input type="text" class="form-control" name="dbncrna[overview]" id="overview" placeholder="Any Description">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="organism">Organism</label><img src="img/info2.png" class="iconsearch" title="Filter by organisms. Use the scientific name (e.g. Homo sapiens, Mus musculus), complete at least three letters to display the options" data-placement="top" data-toggle="tooltip">
                        <input type="text" class="form-control" name="organism[name]" id="organism" placeholder="Any Organism" data-provide="typeahead">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="source">Source</label><img src="img/info2.png" class="iconsearch" title="Use free-text to filter the source from which the information came (e.g. GenBank, Literature, Ensembl, RNAz and other databases or tools)." data-placement="top" data-toggle="tooltip">
                        <input type="text" class="form-control" name="dbncrna[source]" id="source" placeholder="Any Source">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group customcheck1">
                        <label>Information Source</label><img src="img/info2.png" class="iconsearch" title="Filter according to the type of data stored on databases." data-placement="top" data-toggle="tooltip">
                        <br>
                        <?php
                            foreach($InfoSource as $value){
                                echo "<label class='checkbox-inline'>";
                                echo "<input type='checkbox' name='informationsource[]' value='".$value["IDInfoSource"]."'> ".ucwords($value["Type"]);
                                echo "</label>";
                            }

                        ?>
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>RNA Families</label><img src="img/info2.png" class="iconsearch" title="Select the ncRNA classes that you want to search for. Hold CTRL+key for multiple selection." data-placement="top" data-toggle="tooltip">
                        <select multiple class="form-control" name="dbncrna[RNAType][]">
                            <?php
                                foreach($rnaTypeList as $value){
                                    echo "<option value='".$value["IDRNAType"]."'>".$value["RNAType"]."</option>";
                                }
                            ?>
                        </select>
                    </div>


                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Information Content</label><img src="img/info2.png" class="iconsearch" title="Hold CTRL+key for multiple selection." data-placement="top" data-toggle="tooltip">
                        <select multiple class="form-control" name="informationcontent[]">
                            <?php
                            foreach($Term as $value){
                                echo "<option value='".$value["idterm"]."'>".ucwords($value["term"])."</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Download Type</label><img src="img/info2.png" class="iconsearch" title="Select those databases that make information available for Download, hold CTRL+key for multiple selection" data-placement="top" data-toggle="tooltip">
                        <select multiple class="form-control" name="download[]">
                            <?php
                            foreach($DownloadType as $value){
                                echo "<option value='".$value."'>".$value."</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group customcheck2">
                        <label>Database has the following Search Method(s)</label><img src="img/info2.png" class="iconsearch" title="Filter according to the search methods available on databases." data-placement="top" data-toggle="tooltip">
                        <br>
                        <?php
                        foreach($Method as $value){
                            echo "<label class='checkbox-inline'>";
                            echo "<input type='checkbox' name='searchmethod[]' value='".$value["IDMethod"]."'> ".$value["Method"];
                            echo "</label>";
                        }
                        ?>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group customcheck3">
                        <label>Database Allows</label><img src="img/info2.png" class="iconsearch" title="Select those databases that offer a Multiple Search option, or make available some Genomic View of the data (e.g. Genome Browser)." data-placement="top" data-toggle="tooltip">
                        <br>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="dbncrna[multipleSearch]" value="1"> Multiple Search
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="dbncrna[graphicview]" value="1"> Graphic View
                        </label>

                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: -17px">
                <div class="col-md-12 text-center btndiv">
                         <button id="fat-btn" type="submit" class="btn btn-primary lbtn" data-loading-text="Loading...">Search</button>
                </div>
            </div>

        </form>



    </div> <!-- /container -->

</div>

<?php include(BASE_URL.'infoline.php'); ?>

<?php include(BASE_URL.'footer.php'); ?>
<script>

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
                url: './ajax/dbncrna.php',
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

</body>
</html>

