<?php
include_once("../_database.php");
include_once("../models/ncrnaMain.php");
$ajaxObj = new ncrnaMain();

$organism = null;
$rnaType  = null;


if(isset($_GET['organism'])){
    $organism = $_GET['organism'];
}
if(isset($_GET['rnaType'])){
    $rnaType = $_GET['rnaType'];
}


$array = $ajaxObj->getDatabaseForAjax($organism, $rnaType);
unset($ajaxObj);
echo "<option value='0'>All</option>";
foreach ($array as $value) {
     echo "<option value='" . $value['IDDB'] . "'>" . $value['Name'] . "</option>";
}

?>