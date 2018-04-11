<?php
define("BASE_URL", "../../");
/* Definindo o include do arquivo com os define do databse */
include_once(BASE_URL . "_database.php");
/* Incluir todas as models que for usar */
include_once(BASE_URL . "models/crudAdmin.php");


//TODOS INNER ALTERADOS PARA RIGHT JOIN

/* Parte reescrita para controlar acesso do usuário o database
 * Precisa chegar o tipo de usuário; se for type = 1 (usuário comum) se for type = 9 (user adm - trás tudo)
 * */
session_start();
if ($_SESSION['USER']->type == 9) { // usuário adm - type = 9... array vazio para trazer tudo
    $query = "SELECT s.IDSequence, s.Header, s.Sequence FROM sequence as s WHERE 1 = 1";
    $queryCount = "SELECT COUNT(s.IDSequence) FROM sequence as s  WHERE 1 = 1";
} else if ($_SESSION['USER']->type == 1) { // usuário comum - type = 1 ... array com seu id para trazes somente seus dbs
    $query = "SELECT s.IDSequence, s.Header, s.Sequence FROM sequence as s RIGHT JOIN dbncrna as d ON d.iddb = s.iddb WHERE d.iduser = {$_SESSION['USER']->iduser}";
    $queryCount = "SELECT COUNT(s.IDSequence) FROM sequence as s RIGHT JOIN dbncrna as d ON d.iddb = s.iddb WHERE d.iduser = {$_SESSION['USER']->iduser}";
}



$sequence = new sequence();


//Pegando valores do filtro
if (!empty($_POST['filter1'])) {
    $querysub = "SELECT d.IDDB FROM dbncrna as d WHERE d.Name = '" . $_POST['filter1'] . "' limit 1";
    $result = $sequence->banco->query($querysub);
    if ($result->num_rows == 1) {
        $objDatabase = $result->fetch_object();
        $query .= " AND s.IDDB = " . $objDatabase->IDDB;
        $queryCount .= " AND s.IDDB = " . $objDatabase->IDDB;
    }
}
if (!empty($_POST['filter2'])) {
    $query .= " AND s.header LIKE '%" . $_POST['filter2'] . "%'";
    $queryCount .= " AND s.header LIKE '%" . $_POST['filter2'] . "%'";
}
if (!empty($_POST['filter3'])) {
    $query .= " AND s.sequence LIKE '%" . $_POST['filter3'] . "%'";
    $queryCount .= " AND s.sequence LIKE '%" . $_POST['filter3'] . "%'";
}


//set_time_limit(300);
$resultadoCount = $sequence->banco->query($queryCount);
if ($resultadoCount->num_rows != 0) {
    $qtdLinhasTmp = $resultadoCount->fetch_row();
    $qtdLinhas = $qtdLinhasTmp[0];
}

$pagHelp = FALSE;

if (!empty($_POST['paginacao'])) {
    $paginacao = $_POST['paginacao'];
    if ($paginacao == 'first') {
        $paginacao = 0;
    } else if ($paginacao == 'last') {
        $paginacao = ceil((($qtdLinhas-30) / 30));
        $pagHelp = TRUE;
    } else{
        $paginacao--;
    }
} else {
    $paginacao = 0;
}

/* o order by estava deixando a query muito lenta, por isso foi comentado... agora vai trazer sem
 * ordenação
 * $query .= " ORDER BY s.IDSequence DESC LIMIT " . ($paginacao * 30) . ", 30";
 */

$query .= " LIMIT " . ($paginacao * 30) . ", 30";

//echo $query."<br>";echo $queryCount;die;

$resultado = $sequence->banco->query($query);

if (@$resultado->num_rows > 0) {
    while ($value = $resultado->fetch_assoc()) {
        $array[] = $value;
    }
} else {
    $array = null;
}

echo "<div id='qtdLinhas' class='pull-right'>".$qtdLinhas." rows returned.</div>"
?>

