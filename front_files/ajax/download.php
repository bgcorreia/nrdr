<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

set_time_limit(6000000);
ini_set('memory_limit', '200000M');

include_once("../_database.php");
include_once("../libs/downloadHelper.php");

$downloadHelper = new downloadHelper();

/* ajuste para retirar o rnaType */
$_GET['rnatype'] = 0;

if(isset($_GET['organism']) && isset($_GET['iddb']) && isset($_GET['rnatype'])){
    $organism = $_GET['organism'];
    $iddb = $_GET['iddb'];
    $rnatype  = $_GET['rnatype'];
    $databasename = $_GET['databasename'];
}else{
    die();
}


//gerando o nome do arquivo
$nomeArq = "";
$nomeArq.= ($databasename != null ? "{$databasename}-" : "");
$nomeArq.= ($organism != null ? "{$organism}-" : "");
$nomeArq.= ($rnatype  != null ? "{$rnatype}-"  : "");
$nomeArq.= "nrdr2.fa";
$nomeArq = str_replace(' ', '', $nomeArq);

$filename = "../files/download-temp/{$nomeArq}";

if (!file_exists($filename)) {
    $retorno = $downloadHelper->retornaSequencias($iddb, $organism, $rnatype);
   
    if(count($retorno) > 0){
        //$dados = $downloadHelper->arrayToFasta($retorno);
        $dados = "";
         foreach ($retorno as $value) {
            $dados.= $value['Header'].PHP_EOL;
            $dados.= $value['Sequence'].PHP_EOL;
        }       
        $fp = fopen($filename,"wb");
        fwrite($fp,$dados);
        fclose($fp);
        print $nomeArq;
    }else{
        header("HTTP/1.0 403 Forbidden");
        print 'No match results for this query';
    } 
}else{
    print $nomeArq;
}









