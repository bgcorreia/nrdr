<?php

//echo "<pre>";

$banco_ = new ncrnaMain();
$rnaTypeList = $banco_->getRnaFamilies();
$Term = $banco_->getAllTerm();
$DownloadType = $banco_->getAllDownloadType();
$InfoSource = $banco_->getAllInformationSource();
$Method = $banco_->getAllMethods();
//print_r($Term);die;
unset($banco_);

//echo "</pre>";