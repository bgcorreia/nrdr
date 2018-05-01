<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of downloadHelper
 *
 * @author @pedrobassetto@gmail.com
 */
set_time_limit(6000000);
ini_set('memory_limit', '200000M');
class downloadHelper {
    //put your code here
    private $dbhost = DATABASE_HOST;
    private $dbuser = DATABASE_USER;
    private $dbpass = DATABASE_PASS;
    private $dbname = DATABASE_NAME;
    public  $banco;
    
    public function __construct() {
        $this->banco = new mysqli($this->dbhost, base64_decode($this->dbuser), base64_decode($this->dbpass), $this->dbname);
    }
    
    public function arrayToFasta($array){
        $string = '';
        foreach ($array as $value) {
            $string.= $value['Header'].PHP_EOL;
            $string.= $value['Sequence'].PHP_EOL;
        }
        return $string;
    }
    
    public function retornaSequencias($inIddb, $inOrganism, $inRnatype){
        $iddb   = $inIddb;
        $rnaType  = $inRnatype;
        $organism = $inOrganism;
        
     
        //pega o IDOrganism pelo nome
        $query = "SELECT o.IDOrganism FROM organism as o WHERE o.Name = '{$organism}' limit 1";
        $result = $this->banco->query($query);
        if ($result->num_rows == 1) {
            $objOrganism = $result->fetch_object();
        } else {
            $objOrganism = null;
        }
         
        $query = "SELECT seq.Header, seq.Sequence FROM sequence as seq";
        if ($rnaType) {
            $query.= " RIGHT JOIN dbncrna as db ON seq.IDDB = db.IDDB";
        }
             
        $query.= " WHERE 1 = 1";
        if ($rnaType) {
            $query.= " AND db.RNAType = '{$rnaType}'";
        }        
        if ($iddb) {
            $query.= " AND seq.IDDB = {$iddb}";
        }
        if ($objOrganism) {
            $query.= " AND seq.IDOrganism = {$objOrganism->IDOrganism}";
        }
        
        if ($iddb || $objOrganism || $rnaType) {
            $result = $this->banco->query($query);
        } else {
            $result = null;
        }

        $array = [];
        if ($result != null && $result->num_rows > 0) {
            while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
                array_push($array, $value);
            }
        } else {
            $array = null;
        }
    
        return $array;        
    }
    
}
