<?php
$database = new ncrnaMain();

$result = $database->banco->query('SELECT t.IDTerm as id, t.Term as text, COUNT(Distinct i.IDTerm, i.IDDB) as amount FROM term t LEFT JOIN informationcontent i ON i.IDTerm = t.IDTerm GROUP BY t.term ORDER BY amount DESC');
while($value = $result->fetch_array(MYSQLI_ASSOC)){
    $array['informationcontent'][] = $value;
}
$result->close();

$result = $database->banco->query('SELECT d.RNAType as id, d.RNAType as text, COUNT(d.RNAType) as amount FROM dbncrna d GROUP BY text ORDER BY amount DESC');
while($value = $result->fetch_array(MYSQLI_ASSOC)){
    $array['RNAType'][] = $value;
}
$result->close();

$result = $database->banco->query('SELECT i.IDInfoSource as id, i.Type as text, COUNT(s.IDInfoSource) as amount FROM informationsource i LEFT JOIN infosourcedbs s ON s.IDInfoSource = i.IDInfoSource GROUP BY i.Type ORDER BY amount DESC');
while($value = $result->fetch_array(MYSQLI_ASSOC)){
    $array['informationsource'][] = $value;
}
$result->close();

$result = $database->banco->query('SELECT m.IDMethod as id, m.Method as text, COUNT(s.IDMethod) as amount FROM methods m LEFT JOIN searchmethod s ON s.IDMethod = m.IDMethod GROUP BY m.Method ORDER BY amount DESC');
while($value = $result->fetch_array(MYSQLI_ASSOC)){
    $array['searchmethod'][] = $value;
}
$result->close();

