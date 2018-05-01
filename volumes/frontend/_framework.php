<?php
/* Definindo o base_url. configurar caso der poblemas com diretórios */
define("BASE_URL","./");
$current = basename($_SERVER["SCRIPT_FILENAME"], '.php');

/* Definindo o include do arquivo com os define do databse */
include_once(BASE_URL."_database.php");
/* Incluir todas as models que for usar */
include_once(BASE_URL."models/ncrnaMain.php");
/* Inclue a classe de alinhamento */
include_once(BASE_URL."libs/blastHelper.php");

/* Define a controller para a pagina atual automaticamente - não precisar configurar (Por último)*/
include_once(BASE_URL."controllers/".$current."_controller.php");


/* Printa retorno de sucesso ou erro se Houver */
if(!empty($_ERROR)){
    echo "<script> window.response_error = '{$_ERROR}';</script>";
}else if(!empty($_SUCCESS)){
    echo "<script> window.response_success = '{$_SUCCESS}';</script>";
}