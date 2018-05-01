<?php

class ncrnaMain {

    private $dbhost = DATABASE_HOST;
    private $dbuser = DATABASE_USER;
    private $dbpass = DATABASE_PASS;
    private $dbname = DATABASE_NAME;
    public $banco;

    public function __construct() {
        $this->banco = new mysqli($this->dbhost, base64_decode($this->dbuser), base64_decode($this->dbpass), $this->dbname);
    }

    public function __destruct() {
        $this->banco->close();
    }

    public function getDatabaseForAjax($organism, $rnaType) {
        $query = "SELECT d.IDDB, d.Name FROM dbncrna as d";
        if ($organism) {
            $query.= " RIGHT JOIN dborganism as do ON do.IDDB = d.IDDB";
            $query.= " RIGHT JOIN organism as o ON o.IDorganism = do.IDOrganism";
        }
        $query.= " WHERE d.haveSequence = 1";
        if ($rnaType) {
            $query.= " AND d.RNAType = '{$rnaType}'";
        }
        if ($organism) {
            $query.= " AND o.Name = '{$organism}'";
        }
        $query.= " ORDER BY d.Name ASC";
        $result = $this->banco->query($query);
        while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value;
        }

        if ($result->num_rows == 0) {
            $array = array();
        }
        $result->close();

