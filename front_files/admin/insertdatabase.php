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
            <strong>Well done!</strong> <div>SUCCESS</div>
        </div>
        <div id="divDanger" class="alert alert-danger alert-dismissable hidden">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Error!</strong> <div>Database error.</div>
        </div>

        <div id="divDangerDB" class="alert alert-danger alert-dismissable hidden">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Error!</strong> <div>Database error.</div>
        </div>

        <form method="post" action="#" class="form" enctype="multipart/form-data">

            <div class="panel panel-default">
                <!--
                 <div class="panel-heading">
                     <h3 class="panel-title">title</h3>
                 </div>
                -->
                <div class="panel-body" style="padding: 25px;">
                    <h3>Insert a new database</h3>
                    <br>

                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label for="name">Database name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Enter the database name">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="rnatype">RNA Type</label>
                            <select id="rnatype" name="rnatype" class="form-control">
                                <option value="Multiple classes">Multiple classes</option>
                                <option value="CNE">CNE</option>
                                <option value="Long RNA">Long RNA</option>
                                <option value="miRNA">miRNA</option>
                                <option value="NAT">NAT</option>
                                <option value="piRNA">piRNA</option>
                                <option value="Ribozyme">Ribozyme</option>
                                <option value="siRNA">siRNA</option>
                                <option value="small RNA">small RNA</option>
                                <option value="snoRNA">snoRNA</option>
                                <option value="SRP RNA">SRP RNA</option>
                                <option value="Structure">Structure</option>
                                <option value="TERC">TERC</option>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="version">Version</label>
                            <input type="text" class="form-control" name="version" id="version">
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="overview">Overview</label>
                            <textarea rows="5" id="overview" name="overview" class="form-control"></textarea>
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
                            <?php foreach ($methods as $value) { ?>
                                <label class="labelinputmet"><?php echo $value['Method']; ?></label>
                                <input type="text" class="form-control input-sm"
                                       name="methodDescription[<?php echo $value['IDMethod'] ?>]">
                            <?php } ?>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="source">Source</label>
                            <textarea rows="3" id="source" name="source" class="form-control"></textarea>
                            <span class="help-block">Fill this text area with information about database sources.</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <br>
                            <h4>Information Source:</h4>

                            <?php foreach ($informationSource as $value) { ?>
                                <label class="checkbox-inline">
                                    <input type="checkbox" style="" name="informationSource[]"
                                           value="<?php echo $value['IDInfoSource']; ?>">
                                    <?php echo $value['Type']; ?>
                                </label>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">

                            <h4>Information Content:</h4>

                            <div class="input-group" style="width: 400px!important;">
                                <select id="acTerms" class="form-control">
                                    <?php foreach ($informationContent as $value) { ?>
                                        <option
                                            value="<?php echo $value['idterm']; ?>"><?php echo $value['term']; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn">
                                     <button id="btnAddTerm" class="btn btn-success" type="button"> Add!</button>
                                </span>
                            </div>
                            <br>


                            <div id="infoCont" style="min-height: 60px;">
                                <!-- Carrega os objetos inseridos pelo add!-->
                            </div>
                            <div id="inputsHidden">
                                <!-- Carrega os objetos inseridos pelo add! na forma de input hiddens para poder enviar pelo form-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="reference">Reference</label>
                            <input type="text" class="form-control input-sm" name="reference" id="reference">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="pubmedID">PubmedID</label>
                            <input type="text" class="form-control input-sm" name="pubmedID" id="pubmedID">
                            <span class="help-block">Separate PubmedID with comma ','</span>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="year">Year</label>
                            <input type="text" class="form-control input-sm" name="year" id="year">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <h4>Multiple search:</h4>
                            <label class="radio-inline">
                                <input type="radio" name="mSearch" value="0" checked>No
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="mSearch" value="1">Yes
                            </label>
                        </div>

                        <div class="col-md-4 form-group">
                            <h4>Genomic overview:</h4>
                            <label class="radio-inline">
                                <input type="radio" name="gOverview" value="0" checked>No
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gOverview" value="1">Yes
                            </label>
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
                                    <option value='Stockholm' id="5" >Stockholm</option>
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
                            </div>
                            <div id="inputsHiddenDown">
                                <!-- Carrega os objetos inseridos pelo add! na forma de input hiddens para poder enviar pelo form-->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 form-group">
                            <label for="url">URL</label>
                            <input type="url" class="form-control input-sm" name="url" id="url">
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
                            </div>
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

        if(window.response_error){
            $('#divDanger').removeClass('hidden');
            $('#divDanger').children('div').html(response_error);
        }else if(window.response_success){
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