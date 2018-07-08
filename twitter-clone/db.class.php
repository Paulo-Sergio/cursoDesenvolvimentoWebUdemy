<?php

class db {

  // host
  private $host = 'localhost';

  // usuario
  private $usuario = 'root';

  // senha
  private $senha = '';

  // banco de dados
  private $database = 'twitter_clone_udemy';

  public function conectaMysql() {
    try{
        $pdo = new PDO("mysql:dbname=".$this->database.";host=".$this->host.";charset=utf8", $this->usuario, $this->senha);
        return $pdo;
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
        exit;
    }
  }
}