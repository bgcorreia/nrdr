<?php


class organism {
    private $dbhost = DATABASE_HOST;
    private $dbuser = DATABASE_USER;
    private $dbpass = DATABASE_PASS;
    private $dbname = DATABASE_NAME;
    public  $banco;

    public function __construct()
    {
        $this->banco = new mysqli($this->dbhost, base64_decode($this->dbuser), base64_decode($this->dbpass), $this->dbname);
    }

    public function __destruct()
    {
        $this->banco->close();
    }

    public function deleteOrganism($IDOrganism){
        $queryDelOrg = "DELETE FROM organism WHERE IDOrganism = ".$IDOrganism;
        $queryDelDBOrg = "DELETE FROM dborganism WHERE IDOrganism = ".$IDOrganism;
        if($this->banco->query($queryDelOrg)){
            if($this->banco->query($queryDelDBOrg)){
                return 'success';
            }else{
                return "error";
            }
        }else{
            return "error";
        }

    }
    public function updateOrganism($IDOrganism, $name, $cname){

        $query = "UPDATE organism SET Name = '".$name."', CName = '".$cname."' WHERE IDOrganism = ".$IDOrganism;
        if($this->banco->query($query)){
            return 'success';
        }else{
            return "error";
        }

    }
    public function insertOrganism($name, $cname){
        $query = "INSERT INTO organism (Name, CName) VALUES('".$name."', '".$cname."')";
        //echo $query; die;
        if($this->banco->query($query)){
            return 'success';
        }else{
            return "error";
        }
    }
}

class sequence {
    private $dbhost = DATABASE_HOST;
    private $dbuser = DATABASE_USER;
    private $dbpass = DATABASE_PASS;
    private $dbname = DATABASE_NAME;
    public $banco;

    public function __construct()
    {
        $this->banco = new mysqli($this->dbhost, base64_decode($this->dbuser), base64_decode($this->dbpass), $this->dbname);
    }

    public function __destruct()
    {
        $this->banco->close();
    }

    public function deleteSequence($IDsequence, $id_user, $type){

        /* Código alterado para permitir controle de usuários */
        if ($type == 9) { // usuário adm - type = 9... array vazio para trazer tudo
            $query = "DELETE s.* FROM sequence as s WHERE s.IDSequence = {$IDsequence}";
        } else if ($type == 1) { // usuário comum - type = 1 ... array com seu id para trazes somente seus dbs
            $query = "DELETE s.* FROM sequence as s INNER JOIN dbncrna as d ON d.iddb = s.iddb WHERE s.IDSequence = {$IDsequence} AND d.iduser = {$id_user}";
        }

        if($this->banco->query($query)){
            return 'success';
        }else{
            return "error";
        }

    }

    public function updateSequence($IDsequence, $database, $organism, $rnaType, $header, $description, $sequence, $userObj){

        $query = "SELECT o.IDOrganism FROM organism as o WHERE o.Name = '".$organism."' limit 1";
        $result = $this->banco->query($query);
        if($result->num_rows == 1){
            $objOrganism = $result->fetch_object();
        }else{
            return "error";
        }

        //Buscando o database
        if($userObj->type == 9){
            $query = "SELECT d.IDDB FROM dbncrna as d WHERE d.Name = '{$database}' limit 1";
        }else if($userObj->type == 1){
            $query = "SELECT d.IDDB FROM dbncrna as d WHERE d.Name = '{$database}' AND d.iduser = {$userObj->iduser} limit 1";
        }

        $result = $this->banco->query($query);
        if($result->num_rows == 1){
            $objDatabase = $result->fetch_object();
        }else{
            return "error";
        }

        $query = "UPDATE sequence SET Header = '".$header."', Sequence = '".$sequence."',
        IDDB = '".$objDatabase->IDDB."', Descricao = '".$description."',
        IDTypeRNA = '".$rnaType."', IDOrganism = '".$objOrganism->IDOrganism."' WHERE IDSequence = ".$IDsequence;

        if($this->banco->query($query)){
            return 'success';
        }else{
            return "error";
        }

    }

