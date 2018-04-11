<?php

include_once("class.simple_mail.php");

$dbrna = new ncrnaMain();
$methods = $dbrna->getAllMethods();
$informationSource = $dbrna->getAllInformationSource();
$informationContent = $dbrna->getAllTerm();



if(!empty($_POST)){

    //obter organismos a partir do arquivo organismos
    if(!empty($_FILES['fileorganism']['tmp_name'])){
        if($_FILES['fileorganism']['error'] > 0 OR $_FILES['fileorganism']['type'] != 'text/plain'){
            //Erro no arquivo
            $_ERROR = "Error with File ". $_FILES['fileorganism']['name'];
        }else{
            //Arquivo Ok.
            $listOrganism = file($_FILES['fileorganism']['tmp_name']);
            unlink($_FILES['fileorganism']['tmp_name']);
            $_POST['organisms'] = $listOrganism;
        }
    }


    if($dbrna->submitExternalDatabase($_POST)){
            $_SUCCESS = "Database submitted successfully, wait for data analysis and we will contact you soon.<br>For questions please contact paschoal@utfpr.edu.br";
        }else{
            if(empty($_ERROR)){
                $_ERROR = "Database submit error, please contact the database administrator";
            }
        }


    /*Verifica se ele tem algum tipo de download pra setar variavel download.
    $download = (!empty($_POST['downloadType']) ? 1 : 0);*/


}