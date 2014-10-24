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

//verifica se station_id foi passado
if (isset($_GET['station_id'])) {
 $station_id = $_GET['station_id'];
}
else {
 $station_id = 'all';
}


//cria query de acordo com parametros
  //REFATORAR!

//cria base da query
$sql = 'SELECT * FROM rawdata WHERE ';

//adiciona tipo na query
if ($type != 'all'){
 $sql .= "type = '$type' ";
}
else{
 $sql .= "1 ";
} 

//adiciona station_id na query
if ($station_id != 'all'){
 $sql .= "AND station_id = $station_id ";
}

//adiciona na query parametros para o caso de volume == mostrecent
if ($volume == 'mostrecent'){
 $sql = "select * from ($sql order by time desc) a group by station_id;";
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

echo '{"lines":'. $resultado . "}";

?>