    public function insertNewSequence($database, $organism, $rnaType, $header, $description, $sequence, $userObj){
        //Buscando o organismo
        $query = "SELECT o.IDOrganism FROM organism as o WHERE o.Name = '".$organism."' limit 1";
        $result = $this->banco->query($query);
        if($result->num_rows == 1){
            $objOrganism = $result->fetch_object();
        }else{
            return "error";
        }
       /* Buscando o database adaptado para controle do usuário */
        if($userObj->type == 9){
            $query = "SELECT d.IDDB FROM dbncrna as d WHERE d.Name = '{$database}' limit 1";
        }else if($userObj->type == 1){
            $query = "SELECT d.IDDB FROM dbncrna as d WHERE d.Name = '{$database}' AND d.iduser = {$userObj->iduser} limit 1";
        }

        $result = $this->banco->query($query);
        if($result->num_rows == 1){
            $objDatabase = $result->fetch_object();
            $query = "INSERT INTO sequence (Header, Sequence, IDDB, Descricao, IDTypeRNA, IDOrganism) VALUES('{$header}', '{$sequence}', '{$objDatabase->IDDB}', '{$description}', '{$rnaType}', '{$objOrganism->IDOrganism}')";

            if($this->banco->query($query)){
                return 'success';
            }else{
                return "error";
            }

        }else{
            return "error";
        }
    }


     public function getRnaType(){
        $query = "SELECT tr.idTypeRNA, tr.RNAName FROM typerna as tr ORDER BY tr.RNAName";
        $result = $this->banco->query($query);
        while($value = $result->fetch_array(MYSQLI_ASSOC)){
            $array[] = $value;
        }
        $result->close();
        return $array;
    }
}

class ncRNAdatabase {
    private $dbhost = DATABASE_HOST;
    private $dbuser = DATABASE_USER;
    private $dbpass = DATABASE_PASS;
    private $dbname = DATABASE_NAME;
    public $banco;

    public function __construct()
    {
        $this->banco = new mysqli($this->dbhost, base64_decode($this->dbuser), base64_decode($this->dbpass), $this->dbname);
    }

    public function __destruct()
    {
        $this->banco->close();
    }

    public function deleteDatabase($iddb, $iduser, $type){

        /* Código alterado para permitir controle de usuários */
        if ($type == 9) { // usuário adm - type = 9... array vazio para trazer tudo
            $query = "DELETE FROM dbncrna WHERE IDDB = {$iddb}";
        } else if ($type == 1) { // usuário comum - type = 1 ... array com seu id para trazes somente seus dbs
            $query = "DELETE FROM dbncrna WHERE IDDB = {$iddb} AND iduser = {$iduser}";
        }

        //Deletando database ncrbadb

        $retorno = $this->banco->query($query);
        if($retorno){
            $query = "DELETE FROM dborganism WHERE IDDB = {$iddb}";
            $this->banco->query($query);
            $query = "DELETE FROM download WHERE IDDB = {$iddb}";
            $this->banco->query($query);
            $query = "DELETE FROM informationcontent WHERE IDDB = {$iddb}";
            $this->banco->query($query);
            $query = "DELETE FROM infosourcedbs WHERE IDDB = {$iddb}";
            $this->banco->query($query);
            $query = "DELETE FROM pubmedid WHERE IDDB = {$iddb}";
            $this->banco->query($query);
            $query = "DELETE FROM searchmethod WHERE IDDB = {$iddb}";
            $this->banco->query($query);
            /*$query = "DELETE FROM sequence WHERE IDDB = {$iddb}";
            $this->banco->query($query);*/
            return true;
        }else{
            return false;
        }
    }
    public function updateDatabase($iddb, $name, $rnaType, $source, $download, $multipleSearch, $graphicView, $overview, $year, $reference, $url, $version){
        $query = "UPDATE dbncrna SET RNAType = '{$rnaType}',
                                     Name = '{$name}',
                                     Source ='{$source}',
                                     Site =  '{$url}',
                                     Download = '{$download}',
                                     MultipleSearch = '{$multipleSearch}',
                                     GraphicView = '{$graphicView}',
                                     Overview = '{$overview}',
                                     Year =  '{$year}',
                                     Reference = '{$reference}',
                                     Version = '{$version}' WHERE IDDB = {$iddb};";
        $retorno = $this->banco->query($query);
        if($retorno){
            return true;
        }else{
            return false;
        }
    }
    public function insertDatabase($name, $rnaType, $source, $download, $multipleSearch, $graphicView, $overview, $year, $reference, $url, $version, $id_user){
        $query = "INSERT INTO dbncrna(RNAType, Name, Source, Site, Download, MultipleSearch, GraphicView, Overview, Year, Reference, Version, iduser)
        VALUES ('{$rnaType}', '{$name}', '{$source}', '{$url}', '{$download}', '{$multipleSearch}', '{$graphicView}',
        '{$overview}', '{$year}', '{$reference}', '{$version}', {$id_user})";

        $retorno = $this->banco->query($query);
        if($retorno){
            return $this->banco->insert_id;
        }else{
            return false;
        }
    }
    public function insertSearchMethod($iddb, $array){
        foreach(array_keys($array) as $key) {
            if(!empty($array[$key])){
                $query = "INSERT INTO searchmethod(IDDB, IDMethod, Description) VALUES ({$iddb}, {$key}, '{$array[$key]}')";
                $this->banco->query($query);
            }
        }
    }

