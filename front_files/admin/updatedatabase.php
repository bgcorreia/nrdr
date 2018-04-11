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
    <strong>Well done!</strong>

    <div>SUCCESS</div>
</div>
<div id="divDanger" class="alert alert-danger alert-dismissable hidden">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Error!</strong>

    <div>Database error.</div>
</div>

<div id="divDangerDB" class="alert alert-danger alert-dismissable hidden">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Error!</strong>

    <div>Database error.</div>
</div>

<form method="post" action="#" class="form" enctype="multipart/form-data">
<input type="hidden" name="iddb" value="<?php echo $databaseForm->IDDB; ?>">
<div class="panel panel-default">
<!--
 <div class="panel-heading">
     <h3 class="panel-title">title</h3>
 </div>
-->
<div class="panel-body" style="padding: 25px;">
<h3>Update database</h3>
<br>

<div class="row">

    <div class="col-md-6 form-group">
        <label for="name">Database name</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo $databaseForm->Name; ?>">
    </div>
    <div class="col-md-4 form-group">
        <label for="rnatype">RNA Type</label>
        <select id="rnatype" name="rnatype" class="form-control">
            <?php
            $array_rna = array('Multiple classes', 'CNE', 'Long RNA',
                'miRNA', 'NAT', 'piRNA', 'Ribozyme', 'siRNA', 'small RNA',
                'snoRNA', 'SRP RNA', 'Structure', 'TERC');
            foreach ($array_rna as $value) {
                if ($databaseForm->RNAType == $value) {
                    echo "<option value='{$value}' selected>{$value}</option>";
                } else {
                    echo "<option value='{$value}'>{$value}</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="col-md-2 form-group">
        <label for="version">Version</label>
        <input type="text" class="form-control" name="version" id="version" value="<?php echo $databaseForm->Version; ?>">
    </div>

</div>
<div class="row">
    <div class="col-md-12 form-group">
        <label for="overview">Overview</label>
        <textarea rows="5" id="overview" name="overview"
                  class="form-control"><?php echo $databaseForm->Overview ?></textarea>
        <span class="help-block">Fill this text area with database description.</span>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <br>
        <h4>Search Methods:</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12 form-group">
        <?php foreach ($methods as $value) {
            $aux_method = FALSE;
            echo "<label class='labelinputmet'>{$value['Method']}</label>";
            foreach ($databaseForm->searchMethods as $searchMethods) {
                if ($value['IDMethod'] == $searchMethods['IDMethod']) {
                    $aux_method = TRUE;
                    $description = $searchMethods['Description'];
                }
            }
            if ($aux_method) {
                echo "<input type='text' class='form-control input-sm' name='methodDescription[{$value['IDMethod']}]' value='{$description}'>";
            } else {
                echo "<input type='text' class='form-control input-sm' name='methodDescription[{$value['IDMethod']}]'>";
            }
        }
        ?>
        <br>
    </div>
</div>
<div class="row">
    <div class="col-md-12 form-group">
        <label for="source">Source</label>
        <textarea rows="3" id="source" name="source" class="form-control"><?php echo $databaseForm->Source ?></textarea>
        <span class="help-block">Fill this text area with information about database sources.</span>
    </div>
</div>
<div class="row">
    <div class="col-md-12 form-group">
        <br>
        <h4>Information Source:</h4>

        <?php foreach ($informationSource as $value) {
            $aux_infos = FALSE;
            foreach($databaseForm->informationsource as $infoSource){
                if($infoSource == $value['IDInfoSource']){
                    $aux_infos = TRUE;
                }
            }
            echo "<label class='checkbox-inline'>";
            if($aux_infos){
                echo "<input checked type='checkbox' name='informationSource[]' value='{$value['IDInfoSource']}'>";
            }else{
                echo "<input type='checkbox' name='informationSource[]' value='{$value['IDInfoSource']}'>";
            }
            echo $value['Type'];
            echo "</label>";

        } ?>

    </div>
</div>

<div class="row">
    <div class="col-md-12 form-group">

        <h4>Information Content:</h4>

        <div class="input-group" style="width: 400px!important;">
            <select id="acTerms" class="form-control">
                <?php foreach ($informationContent as $value) { ?>
                    <option value="<?php echo $value['idterm']; ?>"><?php echo $value['term']; ?></option>
                <?php } ?>
            </select>
                                <span class="input-group-btn">
                                     <button id="btnAddTerm" class="btn btn-success" type="button"> Add!</button>
                                </span>
        </div>
        <br>


        <div id="infoCont" style="min-height: 60px;">
            <!-- Carrega os objetos inseridos pelo add!-->
            <?php
            foreach ($databaseForm->informationContent as $value) {
                echo "<label class='label-success labelTerm fade in'>{$value['Term']}<a class='close'
                        onclick='removeInputHiddenTerm({$value['IDTerm']});' data-dismiss='alert' href='#' aria-hidden='true'>×</a></label>";
            }
            ?>
        </div>
        <div id="inputsHidden">
            <!-- Carrega os objetos inseridos pelo add! na forma de input hiddens para poder enviar pelo form-->
            <?php
            foreach ($databaseForm->informationContent as $value) {
                echo "<input type='hidden' id='termo-{$value['IDTerm']}' name='informationContent[]' value='{$value['IDTerm']}'>";
            }
            ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 form-group">
        <label for="reference">Reference</label>
        <input type="text" class="form-control input-sm" name="reference" id="reference"
               value="<?php echo $databaseForm->Reference; ?>">
    </div>
    <div class="col-md-4 form-group">
        <label for="pubmedID">PubmedID</label>
        <input type="text" class="form-control input-sm" name="pubmedID" id="pubmedID"
               value="<?php echo $databaseForm->pubmedid; ?>">
        <span class="help-block">Separate PubmedID with comma ','</span>
    </div>
    <div class="col-md-4 form-group">
        <label for="year">Year</label>
        <input type="text" class="form-control input-sm" name="year" id="year"
               value="<?php echo $databaseForm->Year; ?>">
    </div>
</div>

<div class="row">
    <div class="col-md-4 form-group">
        <h4>Multiple search:</h4>
        <?php
        if ($databaseForm->MultipleSearch) {
            echo "<label class='radio-inline'>";
            echo "<input type='radio' name='mSearch' value='0'>No";
            echo "</label>";
            echo "<label class='radio-inline'>";
            echo "<input type='radio' name='mSearch' value='1' checked>Yes";
            echo "</label>";
        } else {
            echo "<label class='radio-inline'>";
            echo "<input type='radio' name='mSearch' value='0' checked>No";
            echo "</label>";
            echo "<label class='radio-inline'>";
            echo "<input type='radio' name='mSearch' value='1'>Yes";
            echo "</label>";
        }
        ?>
    </div>

    <div class="col-md-4 form-group">
        <h4>Genomic overview:</h4>
        <?php
        if ($databaseForm->GraphicView) {
            echo "<label class='radio-inline'>";
            echo "<input type='radio' name='gOverview' value='0'>No";
            echo "</label>";
            echo "<label class='radio-inline'>";
            echo "<input type='radio' name='gOverview' value='1' checked>Yes";
            echo "</label>";
        } else {
            echo "<label class='radio-inline'>";
            echo "<input type='radio' name='gOverview' value='0' checked>No";
            echo "</label>";
            echo "<label class='radio-inline'>";
            echo "<input type='radio' name='gOverview' value='1'>Yes";
            echo "</label>";
        }
        ?>
    </div>
</div>


<div class="row">
    <div class="col-md-12 form-group">
        <h4>Download:</h4>

        <div class="input-group" style="width: 400px!important;">
            <select id="downloadTypes" class="form-control">
                <option value='BED' id="1">BED</option>
                <option value='GFF' id="2">GFF</option>
                <option value='GTF' id="3">GTF</option>
                <option value='PSL' id="4">PSL</option>
                <option value='Stockholm' id="5">Stockholm</option>
                <option value='EMBL' id="6">EMBL</option>
                <option value='FASTA' id="7">FASTA</option>
                <option value='Other' id="8">Other</option>
                <option value='Request' id="9">Request</option>
            </select>
                                <span class="input-group-btn">
                                     <button id="btnAddDown" class="btn btn-success" type="button"> Add!</button>
                                </span>
        </div>
        <br>

        <div id="infoDown" style="min-height: 40px;">
            <!-- Carrega os objetos inseridos pelo add!-->
            <?php
            $array_down = array('BED', 'GFF', 'GTF', 'PSL', 'Stockholm', 'EMBL', 'FASTA', 'Other', 'Request');

            foreach ($databaseForm->download as $value) {
                foreach ($array_down as $key => $aux_down) {
                    if ($aux_down == $value) {
                        $idDown = $key + 1;
                    }
                }
                echo "<label class='label-success labelTerm fade in'>{$value}<a class='close' onclick='removeInputHiddenDown({$idDown});' data-dismiss='alert' href='#' aria-hidden='true'>×</a></label>";
            }

            ?>
        </div>
        <div id="inputsHiddenDown">
            <!-- Carrega os objetos inseridos pelo add! na forma de input hiddens para poder enviar pelo form-->
            <?php
            foreach ($databaseForm->download as $value) {
                foreach ($array_down as $key => $aux_down) {
                    if ($aux_down == $value) {
                        $idDown = $key + 1;
                    }
                }
                echo "<input type='hidden' id='down-{$idDown}' name='downloadType[]' value='{$value}'>";
            }
            ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 form-group">
        <label for="url">URL</label>
        <input type="url" class="form-control input-sm" name="url" id="url" value="<?php echo $databaseForm->Site; ?>">
        <span class="help-block">Full URL, example: http://www.example.com </span>
    </div>
</div>

<br>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="fileorganism">Organism file input:</label>
            <input type="file" id="fileorganism" name="fileorganism">
            <p class="help-block">The file should contain only the organism's name, <a href="../files/example-organism-file.txt" target="_blank">example</a>.</p>
            <p class="help-block"><span class="label label-danger">ps: if you submit a new organism file, the existing organism for this database will be rewrite</span></p>
        </div>
    </div>
</div>

</div>
<br><br>

<div class="panel-footer" style="text-align: right">
    <button type="button" class="btn btn-danger pull-left" onclick="window.open('updatedatabase.php?id=<?php echo $databaseForm->IDDB ;?>&action=delete', '_self')">
        <span class="glyphicon glyphicon-trash"></span> Delete
    </button>

    <button type="reset" class="btn btn-default" style="margin-right: 5px;" onclick="window.open('managedatabase.php','_self');">
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


<?php include(BASE_URL . 'footer.php'); ?>


</body>
</html>

<script>
    function removeInputHiddenTerm(idTermo) {
        $("#termo-" + idTermo).remove();
    }
    function removeInputHiddenDown(idTermo) {
        $("#down-" + idTermo).remove();
    }


    $(function () {

        if (window.response_error) {
            $('#divDanger').removeClass('hidden');
            $('#divDanger').children('div').html(response_error);
        } else if (window.response_success) {
            $('#divSuccess').removeClass('hidden');
            $('#divSuccess').children('div').html(response_success);
        }


        //Javascript dos termos "information content"
        $('#btnAddTerm').click(function () {
            var termo = $('#acTerms').find(":selected").text();
            var idTermo = $('#acTerms').find(":selected").val();
            var stringTerm = "<label class='label-success labelTerm fade in'>" + termo + "<a class='close' onclick='removeInputHiddenTerm(" + idTermo + ");' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a></label>";
            var stringTermHidden = "<input type='hidden' id='termo-" + idTermo + "' name='informationContent[]' value='" + idTermo + "'>";

            //IF para verificar se elemento não existe (==0); senão existir - adiciona; se existir - não entra no IF
            if ($("#termo-" + idTermo).length == 0) {
                $('#infoCont').append(stringTerm);
                $('#inputsHidden').append(stringTermHidden);
            }
        });

        $('#btnAddDown').click(function () {
            var termo = $('#downloadTypes').find(":selected").text();
            var idTermo = $('#downloadTypes').find(":selected").attr("id");
            var stringTerm = "<label class='label-success labelTerm fade in'>" + termo + "<a class='close' onclick='removeInputHiddenDown(" + idTermo + ");' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a></label>";
            var stringTermHidden = "<input type='hidden' id='down-" + idTermo + "' name='downloadType[]' value='" + termo + "'>";

            //IF para verificar se elemento não existe (==0); senão existir - adiciona; se existir - não entra no IF
            if ($("#down-" + idTermo).length == 0) {
                $('#infoDown').append(stringTerm);
                $('#inputsHiddenDown').append(stringTermHidden);
            }
        });


    });

</script>