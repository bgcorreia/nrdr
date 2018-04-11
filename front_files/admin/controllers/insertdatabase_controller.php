<?php
$dbrna = new ncrnaMain();
$methods = $dbrna->getAllMethods();
$informationSource = $dbrna->getAllInformationSource();
$informationContent = $dbrna->getAllTerm();

if(!empty($_POST)){
    //echo "<pre>";print_r($_SESSION['USER']->iduser);die;
    $database = new ncRNAdatabase();

    //Verifica se ele tem algum tipo de download pra setar variavel download.
    $download = (!empty($_POST['downloadType']) ? 1 : 0);

    //obter organismos a partir do arquivo organismos
    if(!empty($_FILES['fileorganism']['tmp_name'])){
        if($_FILES['fileorganism']['error'] > 0 OR $_FILES['fileorganism']['type'] != 'text/plain'){
            //Erro no arquivo
            $_ERROR = "Error with File ". $_FILES['fileorganism']['name'];
        }else{
            //Arquivo Ok.
            $listOrganism = file($_FILES['fileorganism']['tmp_name']);
            unlink($_FILES['fileorganism']['tmp_name']);
        }
    }

    if(empty($_ERROR)){
        $retorno = $database->insertDatabase($_POST['name'], $_POST['rnatype'], $_POST['source'], $download, $_POST['mSearch'],
                   $_POST['gOverview'], $_POST['overview'], $_POST['year'],  $_POST['reference'], $_POST['url'], $_POST['version'], $_SESSION['USER']->iduser);
    }

    if(!empty($retorno)){
        $iddb = $retorno;

        //Inserindo o search method
        $database->insertSearchMethod($iddb, $_POST['methodDescription']);
        //Inserindo o information source
        if(!empty($_POST['informationSource'])){
            $database->insertInformationSource($iddb, $_POST['informationSource']);
        }
        //inserindo o information content
        if(!empty($_POST['informationContent'])){
            $database->insertInformationContent($iddb, $_POST['informationContent']);
        }
        //inserindo os tipos de downloads
        if(!empty($_POST['downloadType'])){
            $database->insertDownloadType($iddb, $_POST['downloadType']);
        }
        //inserindo o pubmedID
        if(!empty($_POST['pubmedID'])){
            $database->insertPubmedID($iddb, $_POST['pubmedID']);
        }
        //Inserindo organismos
        if(!empty($listOrganism)){
            $database->insertOrganismFromArray($iddb, $listOrganism);
        }

        $_SUCCESS = "Database inserted";
    }else{
        if(empty($_ERROR)){
            $_ERROR = "Error: database insert error";
        }

    }
}
