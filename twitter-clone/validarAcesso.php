<?php

  session_start();

  require_once('db.class.php');

  $usuario = $_POST['usuario'];
  $senha = md5($_POST['senha']);

  $pdo = new db();
  $connection = $pdo->conectaMysql();

  $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND senha = :senha";
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':usuario', $usuario);
  $stmt->bindValue(':senha', $senha);
  $stmt->execute();

  if($stmt->execute()) {
    if($stmt->rowCount() > 0) {
      $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);
      $_SESSION['idUsuario'] = $dadosUsuario['id'];
      $_SESSION['usuario'] = $dadosUsuario['usuario'];
      $_SESSION['email'] = $dadosUsuario['email'];
      header('Location: home.php');
      exit;
    } else {
      header('Location: index.php?erro=1');
      exit;
    }
  } else {
    echo 'Falhou, error no servidor!!!';
  }
  

?>