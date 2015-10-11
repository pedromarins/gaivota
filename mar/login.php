<?php


session_start();

if(isset($_SESSION['username'])){
include  'index.php';
}else{  
         
function imprimeForm(){
echo '
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<link rel="stylesheet" href="mar-de-dados/app/assets/css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
</head>
<body class="login-page">
	<h1 class="login-page--title">Navegando<br>no MAR</h1>
	<form action="login.php" method="GET" class="login-page--form">
		<label for="username" class="login-page--label">Número do cartão</label>
		<input type="text" id="username" name="username" class="login-page--input">

		<input type="submit" value="Entrar" class="login-page--button">
	</form>
</body>
</html>
';
}          
        
if($_GET['username']){
             
include 'db.php';

$usuario = $_GET['username'];
//busca usuario no banco de dados
$sql = "SELECT * FROM usuario WHERE usuario_id = '$usuario'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


if (isset($row)) { //verifica se a usuario existe e cria sessao

$_SESSION['username']=$usuario;
$_SESSION['nome']=$row['nome'];
include 'index.php';


}else{
echo "usuário nao encontado. Deseja se <a href='cadastrar.html'>cadastrar</a>?<br>";
imprimeForm();

}

}else{
    
imprimeForm();        

}
}

?>


