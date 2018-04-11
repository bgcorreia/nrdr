<?php
$sequenceObj = new sequence();
$rnaTypes = $sequenceObj->getRnaType();

if(isset($_GET['id']) AND empty($_POST)){

    $sequence = populaForm($_GET['id'], $sequenceObj );



    //Delete
    if(isset($_GET['action']) AND $_GET['action'] == "delete"){
        $retorno = $sequenceObj->deleteSequence($_GET['id'], $_SESSION['USER']->iduser, $_SESSION['USER']->type);

        if($retorno == "success"){
            echo "<script> window.open('managesequence.php', '_self'); </script>";
        }else{
            echo "<script> window.response = 'errordb';</script>";
        }
    }


}else if(!empty($_POST)){
    //Update
    //echo "<pre>"; print_r($_POST);die;
    $retorno = $sequenceObj->updateSequence($_POST['IDSequence'], $_POST['database'], $_POST['organism'],
        $_POST['rnatype'], $_POST['header'], $_POST['description'], $_POST['sequence'], $_SESSION['USER']);

    $sequence = populaForm($_POST['IDSequence'], $sequenceObj);

    if($retorno == "success"){
        echo "<script> window.response = 'success';</script>";
    }else{
        echo "<script> window.response = 'error';</script>";
    }

}
else{
    die();
}

function populaForm($idSequence, $sequenceDB){

    /* Código alterado para permitir controle de usuários */
    if ($_SESSION['USER']->type == 9) { // usuário adm - type = 9... array vazio para trazer tudo
        $query = "SELECT s.* FROM sequence as s WHERE s.IDSequence = {$idSequence} limit 1";
    } else if ($_SESSION['USER']->type == 1) { // usuário comum - type = 1 ... array com seu id para trazes somente seus dbs
        $query = "SELECT s.* FROM sequence as s INNER JOIN dbncrna as d ON d.iddb = s.iddb WHERE d.iduser = {$_SESSION['USER']->iduser} AND s.IDSequence = {$idSequence} limit 1";
    }


    $resultado = $sequenceDB->banco->query($query);

    if (($resultado->num_rows != 0) AND (is_object($resultado))) {
        $sequence = $resultado->fetch_object();
    }else{
        die('sequencia não encontrada');
    }

    $query = "SELECT Name FROM dbncrna WHERE IDDB = ".$sequence->IDDB." limit 1";
    $resultado = $sequenceDB->banco->query($query);
    if (is_object($resultado)) {
        $databases = $resultado->fetch_object();
        $sequence->dbName = $databases->Name;
    }else{
        $sequence->dbName = "";
    }

    $query = "SELECT Name FROM organism WHERE IDOrganism = ".$sequence->IDOrganism." limit 1";
    $resultado = $sequenceDB->banco->query($query);
    if (is_object($resultado)) {
        $organisms = $resultado->fetch_object();
        $sequence->organismName = $organisms->Name;
    }else{
        $sequence->organismName = "";
    }

    return $sequence;
}