<?php
session_start();

if(!empty($_SESSION['username']))
{


echo "Olá ";
echo $_SESSION['nome'];
echo " <a href='logout.php'>Sair</a>";
echo "<br><br>";

//incluir menu de logado
}else{
// incluir menu de nao logado
echo "<a href='login.php'>Fazer login</a>  <a href='cadastrar.php'>Cadastrar novo perfil</a><br><br>";
}


?>
