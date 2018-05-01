<?php

settype($databaseID, "integer" );

if(!empty($_GET['database'])){
    $databaseID = $_GET['database'];
}else{
    $databaseID = 0;
}

$banco_ = new ncrnaMain();
$databaseDetails = $banco_->getDetailsDatabase($databaseID);
//echo "<pre>";print_r($databaseDetails);echo "</pre>";
