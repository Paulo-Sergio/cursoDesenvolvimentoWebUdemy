<?php

  session_start();

  // validar autenticacao
  if (!isset($_SESSION['usuario'])) {
		header('Location: index.php?erro=1');
	}

  require_once('db.class.php');

  $idUsuario = $_SESSION['idUsuario'];
  $seguirIdUsuario = $_POST['seguirIdUsuario'];

  if ($seguirIdUsuario == '' || $idUsuario == '') {
    die();
  }

  $pdo = new db();
  $connection = $pdo->conectaMysql();

  $sql = "INSERT INTO usuarios_seguidores(id_usuario, seguindo_id_usuario) VALUES(:idUsuario, :seguindoIdUsuario)";
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':idUsuario', $idUsuario);
  $stmt->bindValue(':seguindoIdUsuario', $seguirIdUsuario);
  $stmt->execute();

?>