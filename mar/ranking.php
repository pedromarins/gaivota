<?php
include("_header.php");
include 'db.php';
 

//busca total de checkins
$sql="select * , (COALESCE(100*e.exposicoes,0)+COALESCE(10*c.total,0)+COALESCE(30*r.certas,0) ) as pontuacao
from (select u.usuario_id, u.nome, u.foto, count(*) as total from usuario u, exposicao e, checkin c where u.usuario_id = c.usuario_id and c.exposicao_id = e.exposicao_id group by u.usuario_id order by 2 desc) c left join (select usuario_id, count(*) as certas from resposta where opcao_respondida = 0) r on c.usuario_id = r.usuario_id left join 
(select usuario_id, count(*) as exposicoes from (select usuario_id, exposicao_id from checkin group by usuario_id, exposicao_id) a group by usuario_id) e on c.usuario_id = e.usuario_id order by 9 desc;";
$result = mysqli_query($conn, $sql);



echo 'Ratos de museu<table border=1><tr><td></td><td>Frenquetador</td><td>Pontuação</td></tr>';
while($row = mysqli_fetch_array($result)){
echo '<tr><td><img  height="42" width="42" src="';
echo $row['foto'];
echo '"></td><td>';
echo $row['nome'];
echo '</td><td>';
echo $row['pontuacao'];
echo '</td></tr>';

 }
echo "</table>";

echo "O ranking é calculado da seguinte forma: Cada exposição visitada vale 100 pontos. Cada checkin adicional em uma exposição 10 pontos e cada resposta certa 30 pontos.";



?>


