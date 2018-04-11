<?php

settype($databaseID, "integer" );

$fromDirectList = false;
if(!empty($_GET['from'])){
    $fromDirectList = true;
}

if(!empty($_GET['database'])){
    $databaseID = $_GET['database'];
}else{
    $databaseID = 0;
    die();
}

$banco_ = new ncrnaMain();
$databaseDetails = $banco_->getDetailsDatabase($databaseID);
$organismList = $banco_->getOrganismByIDDB($databaseID);

