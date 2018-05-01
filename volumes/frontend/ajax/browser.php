<?php
include_once("../_database.php");
include_once("../models/ncrnaMain.php");
$database = new ncrnaMain();
settype($input, "String");

if(isset($_GET['browser-ajax'])){
    $input = $_GET['browser-ajax'];
}else{
    $input = ' ';
}

if($input == 'rnatype'){
    $output = $database->getRnaFamilies();
}else if ($input == 'informationsource'){
    $output = $database-> getAllInformationSource();
}else if ($input == 'informationcontent'){
    $output = $database->getAllTerm();
}else if ($input == 'searchmethod'){
    $output = $database->getAllMethods();
}

$json = json_encode($output);
unset($database);
print_r($json);
?>