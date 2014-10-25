<?php

//incui conector banco de dados
include 'db.php';

//pega dados enviados pela estação. adiciona '' nos campos não passados
$hash = $_GET['id'];

if ($_GET['ambientTemperature'] != '') {
 $ambientTemperature = $_GET['ambientTemperature'];
}
else {
  $ambientTemperature = "''";
}

if ($_GET['soilTemperature'] != '') {
 $soilTemperature = $_GET['soilTemperature'];
}
else {
  $soilTemperature = "''";
}

if ($_GET['waterTemperature'] != '') {
 $waterTemperature = $_GET['waterTemperature'];
}
else {
  $waterTemperature = "''";
}

if ($_GET['airHumidity'] != '') {
 $airHumidity = $_GET['airHumidity'];
}
else {
  $airHumidity = "''";
}

if ($_GET['pressure'] != '') {
 $pressure = $_GET['pressure'];
}
else {
  $pressure = "''";
}

if ($_GET['co'] != '') {
 $co = $_GET['co'];
}
else {
  $co = "''";
}

if ($_GET['airParticle'] != '') {
 $airParticle = $_GET['airParticle'];
}
else {
  $airParticle = "''";
}

if ($_GET['windSpeed'] != '') {
 $windSpeed = $_GET['windSpeed'];
}
else {
  $windSpeed = "''";
}

if ($_GET['windDirection'] != '') {
 $windDirection = $_GET['windDirection'];
}
else {
  $windDirection = "''";
}

if ($_GET['soilHumidity'] != '') {
 $soilHumidity = $_GET['soilHumidity'];
}
else {
  $soilHumidity = "''";
}

if ($_GET['waterTurbidity'] != '') {
 $waterTurbidity = $_GET['waterTurbidity'];
}
else {
  $waterTurbidity = "''";
}

if ($_GET['waterSalinity'] != '') {
 $waterSalinity = $_GET['waterSalinity'];
}
else {
  $waterSalinity = "''";
}

//busca hash no banco de dados
$sql = "SELECT * FROM station WHERE hash = '$hash'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


if (isset($row)) { //verifica se a hash existe e incui dados na base
  $time = date('YmdHis');
  $latitude = $row['latitude'];
  $longitude = $row['longitude'];
  $type = $row['type'];
  $stationId = $row['stationId'];
  $sql2 = "INSERT INTO rawdata(stationId,type,latitude,longitude,time,ambientTemperature,soilTemperature,waterTemperature,airHumidity,pressure,co,airParticle,windSpeed,windDirection,soilHumidity,waterTurbidity,waterSalinity) VALUES ($stationId,'$type',$latitude,$longitude,$time,$ambientTemperature,$soilTemperature,$waterTemperature,$airHumidity,$pressure,$co,$airParticle,$windSpeed,$windDirection,$soilHumidity,$waterTurbidity,$waterSalinity);";
  mysqli_query($conn, $sql2);
  echo "Dados inseridos com sucesso.";
  }
  else{ //caso a hash não exista, informa ao usuário.
   echo "ID de estação não encontrado. Os dados não foram salvos.";
   echo "<br>";
  }

http_response_code(200);





?>

