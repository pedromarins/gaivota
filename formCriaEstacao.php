<?php
echo '
<HTML>
<body>
Criar Estação <br>
<form action="criaEstacao.php" metod="POST">
Nome do dono<input type="text" name="owner"/>
Email do dono<input type="text" name="email"/>
Tipo: <select name="type">
  <option value="settled">Estação de monitoramento fixa</option>
  <option value="portable">Estação de monitoramento móvel</option>
  <option value="floater">Estação de monitoramento flutuante</option>
</select>
Latidude<input type="text" name="latitude"/>
Longitude<input type="text" name="longitude"/>
<input type="submit" value="Enviar"/>
</form>
</body>
</HTML>
';
?>
