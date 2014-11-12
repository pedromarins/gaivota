<?php include("_header.php") ?>

    <section class="banner share">
        <h2>Cadastrar estação</h2>
    </section>
    <section class="content-block new-station">
		<form action="fale-conosco.php" method="post">
			<label for="nome">Seu nome</label>
			<input id="nome" type="text" name="nome">
			<label for="email">Seu email</label>
			<input id="email" type="text" name"email">
                        <label for="texto">Texto:</label>
                        <textarea  id="texto" name="texto" style="color: black; background-color: white" rows="4" cols="50"> a</textarea>
			<input type="submit" value="Enviar mensagem">
		</form>
	</section>
<?php include("_footer.php") ?>
