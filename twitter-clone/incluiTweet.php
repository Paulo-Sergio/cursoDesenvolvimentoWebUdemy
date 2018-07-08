<?php

  session_start();

  // validar autenticacao
  if (!isset($_SESSION['usuario'])) {
		header('Location: index.php?erro=1');
	}

  require_once('db.class.php');

  $textoTweet = $_POST['textoTweet'];
  $idUsuario = $_SESSION['idUsuario'];

  if ($textoTweet == '' || $idUsuario == '') {
    die();
  }

  $pdo = new db();
  $connection = $pdo->conectaMysql();

  $sql = "INSERT INTO tweet(id_usuario, tweet) VALUES(:idUsuario, :tweet)";
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':idUsuario', $idUsuario);
  $stmt->bindValue(':tweet', $textoTweet);
  $stmt->execute();

?>