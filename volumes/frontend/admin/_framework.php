<?php
/* Inicia uma sessão */
session_start();


/* Definindo o base_url. configurar caso der poblemas com diretórios */
define("BASE_URL","../");
$current = basename($_SERVER["SCRIPT_FILENAME"], '.php');

/* Verificando a existencia de uma sessão */
IF(!ISSET($_SESSION['USER']) AND ($current != "index")){
    header("Location: index.php");
}ELSE IF(ISSET($_SESSION['USER']) AND ($current == "index")){
    header("Location: admin.php");
}

/* Definindo o include do arquivo com os define do databse */
include_once(BASE_URL."_database.php");
/* Incluir todas as models que for usar */
include_once(BASE_URL."models/ncrnaMain.php");
include_once(BASE_URL."models/adminUser.php");
include_once(BASE_URL."models/crudAdmin.php");

$_ERROR = NULL;
$_SUCCESS = NULL;

/* Define a controller para a pagina atual automaticamente - não precisar configurar - e deve ser no mesmo diretório  */
include_once(BASE_URL.'admin/controllers/'.$current.'_controller.php');

/* Printa retorno de sucesso ou erro se Houver */
if(!empty($_ERROR)){
    echo "<script> window.response_error = '{$_ERROR}';</script>";
}else if(!empty($_SUCCESS)){
    echo "<script> window.response_success = '{$_SUCCESS}';</script>";
}