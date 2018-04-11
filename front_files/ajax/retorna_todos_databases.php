<?php

include_once("../_database.php");
include_once("../models/ncrnaMain.php");
$dbNCrnabanco = new ncrnaMain();

$query = "SELECT d.IDDB FROM dbncrna as d";
$resul = $dbNCrnabanco->banco->query($query);
while ($value = $resul->fetch_array(MYSQLI_ASSOC)) {
    $array[] = $dbNCrnabanco->getDetailsDatabase($value['IDDB']);
}

//echo "<pre>";
//print_r($array);
//echo "</pre>";


foreach ($array as $value) {
    echo "<pre>";
    $value['MultipleSearch'] = ($value['MultipleSearch'] ? 'Yes' : "No");
    $value['Download'] = ($value['MultipleSearch'] ? $value['TypeDownload'] : "No");
    $value["GraphicView"] = ($value['GraphicView'] ? 'Yes' : "No");

    //Conta organismos
    if ($value["CountOrganism"] > 1) {
        $value["Organism"] =  "{$value["Organism"]} and {$value["CountOrganism"]} others.";
    } else {
        $value["Organism"] = "{$value["Organism"]}.";
    }

    echo "Database Name: {$value['Name']}\n";
    echo "RNA Type: {$value['RNAType']}\n";
    echo "Overview: {$value['Overview']}\n";
    echo "Search Methods:\n";

    foreach ($value['searchmethod'] as $valueS) {
        echo "\t{$valueS['Method']}: {$valueS['Description']}\n";
    }

    echo "Source: {$value['Source']}\n";
    echo "Information Source: {$value['informationsource']}\n";
    echo "Information Content: {$value['informationcontent']}\n";
    echo "Reference: {$value['Reference']}\n";
    echo "PubmedID: {$value['pubmedid']}\n";
    echo "Year: {$value['Year']}\n";
    echo "Multiple search: {$value['MultipleSearch']}\n";
    echo "Download: {$value['Download']}\n";
    echo "Genomic overview: {$value['GraphicView']}\n";
    echo "Organism: {$value["Organism"]}\n";
    echo "URL: {$value['Site']}\n";
    echo "\r\n";
    echo "</pre>";
}