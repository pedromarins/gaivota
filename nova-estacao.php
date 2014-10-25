<?php include("_header.php") ?>

    <section class="banner share">
        <h2>Cadastrar estação</h2>
    </section>
    <section class="content-block new-station">
		<form action="criaEstacao.php" method="GET">
			<label for="owner">Seu nome</label>
			<input id="owner" type="text" name="owner">
			<label for="email">Seu email</label>
			<input id="email" type="text" name="email">
			<label for="type">Tipo da estação</label>
			<select id="type" name="type">
				<option value="settled">fixa</option>
				<option value="portable">portátil</option>
				<option value="floater">flutuante</option>
			</select>
			<label for="latitude">Latidude</label>
			<input id="latitude" type="text" name="latitude">
			<label for="longitude">Longitude</label>
			<input id="longitude" type="text" name="longitude">
			<input type="submit" value="Cadastrar estação">
		</form>
	</section>
<?php include("_footer.php") ?>