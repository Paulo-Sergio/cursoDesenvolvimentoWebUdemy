<?php 

  require_once('db.class.php');

  $usuario = $_POST['usuario'];
  $email = $_POST['email'];
  $senha = md5($_POST['senha']);

  $pdo = new db();
  $connection = $pdo->conectaMysql();

  $usuarioExistente = false;
  $emailExistente = false;

  // verificar se usuario ou email já existe
  $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':usuario', $usuario);
  $stmt->execute();
  if($stmt->rowCount() > 0) {
    echo 'Usuário já cadastrado!';
    $usuarioExistente = true;
  }

  $sql = "SELECT * FROM usuarios WHERE email = :email";
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':email', $email);
  $stmt->execute();
  if($stmt->rowCount() > 0) {
    echo 'E-mail já cadastrado!';
    $emailExistente = true;
  }

  if($usuarioExistente || $emailExistente) {
    $msgRetorno = '';
    if ($usuarioExistente) $msgRetorno .= 'erro_usuario=1&';
    if ($emailExistente) $msgRetorno .= 'erro_email=1&';
    header('Location: inscrevase.php?' . $msgRetorno);
    exit;
  }


  // inserir usuário
  $sql = "INSERT INTO usuarios(usuario, email, senha) VALUES (:usuario, :email, :senha)";
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':usuario', $usuario);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':senha', $senha);
  $stmt->execute();

  if($stmt->rowCount() > 0) {
    echo 'cadastro com sucesso';
  } else {
    echo 'Falhou';
  }

?>