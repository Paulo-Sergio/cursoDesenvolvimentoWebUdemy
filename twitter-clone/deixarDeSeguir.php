<?php

  session_start();

  // validar autenticacao
  if (!isset($_SESSION['usuario'])) {
		header('Location: index.php?erro=1');
	}

  require_once('db.class.php');

  $idUsuario = $_SESSION['idUsuario'];
  $deixarDeSeguirIdUsuario = $_POST['deixarDeSeguirIdUsuario'];

  if ($deixarDeSeguirIdUsuario == '' || $idUsuario == '') {
    die();
  }

  $pdo = new db();
  $connection = $pdo->conectaMysql();

  $sql = "DELETE FROM usuarios_seguidores WHERE id_usuario = :idUsuario AND seguindo_id_usuario = :deixarDeSeguirIdUsuario";
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':idUsuario', $idUsuario);
  $stmt->bindValue(':deixarDeSeguirIdUsuario', $deixarDeSeguirIdUsuario);
  $stmt->execute();

?>