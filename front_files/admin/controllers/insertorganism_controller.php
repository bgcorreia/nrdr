<?php

$organism = new organism();

if(!empty($_POST)){
    /* echo "<pre>";
    print_r($_POST);*/
    $retorno = $organism->insertOrganism($_POST['name'], $_POST['cname']);
    if($retorno == "success"){
        echo "<script> window.response = 'success';</script>";
    }else{
        echo "<script> window.response = 'error';</script>";
    }

}else{

}