    public function insertInformationSource($iddb, $array){
        foreach($array as $value){
            $query = "INSERT INTO infosourcedbs(IDDB, IDInfoSource) VALUES ({$iddb}, {$value})";
            $this->banco->query($query);
        }
    }

    public function insertInformationContent($iddb, $array){
        foreach($array as $value){
            $query = "INSERT INTO informationcontent(IDDB, IDTerm) VALUES ({$iddb}, {$value})";
            $this->banco->query($query);
        }
    }
    public function insertDownloadType($iddb, $array){
        foreach($array as $value){
            $query = "INSERT INTO download(IDDB, Type) VALUES ({$iddb}, '{$value}')";
            $this->banco->query($query);
        }
    }

    public function insertPubmedID($iddb, $string){
        $array = explode(",", $string);
        foreach($array as $value){
            $value = trim($value);
            $query = "INSERT INTO pubmedid(IDDB, PubmedID) VALUES ({$iddb},{$value})";
            $this->banco->query($query);
        }
    }

    public function insertOrganismFromArray($iddb, $array){
        foreach($array as $value){
            // $query = "INSERT INTO download(IDDB, Type) VALUES ({$iddb}, '{$value}')";
            // $this->banco->query($query);
            $value = trim($value);
            $query = "SELECT IDOrganism FROM organism WHERE Name = '{$value}' limit 1";
            $result = $this->banco->query($query);
            $objOrg = $result->fetch_object();
            if(is_object($objOrg) AND !empty($iddb)){
                //Se Organismo existir
                $query = "INSERT INTO dborganism(IDDB, IDOrganism) VALUES({$iddb}, {$objOrg->IDOrganism})";
                $this->banco->query($query);
            }else if(!is_object($objOrg) AND !empty($iddb)){
                //Se Organismo não existir
                $query = "INSERT INTO organism(Name) VALUES('{$value}')";
                $this->banco->query($query);
                $IDOrganism = $this->banco->insert_id;
                $query = "INSERT INTO dborganism(IDDB, IDOrganism) VALUES({$iddb}, {$IDOrganism})";
                $this->banco->query($query);
            }else if(!is_object($objOrg) AND empty($iddb)){
                //se iddb não foi definido e não existir o organismo no database
                $query = "INSERT INTO organism(Name) VALUES('{$value}')";
                $this->banco->query($query);
            }
        }
    }
}