<table id='tabelaGrid' class="table table-bordered table-hover table-condensed" style="background-color: #fff">
    <thead>
    <tr class="success" id="cabecalho">
        <th class="col-md-1">#</th>
        <th class="col-md-6" style="line-break: normal!important;word-break: break-all!important;word-wrap: break-word!important;">
            Header
        </th>
        <th class="col-md-6">
            Sequence
        </th>
    </tr>
    </thead>


    <tbody>
    <?php
    if($array != null){
        foreach ($array as $value) {
            $string = (strlen($value['Sequence']) > 30) ? substr($value['Sequence'], 0, 30) . '...' : $value['Sequence'];
            echo "<tr style='cursor: pointer' class='clicavel' id='" . $value['IDSequence'] . "'>";
            echo "<td>" . $value['IDSequence'] . "</td>";
            echo "<td>" . $value['Header'] . "</td>";
            echo "<td>" . $string . "</td>";
            echo "</tr>";
        }
    }else{
        echo "<tr style='cursor: pointer' >";
        echo "<td> 0 </td>";
        echo "<td><a href='insertsequence.php'>No sequences yet, insert a new sequence</a></td>";
        echo "<td> </td>";
        echo "</tr>";
    }

    ?>
    </tbody>
</table>

<div style="text-align: center; margin-top: -20px">
    <ul class="pagination">
        <?php
        $paginacao++;
        if (($qtdLinhas / 30) < 5) {
            $qtdTag = ceil(($qtdLinhas / 30));
        } else {
            $qtdTag = 5;
        }

        if ($paginacao < 5 AND $qtdTag!=1) {
            echo "<li class='paginacao disabled' value='first'><a href='#'>&laquo;</a></li>";
            for ($i = 1; $i <= $qtdTag; $i++) {
                if ($paginacao == $i) {
                    echo "<li class='disabled'><a href='#'>" . $i . "</a></li>";
                } else {
                    echo "<li class='paginacao' value = '" .$i. "'><a href='#'>" . $i . "</a></li>";
                }
            }
            echo "<li class='paginacao' value='last'><a href='#'>&raquo;</a></li>";
        }else if(($pagHelp) AND ($qtdTag!=1)) {
            echo "<li class='paginacao' value='first'><a href='#'>&laquo;</a></li>";
            echo "<li class='paginacao' value = '" . ($paginacao - 4) . "'><a  href='#'>" .($paginacao - 4) . "</a></li>";
            echo "<li class='paginacao' value = '" . ($paginacao - 3) . "'><a href='#'>" . ($paginacao - 3) . "</a></li>";
            echo "<li class='paginacao' value = '" . ($paginacao - 2) . "'><a href='#'>" . ($paginacao - 2) . "</a></li>";
            echo "<li class='paginacao' value = '" . ($paginacao - 1) . "'><a href='#'>" . ($paginacao - 1) . "</a></li>";
            echo "<li class='disabled '><a href='#'>" . $paginacao . "</a></li>";
            echo "<li class='paginacao disabled' value='last'><a href='#'>&raquo;</a></li>";
        }
        else if($qtdTag!=1) {
            echo "<li class='paginacao' value='first'><a href='#'>&laquo;</a></li>";
            echo "<li class='paginacao' value = '" . ($paginacao - 2) . "'><a  href='#'>" . ($paginacao - 2) . "</a></li>";
            echo "<li class='paginacao' value = '" . ($paginacao - 1) . "'><a href='#'>" . ($paginacao - 1) . "</a></li>";
            echo "<li class='disabled '><a href='#'>" . $paginacao . "</a></li>";
            echo "<li class='paginacao' value = '" . ($paginacao + 1) . "'><a href='#'>" . ($paginacao + 1) . "</a></li>";
            echo "<li class='paginacao' value = '" . ($paginacao + 2) . "'><a href='#'>" . ($paginacao + 2) . "</a></li>";
            echo "<li class='paginacao' value='last'><a href='#'>&raquo;</a></li>";
        } ?>
    </ul>
</div>

<script>
    $('#filter').click(function(){
        $('#cabecalho').removeClass('success');
        $('#cabecalho').addClass('danger');
        $('#qtdLinhas').html("Loading...");
    });

    $('.clicavel').click(function(event){
        id = $(this).attr('id')
        window.open("updatesequence.php?id="+id,"_self");
    });

    $('.paginacao').click(function(event){
        acao = $(this).attr('value');
        $('#cabecalho').removeClass('success');
        $('#cabecalho').addClass('danger');
        $('#qtdLinhas').html("Loading...");
        $.ajax({
            type: 'POST',
            dataType: 'HTML',
            timeout: 80000,
            url: 'ajax/grid_sequences.php',
            data: {
                filter1: window.filter1,
                filter2: window.filter2,
                filter3: window.filter3,
                paginacao: acao
            }
        }).done(function (e) {
                $('#grid').html(e);

            }).error(function(jqXHR, textStatus, errorThrown){
                alert('Fail: Time out'+ textStatus);
            });
    });
</script>






