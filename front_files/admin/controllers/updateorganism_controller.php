<?php

$organismObj = new organism();


if(isset($_GET['id']) AND empty($_POST)){

    $organism = populaForm($_GET['id'], $organismObj);


    //Delete
    if(isset($_GET['action']) AND $_GET['action'] == "delete"){

        $retorno = $organismObj->deleteOrganism($_GET['id']);

        if($retorno == "success"){
            echo "<script> window.open('manageorganism.php', '_self'); </script>";
        }else{
            echo "<script> window.response = 'errordb';</script>";
        }
    }


}else if(!empty($_POST)){
    //Update
    //echo "<pre>"; print_r($_POST);die;
    $retorno = $organismObj->updateOrganism($_POST['IDOrganism'], $_POST['name'], $_POST['cname']);

    $organism = populaForm($_POST['IDOrganism'], $organismObj);

    if($retorno == "success"){
        echo "<script> window.response = 'success';</script>";
    }else{
        echo "<script> window.response = 'error';</script>";
    }

}
else{
    die();
}





function populaForm($idOrganism, $organismDB){

    $query = "SELECT * FROM organism WHERE IDOrganism = ".$idOrganism." limit 1";
    $resultado = $organismDB->banco->query($query);

    if (($resultado->num_rows != 0) AND (is_object($resultado))) {
        $organism = $resultado->fetch_object();
    }else{
        die('organismo não encontrada');
    }

    return $organism;
}