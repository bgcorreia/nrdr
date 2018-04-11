<?php
define("BASE_URL", "../../");
/* Definindo o include do arquivo com os define do databse */
include_once(BASE_URL . "_database.php");
/* Incluir todas as models que for usar */
include_once(BASE_URL . "models/crudAdmin.php");

$organism = new organism();

//TODOS INNER ALTERADOS PARA RIGHT JOIN
$query = "SELECT o.IDOrganism, o.Name, o.CName FROM organism as o";
$queryCount = "SELECT COUNT(o.IDOrganism) FROM organism as o";


//Pegando valores do filtro
if (!empty($_POST['filter1'])) {
    $querysub = "SELECT d.IDDB FROM dbncrna as d WHERE d.Name = '" . $_POST['filter1'] . "' limit 1";
    $result = $organism->banco->query($querysub);

    if ($result->num_rows == 1) {

        $objDatabase = $result->fetch_object();
        $query .=      " RIGHT JOIN dborganism as do ON o.IDOrganism = do.IDOrganism AND do.IDDB = ". $objDatabase->IDDB;
        $queryCount .= " RIGHT JOIN dborganism as do ON o.IDOrganism = do.IDOrganism AND do.IDDB = ". $objDatabase->IDDB;
    }
}

$query .=      " WHERE 1 = 1";
$queryCount .= " WHERE 1 = 1";

if (!empty($_POST['filter2'])) {
    $query .=      " AND o.Name LIKE '%" . $_POST['filter2'] . "%'";
    $queryCount .= " AND o.Name LIKE '%" . $_POST['filter2'] . "%'";
}
if (!empty($_POST['filter3'])) {
    $query .=      " AND o.CName LIKE '%" . $_POST['filter3'] . "%'";
    $queryCount .= " AND o.CName LIKE '%" . $_POST['filter3'] . "%'";
}

//echo $queryCount; die;

set_time_limit(300);
$resultadoCount = $organism->banco->query($queryCount);
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


$query .= " ORDER BY o.IDOrganism DESC LIMIT " . ($paginacao * 30) . ", 30";

//echo $query; die;

$resultado = $organism->banco->query($query);

if ($resultado->num_rows != 0) {
    while ($value = $resultado->fetch_assoc()) {
        $array[] = $value;
    }
} else {
    $array[0]['IDOrganism'] = '';
    $array[0]['Name'] = '';
    $array[0]['CName'] = '';
}
echo "<div id='qtdLinhas' class='pull-right'>".$qtdLinhas." rows returned.</div>" ?>

<table id='tabelaGrid' class="table table-bordered table-hover table-condensed" style="background-color: #fff">
    <thead>
    <tr class="success" id="cabecalho">
        <th class="col-md-1">#</th>
        <th class="col-md-6" style="line-break: normal!important;word-break: break-all!important;word-wrap: break-word!important;">
            Organism's Scientific Name
        </th>
        <th class="col-md-6">
            Organism's Common Name
        </th>
    </tr>
    </thead>


    <tbody>
    <?php
    foreach ($array as $value) {

        echo "<tr style='cursor: pointer' class='clicavel' id='" . $value['IDOrganism'] . "'>";
        echo "<td>" . $value['IDOrganism'] . "</td>";
        echo "<td>" . $value['Name'] . "</td>";
        echo "<td>" . $value['CName'] . "</td>";
        echo "</tr>";

    } ?>
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
        window.open("updateorganism.php?id="+id,"_self");
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
            url: 'ajax/grid_organisms.php',
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






