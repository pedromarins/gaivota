<?php
	//incui conector banco de dados
	include 'db.php';

	//pega dados enviados pelo formulário
	$owner = $_GET['owner'];
	$email = $_GET['email'];
	$type = $_GET['type'];
	$lat = $_GET['latitude'];
	$long = $_GET['longitude'];

	$date = date('YmdHis');
	$hash = '';


	function createHash(){ //cria função que gera um hash
	 //cria hash
	 $random = (string)rand();
	 $key = $random . $date . $email . $owner . $latitude . $longitude;
	 $hash = md5($key);
	 // verifica se hash já existe no banco
	 $sql = "SELECT * FROM station WHERE hash = '$hash'";
	 $result = mysqli_query($conn, $sql);
	 $row = mysqli_fetch_array($result);
	 if (isset($row)) { //se chave já existe, cria outra
	  createHash();
	 }
	return $hash;
	}

	//chama criação do hash
	$hash = createHash();


	//insere no banco
	$sql = "INSERT INTO station(owner,email,type,latitude,longitude,hash) VALUES ('$owner','$email','$type',$lat,$long,'$hash');";
	$result = mysqli_query($conn, $sql);

	//verifica se query foi bem sucedida
	if (!$result) {
	 die('Erro na criação da estação. Favor contactar o suporte da Gaivota.' . mysql_error());
	}
?>

<?php include("_header.php") ?>

	<section class="banner share">
		<h2>Estação criada!</h2>
	</section>
	<section class="content-block new-station">
		<dl>
			<dt>Nome:</dt> <dd><?= $owner ?>a</dd>
			<dt>Email:</dt> <dd><?= $email ?>a</dd>
			<dt>Tipo de estação:</dt> <dd><?= $type ?>a</dd>
			<dt>Latitude:</dt> <dd><?= $lat ?>a</dd>
			<dt>Longitude:</dt> <dd><?= $long ?>a</dd>
			<dt>Data de criação:</dt> <dd><?= $date ?>a</dd>
			<dt>Hash de autenticação:</dt> <dd><?= $hash ?>a</dd>
		</dl>
	</section>
	<section class="content-block your-own">
		<h3 class="content-title">Envie seus dados</h3>
		<p class="content-text">Clique abaixo para baixar o código a ser compilado na sua estação.</p>
		<a href="#" class="download"><span>Download do código</span></a>
	</section>

<?php include("_footer.php") ?>
