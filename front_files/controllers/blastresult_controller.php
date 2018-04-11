<?php
include_once("/libs/blastHelper.php");
$array_arguments = $_POST;
$banco_ = new ncrnaMain();

$arraySequence = $banco_->getSequencesBlast($array_arguments);

foreach($arraySequence as $key => $value){
    $alinhamento = alinhaSeq($array_arguments['sequence'],$value['Sequence']);
    $arraySequence[$key]["retorno"] = $alinhamento;
}

//print_r($arraySequence);die;





