<?php

	session_start();

	if (!isset($_SESSION['usuario'])) {
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');
	$pdo = new db();
	$connection = $pdo->conectaMysql();

	$idUsuario = $_SESSION['idUsuario'];

	// Qtde de tweets
	$qtdeTweets = 0;
	$sql = "SELECT COUNT(*) AS qtde_tweets FROM tweet WHERE id_usuario = :idUsuario";
	$stmt = $connection->prepare($sql);
	$stmt->bindValue(':idUsuario', $idUsuario);
	$stmt->execute();
	if($stmt->rowCount() > 0) {
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$qtdeTweets = $result['qtde_tweets'];
	}

	// Qtde de seguidores
	$qtdeSeguidores = 0;
	$sql = "SELECT COUNT(*) AS qtde_seguidores FROM usuarios_seguidores WHERE seguindo_id_usuario = :idUsuario";
	$stmt = $connection->prepare($sql);
	$stmt->bindValue(':idUsuario', $idUsuario);
	$stmt->execute();
	if($stmt->rowCount() > 0) {
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$qtdeSeguidores = $result['qtde_seguidores'];
	}

?>

<!DOCTYPE HTML>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">

	<title>Twitter clone</title>

	<!-- jquery - link cdn -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

	<!-- bootstrap - link cdn -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<script type="text/javascript">
		$(document).ready(function() {
			// associar evento de click ao botão
			$('#btn_procurar_pessoa').click(function() {
				if ($('#nome_pessoa').val().length > 0) {

					$.ajax({
						url: 'getPessoas.php',
						method: 'post',
						data: $('#form_procurar_pessoas').serialize(),
						success: function(data) {
							$('#pessoas').html(data);

							$('.btn_seguir').click(function() {
								// atributo customizado 'data-id_usuario' em cada butão se Seguir
								var idUsuario = $(this).data('id_usuario');

								$('#btn_seguir_'+idUsuario).hide();
								$('#btn_deixar_seguir_'+idUsuario).show();

								$.ajax({
									url: 'seguir.php',
									method: 'post',
									data: { seguirIdUsuario: idUsuario },
									success: function(data) {
										console.log('requisição efetuada')
									}
								}) /** metodo ajax seguir.php */
							})/** .btn_seguir */

							$('.btn_deixar_seguir').click(function() {
								// atributo customizado 'data-id_usuario' em cada butão se Seguir
								var idUsuario = $(this).data('id_usuario');

								$('#btn_seguir_'+idUsuario).show();
								$('#btn_deixar_seguir_'+idUsuario).hide();

								$.ajax({
									url: 'deixarDeSeguir.php',
									method: 'post',
									data: { deixarDeSeguirIdUsuario: idUsuario },
									success: function(data) {
										console.log('deixou de seguir')
									}
								}) /** metodo ajax seguir.php */
							})/** .btn_deixar_seguir */
						}

					})/** metodo ajax getPessoas.php */

				}
			})/** #btn_procurar_pessoa */			
		})
	</script>

</head>

<body>

	<!-- Static navbar -->
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
				 aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="home.php"><img src="imagens/icone_twitter.png" /></a> Bem-vindo(a): <strong><?= $_SESSION['usuario'] ?></strong>
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
          <li>
						<a href="home.php">Home</a>
					</li>
					<li>
						<a href="sair.php">Sair</a>
					</li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>


	<div class="container">
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<h4><?= $_SESSION['usuario'] ?></h4>

					<hr />
					<div class='col-md-6'>
						TWEETS <br /> <?= $qtdeTweets ?>
					</div>
					<div class='col-md-6'>
						SEGUIDORES <br /> <?= $qtdeSeguidores ?>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
					<form id='form_procurar_pessoas' class="input-group">
						<input type="text" id='nome_pessoa' name='nome_pessoa' class='form-control' maxlength='140' placeholder='Quem você esta procurando?'>
						<span class='input-group-btn'>
							<button class='btn btn-default' id='btn_procurar_pessoa' type='button'>Procurar</button>
						</span>
					</form>
				</div>
			</div>

			<div id='pessoas' class='list-group'></div>
		</div>

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
					
				</div>
			</div>
		</div>
	</div>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>

</html>