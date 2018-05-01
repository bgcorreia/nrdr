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
if(isset($_GET['iddb'])){
   $iddb = $_GET['iddb'];
}else{
   $iddb = 0;
}


$return = $dbOrganism->getOrganismForAjaxDownloadPage($partOrganism, $iddb);
$json = json_encode($return);
unset($dbOrganism);
print_r($json);

?>