<?php

$banco_ = new ncrnaMain();
$rnaTypes = $banco_->getRnaType();

if (!empty($_POST)) {

    //Nome do database
    $name = (empty($_POST['dbncrna']['name']) ? null : $_POST['dbncrna']['name']);
    $arrayRna = (empty($_POST['rnatype']) ? 0 : $_POST['rnatype']);
    $organismo = (empty($_POST['organism']['name']) ? null : $_POST['organism']['name']);
    $sequence = fasta2Array($_POST['sequence']);


    /* Inclue a classe de alinhamento */
    $blastHelper = new blastHelper($name, $arrayRna, $organismo);
    $senquencia_source = $blastHelper->retornaArraySeq();
    $seqb = strtoupper($senquencia_source[0]['Sequence']);
    $seqa = strtoupper($sequence[0]['sequence']);


    /* ve se é proteina ou dna */
    if ((substr_count($seqa, "A") + substr_count($seqa, "C") + substr_count($seqa, "G") + substr_count($seqa, "T")) > (strlen($seqa) / 2)) {
        // if A+C+G+T is at least half of the sequence, it is a DNA		
        $alignment = @$blastHelper->align_DNA($seqa, $seqb);
    } else {
        // else is protein
        $alignment = @$blastHelper->align_proteins($seqa, $seqb);
    }

    // EXTRACT DATA FROM ALIGNMENT
    $align_seqa = $alignment["seqa"];
    $align_seqb = $alignment["seqb"];

    // COMPARE ALIGNMENTS 
    $compare = $blastHelper->compare_alignment($align_seqa, $align_seqb);

    $i = 0;
    while($i<strlen($align_seqa)){
        $ii=$i+100;
        if ($ii>strlen($align_seqa)){$ii=strlen($align_seqa);}
        $align_seqa =  substr($align_seqa,$i,100)."  $ii\n";
        $compare =  substr($compare,$i,100)."\n";
        $align_seqb = substr($align_seqb,$i,100)."  $ii\n\n";
        $i+=100;
   }
   
      echo "<pre>{$align_seqa}";
    echo "{$compare}";
    echo "{$align_seqb}</pre>";
    
    
    die;

    /* foreach ($sequence as $value) {
      $retorno = $blastHelper->blast($value[sequence]);
      }
      echo "<pre>";
      print_r($blastHelper->retornaArraySeq());
      echo "</pre>";
      die; */
}

function fasta2Array($input) {
    $arrayFinal = [];
    $arraySeq = array_filter(explode(">", $input));
    foreach ($arraySeq as $value) {
        $arrayTemp['header'] = substr($value, 0, strpos($value, "\n"));
        $arrayTemp['sequence'] = trim(strip_tags(preg_replace('/\s\s+/', '', substr($value, strpos($value, "\n")))));
        array_push($arrayFinal, $arrayTemp);
        unset($arrayTemp);
    }
    return $arrayFinal;
}
