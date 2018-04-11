<?php
set_time_limit(6000000);
ini_set('memory_limit', '200000M');
$banco_ = new ncrnaMain();
$rnaTypes = $banco_->getRnaFamiliesForAjax(null, null);
$arrayDB = $banco_->getDatabaseForAjax(null, null);



 if(!empty($_GET['param'])){
    $file = $_GET['param'];
    $absolute = './files/download-temp/'.$file;
    
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$file);
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($absolute));
    ob_clean();
    flush();
    readfile($absolute);
    exit;
  }
