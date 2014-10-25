<?php
echo '
<HTML>
<body>
Enviar Dados: <br>
<form action="recebeDados.php" metod="POST">
Hash<input type="text" name="id"/><br>

ambientTemperature	<input type="text" name="ambientTemperature"/><br>
soilTemperature	<input type="text" name="soilTemperature"/><br>
waterTemperature	<input type="text" name="waterTemperature"/><br>
airHumidity	<input type="text" name="airHumidity"/><br>
pressure	<input type="text" name="pressure"/><br>
co	<input type="text" name="co"/><br>
airParticule	<input type="text" name="airParticule"/><br>
windSpeed	<input type="text" name="windSpeed"/><br>
windDirection	<input type="text" name="windDirection"/><br>
soilHumidity	<input type="text" name="soilHumidity"/><br>
waterTurbidity	<input type="text" name="waterTurbidity"/><br>
waterSalinity	<input type="text" name="waterSalinity"/><br>
<input type="submit" value="Enviar"/>
</form>
Exemplo de hash já cadastrada para teste: 5b5392cf5642f7f0980768f899759c4e
<br>
Para criar uma nova estação acesse <a href="formCriaEstacao.php">formCriaEstacao.php</a>

</body>
</HTML>
';
?>

