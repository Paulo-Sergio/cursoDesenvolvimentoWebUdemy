<?php

  session_start();

  // validar autenticacao
  if (!isset($_SESSION['usuario'])) {
		header('Location: index.php?erro=1');
  }
  
  require_once('db.class.php');

  $idUsuario = $_SESSION['idUsuario'];

  $pdo = new db();
  $connection = $pdo->conectaMysql();

  $sql = "SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, t.tweet, u.usuario 
          FROM tweet as t 
          JOIN usuarios as u ON (t.id_usuario = u.id) 
          WHERE id_usuario = :idUsuario ORDER BY data_inclusao DESC";
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':idUsuario', $idUsuario);
  $stmt->execute();
  if($stmt->rowCount() > 0) {
    $tweets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($tweets as $tweet) {
      echo '<a href="#" class="list-group-item">';
        echo '<h4 class="list-group-item-heading">'.$tweet['usuario'].' <small> - '.$tweet['data_inclusao_formatada'].'</small></h4>';
        echo '<p class="list-group-item-text">'.$tweet['tweet'].'</p>';
      echo '</a>';
    }
    // echo json_encode($tweets); eu poderia enviar o json e tratar os tweets com foreach jquery
  } else {
    echo 'Nenhum tweet no momento';
  }

?>