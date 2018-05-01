<?php
$sequence = new sequence();
$rnaTypes = $sequence->getRnaType();

//echo $_SESSION['USER']->iduser;
if(!empty($_POST)){
   /* echo "<pre>";
   print_r($_POST);*/
   $retorno = $sequence->insertNewSequence($_POST['database'], $_POST['organism'], $_POST['rnatype'], $_POST['header'], $_POST['description'], $_POST['sequence'], $_SESSION['USER']);
   if($retorno == "success"){
       echo "<script> window.response = 'success';</script>";
   }else{
       echo "<script> window.response = 'error';</script>";
   }

}else{

}








//Algum erro
