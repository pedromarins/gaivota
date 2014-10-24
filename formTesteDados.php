<?php
echo '
<HTML>
<body>
Enviar Dados: <br>
<form action="recebeDados.php" metod="POST">
Hash<input type="text" name="id"/><br>
air_temperature	<input type="text" name="air_temperature"/><br>
soil_temperature	<input type="text" name="soil_temperature"/><br>
water_temperature	<input type="text" name="water_temperature"/><br>
air_humidity	<input type="text" name="air_humidity"/><br>
air_pressure	<input type="text" name="air_pressure"/><br>
air_co2	<input type="text" name="air_co2"/><br>
air_particule	<input type="text" name="air_particule"/><br>
wind_speed	<input type="text" name="wind_speed"/><br>
wind_direction	<input type="text" name="wind_direction"/><br>
soil_humidity	<input type="text" name="soil_humidity"/><br>
water_turbidity	<input type="text" name="water_turbidity"/><br>
water_salinity	<input type="text" name="water_salinity"/><br>
<input type="submit" value="Enviar"/>
</form>
Exemplo de hash já cadastrada para teste: 5b5392cf5642f7f0980768f899759c4e
<br>
Para criar uma nova estação acesse <a href="formCriaEstacao.php">formCriaEstacao.php</a>

</body>
</HTML>
';
?>

