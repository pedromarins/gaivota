<?php include("_header.php") ?>

    <section class="banner share">
        <h2>Fale conosco</h2>
    </section>
    <section class="content-block new-station">
		<form name="fale-conosco" methos="get" action="contato.php">
			<label for="nome">Seu nome</label>
			<input id="nome" type="text" name="nome">
			<label for="email">Seu email</label>
			<input id="email"type="text" name="email">
			<label for="texto">Mensagem</label>
			<input id="texto" type="text" name="texto">
			<input type="submit" value="Enviar mensagem">
		</form>
	</section>
<?php include("_footer.php") ?>
