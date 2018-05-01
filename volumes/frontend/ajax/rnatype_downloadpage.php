<?php
include_once("../_database.php");
include_once("../models/ncrnaMain.php");
$ajaxObj = new ncrnaMain();

$organism = null;
$iddb  = null;


if(isset($_GET['organism'])){
    $organism = $_GET['organism'];
}
if(isset($_GET['iddb'])){
    $iddb = $_GET['iddb'];
}


$array = $ajaxObj->getRnaFamiliesForAjax($iddb, $organism);

if(!$iddb){
    echo "<option value='0'>All</option>";
}
foreach ($array as $value) {
     echo "<option value='" . $value['IDRNAType'] . "'>" . $value['IDRNAType'] . "</option>";
}

?>