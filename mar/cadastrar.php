<?php

session_start();


if(isset($_SESSION['username'])){
include  'index.php';
}else{  
         
function imprimeForm(){
echo '
Criar novo perfil:
<form action="cadastrar.php" method="get">
<label>Nome do usuário :</label>
<input id="nome" name="nome" type="text">
<label>E-mail:</label>
<input id="email" name="email" type="text">
<label>Link para foto :</label>
<input id="foto" name="foto" type="text">
<label>Número do cartão :</label>
<input id="usuario_id" name="usuario_id" type="text">


<input name="submit" type="submit" value="Login ">
</form>
</body>
</html>
';
}          
        
if($_GET['usuario_id']){
             
include 'db.php';

$usuario = $_GET['usuario_id'];
$nome = $_GET['nome'];
$foto = $_GET['foto'];
$email = $_GET['email'];

$sql = "insert into usuario (usuario_id,email,nome,foto) values ($usuario,'$email','$nome','$foto')";


$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


$_SESSION['username']=$usuario;
$_SESSION['nome']=$nome;


include 'index.php';

}else{
    
imprimeForm();        

}
}
?>


