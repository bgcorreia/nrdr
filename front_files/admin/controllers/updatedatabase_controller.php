<?php
$dbrna = new ncrnaMain();
$methods = $dbrna->getAllMethods();
$informationSource = $dbrna->getAllInformationSource();
$informationContent = $dbrna->getAllTerm();
//echo "<pre>";print_r($informationContent);die;


if (isset($_GET['id']) AND empty($_POST)) {

    $databaseObj = new ncRNAdatabase();
    $databaseForm = populaForm($_GET['id'], $databaseObj);


    //Delete
    if (isset($_GET['action']) AND $_GET['action'] == "delete") {

        $retorno = $databaseObj->deleteDatabase($_GET['id'], $_SESSION['USER']->iduser, $_SESSION['USER']->type);
        if ($retorno) {
            echo "<script> window.open('managedatabase.php', '_self'); </script>";
        } else {
            $_ERROR = "Error: database delete error";
        }

    }

    unset($databaseObj);

} else if (!empty($_POST)) {
    //Update
    $iddb = $_POST['iddb'];

    $database = new ncRNAdatabase();
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
        $retorno = $database->updateDatabase($iddb, $_POST['name'], $_POST['rnatype'], $_POST['source'], $download, $_POST['mSearch'],
            $_POST['gOverview'], $_POST['overview'], $_POST['year'], $_POST['reference'], $_POST['url'], $_POST['version']);
    }


    if(!empty($retorno)){

        //update o search method
        $query = "DELETE FROM searchmethod WHERE IDDB = {$iddb}";
        $resul = $database->banco->query($query);
        $database->insertSearchMethod($iddb, $_POST['methodDescription']);


        //update o information source
        $query = "DELETE FROM infosourcedbs WHERE IDDB = {$iddb}";
        $resul = $database->banco->query($query);
        if (!empty($_POST['informationSource'])) {
            $database->insertInformationSource($iddb, $_POST['informationSource']);
        }

        //update information content
        $query = "DELETE FROM informationcontent WHERE IDDB = {$iddb}";
        $resul = $database->banco->query($query);
        if (!empty($_POST['informationContent'])) {
            $database->insertInformationContent($iddb, $_POST['informationContent']);
        }

        //update tipos de downloads
        $query = "DELETE FROM download WHERE IDDB = {$iddb}";
        $resul = $database->banco->query($query);
        if (!empty($_POST['downloadType'])) {
            $database->insertDownloadType($iddb, $_POST['downloadType']);
        }

        //update o pubmedID
        $query = "DELETE FROM pubmedid WHERE IDDB = {$iddb}";
        $resul = $database->banco->query($query);
        if (!empty($_POST['pubmedID'])) {
            $database->insertPubmedID($iddb, $_POST['pubmedID']);
        }

        $_SUCCESS = "Database updated successfully";
    } else {
        if(empty($_ERROR)){
            $_ERROR = "Error: database updated error";
        }
    }

    $databaseForm = populaForm($iddb, $database);


    //Inserindo organismos
    if(!empty($listOrganism)){
        $query = "DELETE FROM dborganism WHERE IDDB = {$iddb}";
        $resul = $database->banco->query($query);
        $database->insertOrganismFromArray($iddb, $listOrganism);
    }
    unset($database);
}


function populaForm($iddb, $databaseObj)
{

    /* Código alterado para permitir controle de usuários */
    if ($_SESSION['USER']->type == 9) { // usuário adm - type = 9... array vazio para trazer tudo
        $query = "SELECT * FROM dbncrna d WHERE d.IDDB = {$iddb} limit 1";
    } else if ($_SESSION['USER']->type == 1) { // usuário comum - type = 1 ... array com seu id para trazes somente seus dbs
        $query = "SELECT * FROM dbncrna d WHERE d.IDDB = {$iddb} AND d.iduser = {$_SESSION['USER']->iduser} limit 1";
    }


    $resultado = $databaseObj->banco->query($query);

    if (($resultado->num_rows != 0) AND (is_object($resultado))) {

        $database = $resultado->fetch_object();

        //PubmedID
        $query = "SELECT p.PubmedID FROM pubmedid as p WHERE IDDB = {$iddb}";
        $resultado = $databaseObj->banco->query($query);
        $array = array();
        if (is_object($resultado)) {
            while ($value = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $array[] = $value['PubmedID'];
            }
            $database->pubmedid = implode(", ", $array);
        } else {
            $database->pubmedid = '';
        }

        //Information Source
        $query = "SELECT i.IDInfoSource FROM infosourcedbs as i WHERE i.IDDB = {$iddb}";
        $resultado = $databaseObj->banco->query($query);
        $array = array();
        if (is_object($resultado)) {
            while ($value = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $array[] = $value['IDInfoSource'];
            }
            $database->informationsource = $array;
        } else {
            $database->informationsource = array();
        }

        //Search Methods
        $query = "SELECT s.IDMethod, s.Description FROM searchmethod as s WHERE s.IDDB = {$iddb}";
        $resultado = $databaseObj->banco->query($query);
        $array = array();
        if (is_object($resultado)) {
            while ($value = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $array[] = $value;
            }
            $database->searchMethods = $array;
        } else {
            $database->searchMethods = array();
        }

        //Download
        $query = "SELECT d.Type FROM download as d WHERE d.IDDB = {$iddb}";
        $resultado = $databaseObj->banco->query($query);
        $array = array();
        if (is_object($resultado)) {
            while ($value = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $array[] = $value['Type'];
            }
            $database->download = $array;
        } else {
            $database->download = array();
        }

        //Information Content
        $query = "SELECT t.* FROM informationcontent as i INNER JOIN term as t ON i.IDTerm = t.IDTerm WHERE i.IDDB = {$iddb}";
        $resultado = $databaseObj->banco->query($query);
        $array = array();
        if (is_object($resultado)) {
            while ($value = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $array[] = $value;
            }
            $database->informationContent = $array;
        } else {
            $database->informationContent = array();
        }

    } else {
        die("Você não tem permissão para ver esses dados");
    }

    return $database;
}