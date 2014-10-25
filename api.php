<?php

//incui conector banco de dados
include 'db.php';

//verifica se type foi passado
if (isset($_GET['type'])) {
 $type = $_GET['type'];
}
else {
  $type = 'all';
}

//verifica se volume foi passado
if (isset($_GET['volume'])) {
 $volume = $_GET['volume'];
}
else {
 $volume = 'all';
}

//verifica se stationId foi passado
if (isset($_GET['stationId'])) {
 $stationId = $_GET['stationId'];
}
else {
 $stationId = 'all';
}


//cria base da query
$sql = 'SELECT * FROM rawdata WHERE ';

//adiciona tipo na query
if ($type != 'all'){
 $sql .= "type = '$type' ";
}
else{
 $sql .= "1 ";
} 

//adiciona stationId na query
if ($stationId != 'all'){
 $sql .= "AND stationId = $stationId ";
}

//adiciona na query parametros para o caso de volume == mostrecent
if ($volume == 'mostrecent'){
 $sql = "select * from ($sql order by time desc) a group by stationId;";
}


//roda a query
$result = mysqli_query($conn, $sql);


//le o resultado da query e monta um json
$sth = mysqli_query($conn,$sql);
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
 $rows[] = $r;
}
$resultado =  json_encode($rows);

$dados = '{"lines":'. $resultado . '}';


if (isset($_GET['callback'])) {
 echo $_GET['callback'] . '(' . $dados .')';
}
else {
 echo $dados;
}


?>
