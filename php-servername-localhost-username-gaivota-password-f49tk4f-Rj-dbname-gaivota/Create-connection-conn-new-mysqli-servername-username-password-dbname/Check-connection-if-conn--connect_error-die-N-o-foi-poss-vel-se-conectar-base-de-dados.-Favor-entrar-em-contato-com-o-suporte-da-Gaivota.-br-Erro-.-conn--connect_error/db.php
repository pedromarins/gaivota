<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "gaivota";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
 die("Não foi possível se conectar à base de dados. Favor entrar em contato com o suporte da Gaivota.<br>Erro: " . $conn->connect_error);
}
//echo "Connected successfully";
?> 
