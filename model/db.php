<?php

  class Database {
    private $hostName = "localhost";
    private $port = "3406";
    private $dbName = "ryan-producoes_db";
    private $userName = "root";
    private $senha = "";

    public $conn;

    public function dbconn() {
      $this->conn = null;
      try {
        $this->conn = new PDO("mysql:host=$this->hostName;port=$this->port;dbname=$this->dbName",
        $this->userName, $this->senha);

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e) {
        echo $e->getMessage();
        echo("Não conectado!!!");
      }
      return $this->conn;
    }
  }

?>