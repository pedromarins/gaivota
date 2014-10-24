<?php

//incui conector banco de dados
include 'db.php';

//pega dados enviados pela estação. adiciona '' nos campos não passados
$hash = $_GET['id'];

if ($_GET['air_temperature'] != '') {
 $air_temperature = $_GET['air_temperature'];
}
else {
  $air_temperature = "''";
}

if ($_GET['soil_temperature'] != '') {
 $soil_temperature = $_GET['soil_temperature'];
}
else {
  $soil_temperature = "''";
}

if ($_GET['water_temperature'] != '') {
 $water_temperature = $_GET['water_temperature'];
}
else {
  $water_temperature = "''";
}

if ($_GET['air_humidity'] != '') {
 $air_humidity = $_GET['air_humidity'];
}
else {
  $air_humidity = "''";
}

if ($_GET['air_pressure'] != '') {
 $air_pressure = $_GET['air_pressure'];
}
else {
  $air_pressure = "''";
}

if ($_GET['air_co2'] != '') {
 $air_co2 = $_GET['air_co2'];
}
else {
  $air_co2 = "''";
}

if ($_GET['air_particule'] != '') {
 $air_particule = $_GET['air_particule'];
}
else {
  $air_particule = "''";
}

if ($_GET['wind_speed'] != '') {
 $wind_speed = $_GET['wind_speed'];
}
else {
  $wind_speed = "''";
}

if ($_GET['wind_direction'] != '') {
 $wind_direction = $_GET['wind_direction'];
}
else {
  $wind_direction = "''";
}

if ($_GET['soil_humidity'] != '') {
 $soil_humidity = $_GET['soil_humidity'];
}
else {
  $soil_humidity = "''";
}

if ($_GET['water_turbidity'] != '') {
 $water_turbidity = $_GET['water_turbidity'];
}
else {
  $water_turbidity = "''";
}

if ($_GET['water_salinity'] != '') {
 $water_salinity = $_GET['water_salinity'];
}
else {
  $water_salinity = "''";
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
  $station_id = $row['station_id'];
  $sql2 = "INSERT INTO rawdata(station_id,type,latitude,longitude,time,air_temperature,soil_temperature,water_temperature,air_humidity,air_pressure,air_co2,air_particule,wind_speed,wind_direction,soil_humidity,water_turbidity,water_salinity) VALUES ($station_id,'$type',$latitude,$longitude,$time,$air_temperature,$soil_temperature,$water_temperature,$air_humidity,$air_pressure,$air_co2,$air_particule,$wind_speed,$wind_direction,$soil_humidity,$water_turbidity,$water_salinity);";
  mysqli_query($conn, $sql2);
  echo "Dados inseridos com sucesso.";
  }
  else{ //caso a hash não exista, informa ao usuário.
   echo "ID de estação não encontrado. Os dados não foram salvos.";
   echo "<br>";
  }


?>

