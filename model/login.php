<?php 
  require_once 'db.php';

  class Login {
    private $conn;

    public function __construct() {
      $database = new Database();
      $db = $database->dbconn();
      $this->conn = $db;
    }

    public function runQuery($sql) {
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }

    public function validate($user, $password) {
      try {        
        $sql = "SELECT * FROM `usuarios`
        WHERE `usuario_nome` = :user AND `usuario_senha` = :password";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam(":user", $user);        
        $stmt->bindparam(":password", $password);
        $stmt->execute();

        return $stmt;
      }
      catch(PDOException $e) {
        echo("Error: ".$e->getMessage());
      }
      finally {
        $this->conn = null;
      }
    }

    public function redirect($url) {
      header("Location: $url");
    }
  }
?>