<?php 
include 'header.php';
include 'db.php';

if(isset($_GET['pergunta1'])){

$resposta1=$_GET['pergunta1'];
$resposta2=$_GET['pergunta2'];
$resposta3=$_GET['pergunta3'];

$certas = 0;

if($resposta1 == 0){$certas++;}
if($resposta2 == 0){$certas++;}
if($resposta3 == 0){$certas++;}

echo "Você acertou $certas perguntas !";

$usuario = $_SESSION['username'];
$id1 = $_GET['1'];
$id2 = $_GET['2'];
$id3 = $_GET['3'];

$sql = "INSERT INTO resposta(usuario_id,pergunta_id,opcao_respondida) VALUES ('$usuario','$id1','$resposta1');";
$result2 = mysqli_query($conn, $sql);
//verifica se query foi bem sucedida
if (!$result2) {
die('Erro na gravação da resposta. Favor contactar o suporte.' . mysql_error());
}

$sql = "INSERT INTO resposta(usuario_id,pergunta_id,opcao_respondida) VALUES ('$usuario','$id3','$resposta3');";
$result2 = mysqli_query($conn, $sql);
//verifica se query foi bem sucedida
if (!$result2) {
die('Erro na gravação da resposta. Favor contactar o suporte.' . mysql_error());
}

$sql = "INSERT INTO resposta(usuario_id,pergunta_id,opcao_respondida) VALUES ('$usuario','$id2','$resposta2');";
$result2 = mysqli_query($conn, $sql);
//verifica se query foi bem sucedida
if (!$result2) {
die('Erro na gravação da resposta. Favor contactar o suporte.' . mysql_error());
}


}else{ //para o if de existir resposta
 
if(isset($_GET['exposicao'])){

$exposicao = $_GET['exposicao'];

//busca exposicao no banco de dados
$sql = "SELECT * FROM pergunta WHERE exposicao_id = '$exposicao' limit 3";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if (isset($row)) { //verifica se existem perguntas para essa exposicao 

echo '<form action="quiz.php" method="GET">';
$numero = 1;
echo $row['texto'];
echo '<br> <input type="radio" name="pergunta';
echo $numero;
echo '" value="0">';
echo $row['resposta_certa'];
echo '<br> <input type="radio" name="pergunta';
echo $numero;
echo '" value="1">';
echo $row['resposta_errada1'];
echo '<br> <input type="radio" name="pergunta';
echo $numero;
echo '" value="2">';
echo $row['resposta_errada2'];
echo '<br> <input type="radio" name="pergunta';
echo $numero;
echo '" value="3">';
echo $row['resposta_errada3'];
echo '<br><br>';
echo '<input id="';
echo $numero;
echo '" type="hidden" name="';
echo $numero;
echo '" value="';
echo $row['pergunta_id'];
echo '">';

$numero++;

while($row = mysqli_fetch_array($result)){
echo $row['texto'];
echo '<br> <input type="radio" name="pergunta';
echo $numero;
echo '" value="0">';
echo $row['resposta_certa'];
echo '<br> <input type="radio" name="pergunta';
echo $numero;
echo '" value="1">';
echo $row['resposta_errada1'];
echo '<br> <input type="radio" name="pergunta';
echo $numero;
echo '" value="2">';
echo $row['resposta_errada2'];
echo '<br> <input type="radio" name="pergunta';
echo $numero;
echo '" value="3">';
echo $row['resposta_errada3'];
echo '<br><br>';
echo '<input id="';
echo $numero;
echo '" type="hidden" name="';
echo $numero;
echo '" value="';
echo $row['pergunta_id'];
echo '">';


$numero++;
 }
echo '<input type="submit" value="Responder"> </form>';


} else{ //para o if que verifica se existem perguntas
echo "Não existem dados para gerar perguntas sobre essa exposição";
};

}else{ //para o if que verifica se foi passada exposicao

$usuario = $_SESSION['username'];
//busca exposicoes visitadas pelo usuario no banco de dados
$sql = "select distinct e.exposicao_id, e.nome from exposicao e, usuario u, checkin c where e.exposicao_id = c.exposicao_id and u.usuario_id = c.usuario_id and u.usuario_id = $usuario;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if (isset($row)) { //verifica se existem exposicoes visitadas
echo 'Escolha a exposição que você visitou para responder a perguntas!<br> ';

$exposicao = $row['exposicao_id'];
$nome = $row['nome'];
echo "<a href='quiz.php?exposicao=$exposicao'>$nome</a><br>";
while($row = mysqli_fetch_array($result)){
$exposicao = $row['exposicao_id'];
$nome = $row['nome'];
echo "<a href='quiz.php?exposicao=$exposicao'>$nome</a><br>";

};


}else{ //para o if do usuario ter visitado algo
echo 'Para responder perguntas sobre exposições é necessário visitás-la e realizar checkin primeiro.';

};

};

};
?>

