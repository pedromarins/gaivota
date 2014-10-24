<?php

//incui conector banco de dados
include 'db.php';

//pega dados enviados pelo formulário
$owner = $_GET['owner'];
$email = $_GET['email'];
$type = $_GET['type'];
$lat = $_GET['latitude'];
$long = $_GET['longitude'];

$date = date('YmdHis');
$hash = '';


function createHash(){ //cria função que gera um hash
 //cria hash
 $random = (string)rand();
 $key = $random . $date . $email . $owner . $latitude . $longitude;
 $hash = md5($key);
 // verifica se hash já existe no banco
 $sql = "SELECT * FROM station WHERE hash = '$hash'";
 $result = mysqli_query($conn, $sql);
 $row = mysqli_fetch_array($result);
 if (isset($row)) { //se chave já existe, cria outra
  createHash();
 }
return $hash;
}

//chama criação do hash
$hash = createHash();


//insere no banco
$sql = "INSERT INTO station(owner,email,type,latitude,longitude,hash) VALUES ('$owner','$email','$type',$lat,$long,'$hash');";
$result = mysqli_query($conn, $sql);

//verifica se query foi bem sucedida
if (!$result) {
 die('Erro na criação da estação. Favor contactar o suporte da Gaivota.' . mysql_error());
}

//imprime confirmação de criação
 //REFATORAR!
echo "Nova estação criada com os seguintes dados";
echo "<br>Dono = $owner";
echo "<br>Email = $email";
echo "<br>Tipo = $type";
echo "<br>Latitude = $lat";
echo "<br>Longitude = $long";
echo "<br>Data Criação = $date";
echo "<br>Hash = $hash";
echo "<br><br>Clique aqui para baixar o código a ser compilado no seu arduino. Clique ali para ler um tutorial sobre como mexer num arduino.";

?>

