
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
                    <li>NRDR Downloads</li>
                </ol>

                <br>

                <div id="divSuccess" class="alert alert-success alert-dismissable hidden">
                    <button type="button" class="close" >&times;</button>
                    <strong>Well done!</strong>
                    <span>The download has been started</span>
                </div>

                <div id="divDanger" class="alert alert-danger alert-dismissable hidden">
                    <button type="button" class="close" >&times;</button>
                    <strong>Error!</strong>
                    <span>Error.</span>
                </div>

                <h4 style="margin-top: 40px; margin-bottom: 40px;">Fill at least one input text to filter and download a specified sequence (fasta) by your interest.</h4>


                <div class="row">

                    <!--
                    <div class="col-md-4 form-group">
                        <label for="rnatype">RNA Type</label>
                        <select id="rnatype" name="rnatype" class="form-control">
                            <option value='0'>All</option>
                    <?php
                    foreach ($rnaTypes as $values) {
                        //echo "<option value='" . $values['IDRNAType'] . "'>" . $values['IDRNAType'] . "</option>";
                    }
                    ?>
                        </select>
                    </div>
                    -->
                    <div class="col-md-6 form-group">
                        <label for="rnatype">Database</label>
                        <select id="iddb" name="iddb" class="form-control">
                            <option value='0'>All</option>
                            <?php
                            foreach ($arrayDB as $values) {
                                echo "<option value='" . $values['IDDB'] . "'>" . $values['Name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="organism">Organism</label><img src="img/info2.png" class="iconsearch"
                                                                       title="Filter by organisms. Use the scientific name (e.g. Homo sapiens, Mus musculus)."
                                                                       data-placement="top" data-toggle="tooltip">
                            <input type="text" class="form-control" name="organism[name]" id="organism"
                                   placeholder="Any Organism" data-provide="typeahead">
                        </div>
                    </div>

                </div>
                <br>
                <div class="row" style="margin-top: -17px">
                    <div class="col-md-12 text-center btndiv">


                        <button id="fat-btn" type="button" style="width: 370px!important" class="btn btn-primary lbtn" data-loading-text="Generating a download file, it may take a few minutes">
                            Download RNA sequences
                        </button>

                    </div>
                </div>



                <br>

                <h4 style="margin-top: 20px;">Sequences from 30 databases were extracted and stored in NRDR 2.0 database.<br> Here we have a complete list.</h4>
                <div id="version-history" style="font-family: Monaco, Menlo, Consolas, 'Courier New', monospace">

                    <p><strong>&#8226   ASRP                        </strong><br><a href="http://mpss.udel.edu/at_sRNA/"                                    target="_blank">Download ASRP                     information</a></p>
                    <p><strong>&#8226   cre-siRNA                   </strong><br><a href="http://cresirna.cmp.uea.ac.uk/cresirna/download.php/"             target="_blank">Download cre-siRNA                information</a></p>
                    <p><strong>&#8226   CSRDB                       </strong><br><a href="http://sundarlab.ucdavis.edu/smrnas/"                             target="_blank">Download CSRDB                    information</a></p>
                    <p><strong>&#8226   Condor                      </strong><br><a href="http://condor.nimr.mrc.ac.uk/download.html"                       target="_blank">Download Condor                   information</a><br>Dataset: All</p>
                    <p><strong>&#8226   CRW                         </strong><br><a href="http://www.rna.ccbb.utexas.edu/DAT/"                              target="_blank">Mainly in - Download CRW          information</a></p>
                    <p><strong>&#8226   fRNAdb                      </strong><br><a href="http://www.ncrna.org/frnadb/download"                             target="_blank">Download fRNAdb                   information</a><br>Dataset: All</p>
                    <p><strong>&#8226   CoGemiR                     </strong><br><a href="http://cogemir.tigem.it/htdocs/miscellaneous/"                    target="_blank">Download CoGemiR                  information</a></p>
                    <p><strong>&#8226   GISSD                       </strong><br><a href="http://www.rna.whu.edu.cn/gissd/sequence.html"                    target="_blank">Download GISSD                    information</a></p>
                    <p><strong>&#8226   LNCipedia                   </strong><br><a href="http://www.lncipedia.org/download"                                target="_blank">Download LNCipedia                information</a></p>
                    <p><strong>&#8226   Methylation Guide snoRNA    </strong><br><a href="http://lowelab.ucsc.edu/snoRNAdb/"                                target="_blank">Download Methylation Guide snoRNA information</a></p>
                    <p><strong>&#8226   microRNA.org                </strong><br><a href="http://www.microrna.org/microrna/getDownloads.do"                 target="_blank">Download microRNA.org             information</a></p>
                    <p><strong>&#8226   miRNAMap                    </strong><br><a href="ftp://mirnamap.mbc.nctu.edu.tw/miRNAMap2"                         target="_blank">Download miRNAMap                 information</a></p>
                    <p><strong>&#8226   miRWalk                     </strong><br><a href="http://www.umm.uni-heidelberg.de/apps/zmf/mirwalk/"               target="_blank">Download miRWalk                  information</a></p>
                    <p><strong>&#8226   mirBase                     </strong><br><a href="http://www.mirbase.org/ftp.shtml"                                 target="_blank">Download mirBase                  information</a></p>
                    <p><strong>&#8226   ncRNAdb                     </strong><br><a href="http://ncrnadb.trna.ibch.poznan.pl/download.html"                 target="_blank">Download ncRNAdb                  information</a></p>
                    <p><strong>&#8226   NONCODE                     </strong><br><a href="http://www.noncode.org/download.php"                              target="_blank">Download NONCODE                  information</a><br>Version: 2.0</p>
                    <p><strong>&#8226   RNAdb                       </strong><br><a href="http://research.imb.uq.edu.au/rnadb/rnadb2_archive.htm"           target="_blank">Download RNAdb                    information</a></p>
                    <p><strong>&#8226   piRNABank                   </strong><br><a href="http://pirnabank.ibab.ac.in/request.html"                         target="_blank">Download piRNABank                information</a></p>
                    <p><strong>&#8226   siRecords                   </strong><br><a href="http://sirecords.biolead.org"                                     target="_blank">Download siRecords                information</a></p>
                    <p><strong>&#8226   siRNAdb                     </strong><br><a href="http://sirna.sbc.su.se/sirnadb_050915.txt"                        target="_blank">Download siRNAdb                  information</a></p>
                    <p><strong>&#8226   smiRNAdb                    </strong><br><a href="http://www.mirz.unibas.ch/cloningprofiles/"                       target="_blank">Download smiRNAdb                 information</a></p>
                    <p><strong>&#8226   sRNAmap                     </strong><br><a href="http://srnamap.mbc.nctu.edu.tw/ "                                 target="_blank">Download sRNAmap                  information</a></p>
                    <p><strong>&#8226   NRED                        </strong><br><a href="http://nred.matticklab.com/cgi-bin/ncrnadb.pl"                    target="_blank">Download NRED                     information</a></p>
                    <p><strong>&#8226   PMRD                        </strong><br><a href="http://bioinformatics.cau.edu.cn/PMRD/download.htm"               target="_blank">Download PMRD                     information</a></p>
                    <p><strong>&#8226   Rfam                        </strong><br><a href="ftp://ftp.ebi.ac.uk/pub/databases/Rfam/11.0/"                     target="_blank">Download Rfam                     information</a><br>Version 11.0</p>
                    <p><strong>&#8226   Plant snoRNA database       </strong><br><a href="http://bioinf.scri.sari.ac.uk/cgi-bin/plant_snorna/get-sequences" target="_blank">Download Plant snoRNA database    information</a></p>
                    <p><strong>&#8226   PlantNATsDB                 </strong><br><a href="http://bis.zju.edu.cn/pnatdb/download/?species=osj"               target="_blank">Download PlantNATsDB              information</a></p>
                    <p><strong>&#8226   TarBase                     </strong><br><a href="http://diana.cslab.ece.ntua.gr/tarbase/tarbase_download.php"      target="_blank">Download TarBase                  information</a><br>Version: 5.0</p>
                    <p><strong>&#8226   UCbase & miRfunc            </strong><br><a href="http://microrna.osu.edu/.UCbase4/"                                target="_blank">Download UCbase & miRfunc         information</a></p>
                    <p><strong>&#8226   UCSC Genome Browser         </strong><br><a href="https://genome.ucsc.edu/cgi-bin/hgTables?command=start"           target="_blank">Download UCSC Genome Browser      information</a><br>Track: lincRNA Transcripts</p>

                    <br><br>


                </div>
            </div> <!-- /container -->

        </div>

        <?php include(BASE_URL . 'infoline.php'); ?>

        <?php include(BASE_URL . 'footer.php'); ?>

        <script>

            $(function() {


            });

            // button state demo
            $('#fat-btn').click(function() {

                $(".alert-dismissable").addClass('hidden');

                var btn = $(this);
                btn.button('loading');

                var rnatype = $("#rnatype").val();
                var organism = $("#organism").val();
                var iddb = $("#iddb").val();
                var databasename = $('#iddb').find(":selected").text();

                var error = false;
                if (rnatype == 0 && organism == '' && iddb == 0) {
                    $('#divDanger').removeClass('hidden');
                    $('#divDanger').children('span').html("Fill at least one Database name, Organism name or RNA Type");
                    error = true;
                } else {
                    error = false;
                    $('#divDanger').addClass('hidden');
                }

                if (error) {
                    $("#divSuccess").addClass('hidden');
                    btn.button('reset');
                    return false;
                }




                $.ajax({
                    url: './ajax/download.php',
                    type: 'GET',
                    dataType: 'text',
                    data: 'databasename=' + databasename + '&iddb=' + iddb + '&organism=' + organism + '&rnatype=' + rnatype,
                    success: function(data, textStatus, XMLHttpRequest) {
                        error = false;
                        $('#divDanger').addClass('hidden');
                        $('#divSuccess').removeClass('hidden');
                        btn.button('reset');


                        $('body').append('<a href="?param=' + data + '" id="link" target="_self"> download </a>');
                        document.getElementById('link').click(); // $('#link').click() wasn't working for me
                        $('#link').remove();

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        btn.button('reset');
                        $('#divDanger').removeClass('hidden');
                        $('#divDanger').children('span').html('No match results for this query');
                        $("#divSuccess").addClass('hidden');
                        return false;
                    }
                });
            });

            $('#organism').typeahead({
                source: function(query, process) {
                    var iddb = $('#iddb').val();
                    $.ajax({
                        url: './ajax/organism_downloadpage.php',
                        type: 'GET',
                        dataType: 'JSON',
                        data: 'organism-ajax=' + query +'&iddb='+iddb,
                        success: function(data) {
                            //console.log(data);
                            process(data);
                        }
                    });
                }
            });




            $('#iddb').change(function(e) {
                //var organism = $("#organism").val();
                var organism = '';
                var iddb = $("#iddb").val();
                var rnatype = $("#rnatype").val();
                $.ajax({
                    url: './ajax/rnatype_downloadpage.php',
                    type: 'GET',
                    dataType: 'html',
                    data: 'organism=' + organism + '&iddb=' + iddb,
                    success: function(data) {
                        $("#rnatype").html(data);
                        $('#rnatype>option:eq(0)').attr('selected', true);
                    }
                });
            });

            $('#rnatype').change(function(e) {
                //var organism = $("#organism").val();
                var organism = '';
                var iddb = $("#iddb").val();
                var rnatype = $("#rnatype").val();

                $.ajax({
                    url: './ajax/dbncrna_downloadpage.php',
                    type: 'GET',
                    dataType: 'html',
                    data: 'organism=' + organism + '&rnaType=' + rnatype,
                    success: function(data) {
                        $("#iddb").html(data);

                    }
                });
            });





            $(".close").click(function() {
                $(this).parent().addClass('hidden');
            });

        </script>

    </body>
</html>