        return $array;
    }

    public function getRnaFamiliesForAjax($IDDB, $Organism) {
        $query = "SELECT d.RNAType as IDRNAType FROM dbncrna as d";
        if ($Organism) {
            $query.= " RIGHT JOIN dborganism as do ON do.IDDB = d.IDDB";
            $query.= " RIGHT JOIN organism as o ON o.IDorganism = do.IDOrganism";
        }
        $query.= " WHERE d.haveSequence = 1";
        if ($IDDB) {
            $query.= " AND d.IDDB = {$IDDB}";
        }
        if ($Organism) {
            $query.= " AND o.Name = '{$Organism}'";
        }
        $query.= " GROUP BY d.RNAType ORDER BY d.RNAType ASC";
        $result = $this->banco->query($query);
        while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value;
        }
        $result->close();
        return $array;
    }

    public function getRnaFamilies() {
        $query = "SELECT b.RNAType as IDRNAType, b.RNAType FROM dbncrna as b GROUP BY b.RNAType ORDER BY b.RNAType ASC";
        $result = $this->banco->query($query);
        while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value;
        }
        $result->close();
        return $array;
    }

    public function getRnaType() {
        $query = "SELECT tr.idTypeRNA, tr.RNAName FROM typerna as tr ORDER BY tr.RNAName";
        $result = $this->banco->query($query);
        while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value;
        }
        $result->close();
        return $array;
    }

    public function getAllTerm() {
        $query = "SELECT t.idterm, t.term FROM term as t ORDER BY t.term ASC";
        $result = $this->banco->query($query);
        while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value;
        }
        $result->close();
        return $array;
    }

    public function getAllDownloadType() {
        $query = "SELECT d.type FROM download as d GROUP BY d.type ORDER BY d.type ASC";
        $result = $this->banco->query($query);
        while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value['type'];
        }
        $result->close();
        return $array;
    }

    public function getAllInformationSource() {
        $query = "SELECT i.IDInfoSource, i.Type FROM informationsource as i ORDER BY i.Type ASC";
        $result = $this->banco->query($query);
        while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value;
        }
        $result->close();
        return $array;
    }

    public function getAllMethods() {
        $query = "SELECT m.IDMethod, m.Method FROM methods as m ORDER BY m.Method ASC";
        $result = $this->banco->query($query);
        while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value;
        }
        $result->close();
        return $array;
    }

    public function getOrganismForAjaxDownloadPage($input, $iddb) {
        $array = null;
        $input = str_replace("'", "", str_replace('"', '', $input));
        $query = "SELECT DISTINCT o.Name FROM organism as o "
                . " RIGHT JOIN dborganism as b ON b.IDOrganism = o.IDOrganism"
                . " RIGHT JOIN dbncrna as d ON d.IDDB = b.IDDB"
                . " WHERE d.haveSequence = 1 AND b.IDDB = {$iddb} AND o.Name LIKE '" . $input . "%' AND o.Name NOT LIKE '%,%' ORDER BY o.Name ASC limit 8";

        $result = $this->banco->query($query);
        while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value['Name'];
        }
        $result->close();
        return $array;
    }

    public function getOrganismByIDDB($IDDB) {
        $query = "SELECT o.Name FROM organism o INNER JOIN dborganism d ON o.IDOrganism = d.IDOrganism WHERE d.IDDB = {$IDDB} AND o.Name NOT LIKE '%,%' ORDER BY o.Name ASC";
        $result = $this->banco->query($query);
        while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value['Name'];
        }
        $result->close();
        return $array;
    }

    public function getOrganismForAjax($input) {
        $array = null;
        $input = str_replace("'", "", str_replace('"', '', $input));
        $query = "SELECT o.Name FROM organism as o WHERE o.Name LIKE '" . $input . "%' AND o.Name NOT LIKE '%,%' ORDER BY o.Name ASC limit 8";
        $result = $this->banco->query($query);
        while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value['Name'];
        }
        $result->close();
        return $array;
    }

    public function getncRNAdb($input) {
        $array = null;
        $input = str_replace("'", "", str_replace('"', '', $input));
        $query = "SELECT d.Name FROM dbncrna as d WHERE d.Name LIKE '" . $input . "%' ORDER BY d.Name ASC limit 8";
        $result = $this->banco->query($query);
        while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = ucwords($value['Name']);
        }
        $result->close();
        return $array;
    }

    public function getSequencesBlast($array_arguments) {
        $query = "SELECT s.*,d.name as databaseName, o.name as organismName FROM sequence as s";
        if (!empty($array_arguments['dbncrna']['name'])) {
            $query.= " INNER JOIN dbncrna as d ON d.IDDB = s.IDDB
                       AND d.Name = '{$array_arguments['dbncrna']['name']}'";
        } else {
            $query.= " INNER JOIN dbncrna as d ON d.IDDB = s.IDDB";
        }
        if (!empty($array_arguments['organism']['name'])) {
            $query.= " INNER JOIN organism as o ON o.IDOrganism = s.IDOrganism
                       AND o.Name = '{$array_arguments['organism']['name']}'";
        } else {
            $query.= " INNER JOIN organism as o ON o.IDOrganism = s.IDOrganism";
        }

        if (!empty($array_arguments['sequence'])) {
            $query_temp = $query . " WHERE 1 = 1 limit 5";
            $query.= " WHERE s.sequence LIKE '%" . $array_arguments['sequence'] . "%' limit 5";
        } else {
            $query.= " WHERE 1 = 1 limit 5";
        }

        $result = $this->banco->query($query);
        if ($result->num_rows > 0) {
            while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
                $array[] = $value;
            }
        } else {

            $result = $this->banco->query($query_temp);
            while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
                $array[] = $value;
            }
        }


        $result->close();
        return $array;
    }

    public function getDataBaseNames($array_arguments) {
        $query = "SELECT DISTINCT d.IDDB, d.Name, d.Site FROM dbncrna as d";

        if (!empty($array_arguments['organism']['name'])) {
            $query.= " INNER JOIN dborganism as dborg ON dborg.IDDB = d.IDDB
                       INNER JOIN organism as org ON dborg.IDOrganism = org.IDOrganism
                       AND org.Name LIKE '%" . $array_arguments['organism']['name'] . "%'";
        }
        if (isset($array_arguments['informationsource'])) {
            $query.= " INNER JOIN infosourcedbs ON infosourcedbs.IDDB = d.IDDB
                       AND infosourcedbs.IDInfoSource IN(" . implode(',', $array_arguments['informationsource']) . ")";
        }
        if (isset($array_arguments['informationcontent'])) {
            $query.= " INNER JOIN informationcontent ON informationcontent.IDDB = d.IDDB
                       AND informationcontent.IDTerm IN(" . implode(',', $array_arguments['informationcontent']) . ")";
        }
        if (isset($array_arguments['download'])) {
            foreach ($array_arguments['download'] as $value) {
                $arguments_download[] = "'" . $value . "'";
            }
            $query.= " INNER JOIN download ON download.IDDB = d.IDDB
                       AND download.Type IN(" . implode(",", $arguments_download) . ")";
        }
        if (isset($array_arguments['searchmethod'])) {
            $query.= " INNER JOIN searchmethod ON searchmethod.IDDB = d.IDDB
                       AND searchmethod.IDMethod IN(" . implode(',', $array_arguments['searchmethod']) . ")";
        }

        $query.= " WHERE 1 = 1";

        if (!empty($array_arguments['dbncrna']['name'])) {
            $query.= " AND d.Name LIKE '" . $array_arguments['dbncrna']['name'] . "%'";
        }
        if (!empty($array_arguments['dbncrna']['overview'])) {
            $query.= " AND d.overview LIKE '%" . $array_arguments['dbncrna']['overview'] . "%'";
        }
        if (!empty($array_arguments['dbncrna']['source'])) {
            $query.= " AND d.source LIKE '%" . $array_arguments['dbncrna']['source'] . "%'";
        }
        if (isset($array_arguments['dbncrna']['RNAType'])) {
            foreach ($array_arguments['dbncrna']['RNAType'] as $value) {
                $arguments_RNAType[] = "'" . $value . "'";
            }
            $query.= " AND d.RNAType IN(" . implode(",", $arguments_RNAType) . ")";
        }
        if (isset($array_arguments['dbncrna']['multipleSearch'])) {
            $query.= " AND d.multipleSearch = 1";
        }
        if (isset($array_arguments['dbncrna']['graphicview'])) {
            $query.= " AND d.graphicview = 1";
        }
        if (isset($array_arguments['dbncrna']['iduser'])) {
            /* Parte reescrita para controlar acesso do usuário o database */
            $query.= " AND d.iduser = '{$array_arguments['dbncrna']['iduser']}'";
        }

        $query.= " ORDER BY d.Name ASC";

        $result = $this->banco->query($query);

        // echo $query;

        if ($result->num_rows > 0) {
            while ($value = $result->fetch_array(MYSQLI_ASSOC)) {

                //Procurando por organismos
                //Prepara os organismos para exibição nos detalhes do banco
                $query = "SELECT o.Name,o.CName FROM dborganism AS d INNER JOIN organism AS o ON d.IDorganism = o.IDOrganism WHERE d.IDDB = {$value['IDDB']} AND o.Name NOT LIKE '%,%' ORDER BY o.IDOrganism";
                $resul2 = $this->banco->query($query);
                if ($resul2->num_rows == 1) {
                    $resulOrg = $resul2->fetch_assoc();
                    //$organism = 'Only '.$resulOrg['Name'];
                    $organism = $resulOrg['Name'];
                    $countOrganism = 1;
                } else if ($resul2->num_rows > 1) {
                    $testAc = 0;
                    while ($value2 = $resul2->fetch_array(MYSQLI_ASSOC)) {
                        $array[$testAc] = $value2['Name'];
                        //Preparando para link do wikipedia caso seja vários organismos

                        $testAc++;
                    }

                    $new_array = array_slice($array, 0, 6);
                    $organism = implode(', ', $new_array);

                    $countOrganism = (count($array) - 6);
                } else {
                    $organism = "Unspecified";
                    $countOrganism = 0;
                }
                // -------
                $value['count_org'] = $countOrganism;
                $value['qtd_org'] = $organism;
                $arrayMor[] = $value;
                $countOrganism = 0;
                $testAc = 0;
                unset($array);
            }
            $result->close();
        } else {
            $arrayMor[] = null;
        }

        return $arrayMor;
    }

    public function getDetailsDatabase($databaseID) {
        $query = "SELECT * FROM dbncrna AS d WHERE d.IDDB = " . $databaseID;
        $resul = $this->banco->query($query);
        $databaseDetails = $resul->fetch_assoc();

        $query = "SELECT m.Method, sm.Description FROM searchmethod AS sm INNER JOIN methods AS m ON sm.IDMethod = m.IDMethod WHERE sm.IDDB = {$databaseID}";
        $resul = $this->banco->query($query);
        while ($value = $resul->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value;
        }
        @$databaseDetails['searchmethod'] = $array;
        unset($array);

        $query = "SELECT s.Type FROM infosourcedbs AS i INNER JOIN informationsource as s ON i.IDInfoSource = s.IDInfoSource WHERE i.IDDB = {$databaseID} ORDER BY s.Type ASC";
        $resul = $this->banco->query($query);
        while ($value = $resul->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value['Type'];
        }
        $aux = implode(', ', $array);
        $databaseDetails['informationsource'] = $aux . ".";
        unset($array);

        $query = "SELECT t.Term FROM informationcontent  AS i INNER JOIN term as t ON i.IDTerm = t.IDTerm WHERE i.IDDB = {$databaseID} ORDER BY t.Term ASC";
        $resul = $this->banco->query($query);
        while ($value = $resul->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value['Term'];
        }
        $aux = implode(', ', $array);
        $databaseDetails['informationcontent'] = $aux . ".";
        unset($array);

        $query = "SELECT p.pubmedid FROM pubmedid AS p WHERE p.IDDB = {$databaseID} ORDER BY p.pubmedid ASC";
        $resul = $this->banco->query($query);
        while ($value = $resul->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value['pubmedid'];
        }
        if (!empty($array)) {
            $aux = implode(', ', $array) . ".";
        } else {
            $aux = "Not Found";
        }
        $databaseDetails['pubmedid'] = $aux;
        unset($array);

        $query = "SELECT d.Type FROM download AS d WHERE d.IDDB = {$databaseID} ORDER BY d.Type ASC";
        $resul = $this->banco->query($query);
        while ($value = $resul->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $value['Type'];
        }
        if ($databaseDetails['Download'] == 1 AND ! empty($array)) {
            $aux = implode(', ', $array);
            $databaseDetails['TypeDownload'] = $aux . ".";
        } else {
            $databaseDetails['TypeDownload'] = "No";
        }

        unset($array);

        //Prepara os organismos para exibição nos detalhes do banco
        $query = "SELECT o.Name,o.CName FROM dborganism AS d INNER JOIN organism AS o ON d.IDorganism = o.IDOrganism WHERE d.IDDB = " . $databaseID . " AND o.Name NOT LIKE '%,%' ORDER BY o.IDOrganism";
        $resul = $this->banco->query($query);
        if ($resul->num_rows == 1) {
            $resulOrg = $resul->fetch_assoc();
            //$organism = 'Only '.$resulOrg['Name'];
            $organism = $resulOrg['Name'];
            $countOrganism = 1;
            if (!empty($resulOrg['CName'])) {
                $organism.= ' (' . $resulOrg['CName'] . ')';
            }
            //Preparando para link do wikipedia caso seja só um organismo
            $organism = "<a target='_blank' href='http://en.wikipedia.org/w/index.php?search=" . strtr($resulOrg['Name'], " ", "+") . "'>" . $organism . "</a>";
        } else if ($resul->num_rows > 1) {
            $testAc = 0;
            while ($value = $resul->fetch_array(MYSQLI_ASSOC)) {
                $array[$testAc] = $value['Name'];
                if (!empty($value['CName'])) {
                    $array[$testAc].= ' (' . $value['CName'] . ')';
                }
                //Preparando para link do wikipedia caso seja vários organismos
                $array[$testAc] = "<a target='_blank' href='http://en.wikipedia.org/w/index.php?search=" . strtr($value['Name'], " ", "+") . "'>" . $array[$testAc] . "</a>";
                $testAc++;
            }

            $new_array = array_slice($array, 0, 15);
            $organism = implode(', ', $new_array);

            $countOrganism = (count($array) - 15);
        } else {
            $organism = "Unspecified";
            $countOrganism = 0;
        }

        $databaseDetails['Organism'] = $organism;
        $databaseDetails['CountOrganism'] = $countOrganism;
        unset($array);

        $resul->close();
        return $databaseDetails;
    }

    public function submitExternalDatabase($inputArray) {
        /* preparando os dados que estão em array */
        if (!empty($inputArray['methodDescription'])) {
            $tiposMetodos = ["Density of ncRNAs: ", "Genomic Location: ", "Keyword: ", "Similarity: ", "TAG: ", "Tabular: "];
            $methodDescription = array();
            foreach ($inputArray['methodDescription'] as $key => $value) {
                if (!empty($value)) {

                    array_push($methodDescription, $tiposMetodos[--$key] . $value);
                }
            }
            $inputArray['methodDescription'] = implode(",", $methodDescription);
        }
        if (!empty($inputArray['informationSource'])) {
            $inputArray['informationSource'] = implode(",", $inputArray['informationSource']);
        }
        if (!empty($inputArray['informationContent'])) {
            $inputArray['informationContent'] = implode(",", $inputArray['informationContent']);
        }
        if (!empty($inputArray['downloadType'])) {
            $inputArray['downloadType'] = implode(",", $inputArray['downloadType']);
        }
        if (!empty($inputArray['organisms'])) {
            $inputArray['organisms'] = implode(",", $inputArray['organisms']);
        }
        /* Criando a query para inserir no banco de acordo com o key */
        $ultimoKeyArray = count($inputArray);
        $count = 0;
        $query = "INSERT INTO externalsubmission(";
        foreach ($inputArray as $key => $value) {
            $count++;
            if ($count < $ultimoKeyArray) {
                $query.= "{$key}, ";
            } else {
                $query.= "{$key}) ";
            }
        }
        $count = 0;
        $query.= "VALUES(";
        foreach ($inputArray as $key => $value) {
            $count++;
            if ($count < $ultimoKeyArray) {
                $query.= "\"{$value}\", ";
            } else {
                $query.= "\"{$value}\")";
            }
        }
        return $this->banco->query($query);
    }

}
