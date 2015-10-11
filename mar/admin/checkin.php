<?php

	//incui conector banco de dados
	include '../db.php';

	//pega dados enviados pelo formulário
	$usuario = $_GET['usuario'];
	$exposicao = $_GET['exposicao'];
	$date = date('YmdHis');

echo "<script>setTimeout(function(){window.location.href='exposicao.php?exposicao=";
echo $exposicao;
echo "'},8000);</script>";


//busca usuario no banco de dados
$sql = "SELECT u.usuario_id, u.nome, u.foto, b.nome as badge, b.imagem FROM usuario u inner join trofeu t on u.usuario_id = t.usuario_id inner join badge b on t.badge_id = b.badge_id  WHERE u.usuario_id ='$usuario' order by b.badge_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


if (isset($row)) { //verifica se a usuario existe e incui checkin na base
        //insere no banco
        $sql = "INSERT INTO checkin(usuario_id,exposicao_id,date) VALUES ('$usuario','$exposicao','$date');";
        $result2 = mysqli_query($conn, $sql);



        //verifica se query foi bem sucedida
        if (!$result2) {
         die('Erro na gravação do checkin. Favor contactar o suporte.' . mysql_error());
        }else{
       echo '<section class="banner share">
                <h2>Checkin feito!</h2>
        </section>
        <section class="content-block new-station">
                <dl>
                        <dt>Nome:</dt> <dd>';
echo $row['nome'];
echo '</dd>
                        <dt><img height="160" width="160" src="';

echo $row['foto'];
echo '"</dd>
                </dl>';

echo '<b>Meus Badges!</b><br>';

echo $row['badge'];
echo '<br><img  height="120" width="120" src="';
echo $row['imagem'];
echo '"><br>';

 }

while($row = mysqli_fetch_array($result)){
echo $row['badge'];
echo '<br><img  height="120" width="120" src="';
echo $row['imagem'];
echo '"><br>';

}


}else{ //caso o usuario não exista, informa ao usuário.
   echo "Cartão não encontrado. POr favor procure o suporte.";
   echo "<br>";
  }



?>


