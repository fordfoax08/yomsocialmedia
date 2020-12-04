<?php

class Dsn{
  private $servername;
  private $username;
  private $password;
  private $database;
  private $charset;

  public function connect(){
    $this->servername = 'localhost';
    $this->username = 'root';
    $this->password = '';
    $this->database = 'socialmedia';
    $this->charset = 'utf8mb4';

    try {
      $dsn = "mysql:host=".$this->servername.";dbname=".$this->database.";charset=".$this->charset;
      $pdo = new PDO($dsn,$this->username,$this->password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e) {
      echo 'ERROR CONNECTION: '.$e->getMessage();
    }
  }

}

$text = 'CONNECTED';
?>