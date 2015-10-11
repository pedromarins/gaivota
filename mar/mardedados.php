<?php
include 'header.php';
include 'db.php';
 
$sql="select e.nome, count(*) as total from usuario u, exposicao e, checkin c where u.usuario_id = c.usuario_id and c.exposicao_id = e.exposicao_id group by e.exposicao_id order by 2 desc";
$result = mysqli_query($conn, $sql);
echo '<br/><br/><br/>Exposicoes mais quentes<br/>';
echo '<table border=1><tr><td>Exposicao</td><td>Checkins</td></tr>';
while($row = mysqli_fetch_array($result)){
echo '<tr><td>';
echo $row['nome'];
echo '</td><td>';
echo $row['total'];
echo '</td></tr>';

 }
echo "</table>";

echo '<b>Detalhamento de uma exposição:</b>';
$sql="select nome, termino, inicio from exposicao where exposicao_id=1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
echo '<br> nome:';
echo $row['nome'];
echo '<br> início:';
echo $row['inicio'];
echo '<br> término:';
echo $row['termino'];


$sql="select  count(*)  as obras from evandroteixeira";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
echo '<br> número de obras:';
echo $row['obras'];

$sql="select  avg(Seguro) as seguro from evandroteixeira";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
echo '<br> valor médio do seguro das obras:';
echo $row['seguro'];





$sql="select  Nucleo as nome, count(*) as total from evandroteixeira where Nucleo <> '' group by 1 order by 2 desc";
$result = mysqli_query($conn, $sql);
echo '<br/><br/><br/>Núcleos presentes na exposicao<br/>';
echo '<table border=1><tr><td>Nucleos</td><td>Obras</td></tr>';
while($row = mysqli_fetch_array($result)){
echo '<tr><td>';
echo $row['nome'];
echo '</td><td>';
echo $row['total'];
echo '</td></tr>';

 }
echo "</table>";

$sql="select Artista as nome, count(*) as total from evandroteixeira group by 1 order by 2 desc";
$result = mysqli_query($conn, $sql);
echo '<br/><br/><br/>Artistas presentes na exposicao<br/>';
echo '<table border=1><tr><td>Artistas</td><td>Obras</td></tr>';
while($row = mysqli_fetch_array($result)){
echo '<tr><td>';
echo $row['nome'];
echo '</td><td>';
echo $row['total'];
echo '</td></tr>';

 }
echo "</table>";

$sql="select Proprieterio as nome, count(*) as total from evandroteixeira group by 1 order by 2 desc";
$result = mysqli_query($conn, $sql);
echo '<br/><br/><br/>Proprietários presentes na exposicao<br/>';
echo '<table border=1><tr><td>Proprietário</td><td>Obras</td></tr>';
while($row = mysqli_fetch_array($result)){
echo '<tr><td>';
echo $row['nome'];
echo '</td><td>';
echo $row['total'];
echo '</td></tr>';

 }
echo "</table>";





?>

