<?php
include_once("../_database.php");
include_once("../models/ncrnaMain.php");
$dbNCrnabanco = new ncrnaMain();
settype($partDBncrna, "String");

if(isset($_GET['dbncrna-ajax'])){
    $partDBncrna = $_GET['dbncrna-ajax'];
}else{
    $partDBncrna = ' ';
}

$return = $dbNCrnabanco->getncRNAdb($partDBncrna);
$json = json_encode($return);
unset($dbNCrnabanco);
print_r($json);

?>