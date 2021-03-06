<?php

  session_start();

  // validar autenticacao
  if (!isset($_SESSION['usuario'])) {
		header('Location: index.php?erro=1');
  }
  
  require_once('db.class.php');

  $nomePessoa = $_POST['nome_pessoa'];
  $idUsuario = $_SESSION['idUsuario'];

  $pdo = new db();
  $connection = $pdo->conectaMysql();

  $sql = "SELECT u.*, us.* 
          FROM usuarios AS u 
          LEFT JOIN usuarios_seguidores AS us ON (us.id_usuario = :idUsuario AND u.id = us.seguindo_id_usuario) 
          WHERE usuario LIKE :nomePessoa AND id <> :idUsuario";
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':nomePessoa', '%'.$nomePessoa.'%');
  $stmt->bindValue(':idUsuario', $idUsuario);
  $stmt->execute();
  if($stmt->rowCount() > 0) {
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($usuarios as $u) {
      $estaSeguindoUsuarioSN = isset($u['id_usuario_seguidor']) && !empty($u['id_usuario_seguidor']) ? 'S' : 'N';
      $btnSeguirDisplay = 'block';
      $btnDeixarDeSeguirDisplay = 'block';
      
      if ($estaSeguindoUsuarioSN == 'N') {
        $btnDeixarDeSeguirDisplay = 'none';
      } else {
        $btnSeguirDisplay = 'none';
      }

      echo '<a href="#" class="list-group-item">';
        echo '<strong>'.$u['usuario'].'</strong> <small> - '.$u['email'].' </small>';
        echo '<p class="list-group-item-text pull-right">';
          echo '<button type="button" id="btn_seguir_'.$u['id'].'" class="btn btn-primary btn_seguir" data-id_usuario="'.$u['id'].'" style="display:'.$btnSeguirDisplay.'">Seguir</button>';
          echo '<button type="button" id="btn_deixar_seguir_'.$u['id'].'" class="btn btn-default btn_deixar_seguir" data-id_usuario="'.$u['id'].'" style="display:'.$btnDeixarDeSeguirDisplay.'">Deixar de Seguir</button>';
        echo '</p>';
        echo '<div class="clearfix"></div>';
      echo '</a>';
    }
  } else {
    echo 'Nenhum usuário encontrado';
  }

?>