<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
</head>

<body>

<?php include(BASE_URL . 'header.php'); ?>


<div id="main">

    <div class="container">


        <ol class="breadcrumb">
            <li>Blast Result</li>
        </ol>
        <br>

        <table class="table table-hover table-striped table-condensed">
            <thead>
            <tr>
                <th>Database Name</th>
                <th>Organism</th>
                <th>Sequence</th>
                <th style="width: 30px">Score</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($arraySequence as $value){
                echo "<tr>";
                echo "<td>".$value['databaseName']."</td>";
                echo "<td>".$value['organismName']."</td>";
                echo "<td>{$value['Sequence']}<br>{$value['retorno']['sequencia']}</td>";
                echo "<td>".$value['retorno']['score']."</td>";
                echo "</tr>";
            } ?>
            </tbody>
        </table><br><br>

    </div>
    <?php include(BASE_URL.'infoline.php'); ?>

    <?php include(BASE_URL.'footer.php'); ?>
</body>
</html>