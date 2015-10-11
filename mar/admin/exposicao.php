<?php 
include("_header.php");
include '../db.php';
 
$exposicao = $_GET['exposicao'];

//busca exposicao no banco de dados
$sql = "SELECT * FROM exposicao WHERE exposicao_id = '$exposicao'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if (isset($row)) { //verifica se a exposicao existe
$nome = $row['nome'];
} else{
$nome = "Genérica";
};



?>

    <section class="banner share">
        <h3>Passe seu cartão para fazer checkin na Exposição:</h3><h2> <?= $nome ?></h2>
    </section>
    <section class="content-block new-station">
		<form action="checkin.php" method="GET">
			<label for="usuario">Número da Cartão</label>
			<input id="exposicao" type="hidden" name="exposicao" value="<?= $exposicao ?>">
			<input id="usuario" type="text" name="usuario" autofocus>
			<input type="submit" value="Fazer Checkin">
		</form>
	</section>


<?php

$sql2 = "select Imagem from evandroteixeira order by rand() limit 5";
$result = mysqli_query($conn, $sql2);
while($row = mysqli_fetch_array($result)){
if (isset($row)) { //verifica se trouxe resposta
echo '<img height="120" width="120" src="';
echo $row['Imagem'];
echo '">';
};
};


?>

