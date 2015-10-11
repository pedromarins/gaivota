<?php

//incui conector banco de dados
include 'db.php';

//verifica se objeto foi passado
if (isset($_GET['id'])) {
 $object_id = $_GET['id'];
}
else {
  $object_id = 'all';
}



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

//verifica se timeFormat foi passado
if (isset($_GET['timeFormat'])) {
 $timeFormat = $_GET['timeFormat'];
}
else {
 $timeFormat = 'default';
}

//cria base da query
$sql = "SELECT * FROM acervo WHERE ";

//adiciona objeto na query
if ($object_id != 'all'){
 $sql .= "object_id = '$object_id' ";
}
else{
 $sql .= "1 ";
}


//adiciona tipo na query
if ($type != 'all'){
 $sql .= "type = '$type' ";
} 

//adiciona stationId na query
if ($stationId != 'all'){
 $sql .= "AND stationId = $stationId ";
}

//adiciona na query parametros para o caso de volume == mostrecent
if ($volume == 'mostrecent'){
 $sql = "select * from ($sql order by time desc) a group by stationId;";
}

//adiciona na query datetime em formato humano caso solicitado
if ($timeFormat == 'human'){
 $sql = str_replace("SELECT *","SELECT *, DATE_FORMAT(time, '%H:%i:%s %d/%m/%Y UTC') as timeHuman ",$sql);
}

//adiciona na query datetime em formato ISO8601 caso solicitado
if ($timeFormat == 'ISO'){
 $sql = str_replace("SELECT *","SELECT *, DATE_FORMAT(time, '%Y-%m-%dT%H:%i:%s0Z') as timeISO8601",$sql);
}




//roda a query
$result = mysqli_query($conn, $sql);


//le o resultado da query e monta um json
$sth = mysqli_query($conn,$sql);
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
 $rows[] = $r;
}
$resultado =  json_encode($rows, JSON_NUMERIC_CHECK);

$dados = '{"lines":'. $resultado . '}';


if (isset($_GET['callback'])) {
 echo $_GET['callback'] . '(' . $dados .')';
}
else {
 echo $dados;
}

echo $sql2;

?>
