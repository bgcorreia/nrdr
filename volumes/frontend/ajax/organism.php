<?php
include_once("../_database.php");
include_once("../models/ncrnaMain.php");
$dbOrganism = new ncrnaMain();
settype($partOrganism, "String");

if(isset($_GET['organism-ajax'])){
   $partOrganism = $_GET['organism-ajax'];
}else{
   $partOrganism = ' ';
}

$return = $dbOrganism->getOrganismForAjax($partOrganism);
$json = json_encode($return);
unset($dbOrganism);
print_r($json);

?>