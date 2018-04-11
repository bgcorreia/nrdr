<?php

//Faz um if para verificar se os argumentos vem da pagina search, ou por $_get das paginas browser e statistics
$array_arguments = array();

if(!empty($_POST)){
    $array_arguments = $_POST;
}else if(!empty($_GET)){
    $array_arguments = $_GET;

    if(isset($array_arguments['rnatype'])){
        $array_arguments['dbncrna']['RNAType'] = $array_arguments['rnatype'];
        unset($array_arguments['rnatype']);
    }

}

$banco_ = new ncrnaMain();

$databaseList = $banco_->getDataBaseNames($array_arguments);
//echo "<pre>"; print_r($array_arguments); echo "</pre>"; die;

unset($banco_);