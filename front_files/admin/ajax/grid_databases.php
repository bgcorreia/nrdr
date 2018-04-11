<?php
define("BASE_URL", "../../");
/* Definindo o include do arquivo com os define do databse */
include_once(BASE_URL . "_database.php");
/* Incluir todas as models que for usar */
//include_once(BASE_URL . "models/crudAdmin.php");
include_once(BASE_URL . "models/ncrnaMain.php");

/* Parte reescrita para controlar acesso do usuário o database
 * Precisa chegar o tipo de usuário; se for type = 1 (usuário comum) se for type = 9 (user adm - trás tudo)
 * */
session_start();
if ($_SESSION['USER']->type == 9) { // usuário adm - type = 9... array vazio para trazer tudo
    $array_parametros = array();
} else if ($_SESSION['USER']->type == 1) { // usuário comum - type = 1 ... array com seu id para trazes somente seus dbs
    $array_parametros = array("dbncrna" => array("iduser" => $_SESSION['USER']->iduser));
}


$ncrna = new ncrnaMain();
$resultado = $ncrna->getDataBaseNames($array_parametros);

//echo "<pre>";print_r($resultado);die;


if (count($resultado) > 0) {
    $array = $resultado;
} else {
    $array = null;
    /*  $array[0]['IDDB'] = '';
      $array[0]['Name'] = '';
      $array[0]['qtd_org'] = '';*/
}
echo "<div id='qtdLinhas' class='pull-right'>" . count($array) . " rows returned.</div>" ?>

<table id='tabelaGrid' class="table table-bordered table-hover table-condensed" style="background-color: #fff">
    <thead>
    <tr class="success" id="cabecalho">
        <th class="col-md-1">#</th>
        <th class="col-md-6"
            style="line-break: normal!important;word-break: break-all!important;word-wrap: break-word!important;">
            Database Name
        </th>
        <th class="col-md-6">
            Organism's Information
        </th>
    </tr>
    </thead>


    <tbody>
    <?php
    if ($array != null) {
        foreach ($array as $value) {

            echo "<tr style='cursor: pointer' class='clicavel' id='" . $value['IDDB'] . "'>";
            echo "<td>" . $value['IDDB'] . "</td>";
            echo "<td>" . $value['Name'] . "</td>";
            echo "<td>" . $value['qtd_org'] . "</td>";
            echo "</tr>";

        }
    }else {
        echo "<tr style='cursor: pointer' class=''>";
        echo "<td> 0 </td>";
        echo "<td><a href='insertdatabase.php'>No database yet, insert a new database</a></td>";
        echo "<td> </td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>


<script>
    $('#filter').click(function () {
        $('#cabecalho').removeClass('success');
        $('#cabecalho').addClass('danger');
        $('#qtdLinhas').html("Loading...");
    });

    $('.clicavel').click(function (event) {
        id = $(this).attr('id')
        window.open("updatedatabase.php?id=" + id, "_self");
    });
</script>





