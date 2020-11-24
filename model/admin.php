<?php 
  require_once 'db.php';

  class Admin {
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

    // USUARIOS

    public function insertUser($user, $password, $admin) {
      try {
        $sql = "INSERT INTO usuarios(usuario_nome, usuario_senha, usuario_admin) 
                VALUES(:user, :password, :admin)";
        
        $stmt = $this->conn->prepare($sql);

        $stmt->bindparam(":user", $user);
        $stmt->bindparam(":password", $password);
        $stmt->bindparam(":admin", $admin);
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

    public function updateUser($id, $user, $password, $admin) {
      try {
        $sql = "UPDATE usuarios
                SET usuario_nome = :user,
                usuario_senha = :password,
                usuario_admin = :admin
                WHERE usuario_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam(":id", $id);
        $stmt->bindparam(":user", $user);
        $stmt->bindparam(":password", $password);
        $stmt->bindparam(":admin", $admin);
        $stmt->execute();
        return $stmt;
      } 
      catch (PDOException $e) {
        echo("Error: ".$e->getMessage());
      }
      finally {
        $this->conn = null;
      }
    }

    public function deleteUser($id) {
      try {
        $sql = "DELETE FROM usuarios where usuario_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return $stmt;
      } 
      catch (PDOException $e) {
        echo("Error: ".$e->getMessage());
      }
      finally {
        $this->conn = null;
      }
    }

    // SERVICOS

    public function insertService($name, $desc) {
      try {
        $sql = "INSERT INTO servicos(servico_titulo, servico_descricao) 
                VALUES(:name, :desc)";
        
        $stmt = $this->conn->prepare($sql);

        $stmt->bindparam(":name", $name);
        $stmt->bindparam(":desc", $desc);
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

    public function updateService($id, $name, $desc) {
      try {
        $sql = "UPDATE servicos
                SET servico_titulo = :name,
                servico_descricao = :desc
                WHERE servico_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam(":id", $id);
        $stmt->bindparam(":name", $name);
        $stmt->bindparam(":desc", $desc);
        $stmt->execute();
        return $stmt;
      } 
      catch (PDOException $e) {
        echo("Error: ".$e->getMessage());
      }
      finally {
        $this->conn = null;
      }
    }

    public function deleteService($id) {
      try {
        $sql = "DELETE FROM servicos 
                WHERE servico_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return $stmt;
      } 
      catch (PDOException $e) {
        echo("Error: ".$e->getMessage());
      }
      finally {
        $this->conn = null;
      }
    }

    // EVENTOS 

    public function insertEvent($name, $desc, $begin, $end, $status, $cbServices, $client) {
      try {
        $sql = "INSERT INTO eventos(evento_titulo, evento_descricao, evento_inicio, evento_termino, evento_situacao, fk_usuario) 
                VALUES(:name, :desc, :begin, :end, :status, :client)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam(":name", $name);
        $stmt->bindparam(":desc", $desc);
        $stmt->bindparam(":begin", $begin);        
        $stmt->bindparam(":end", $end);
        $stmt->bindparam(":status", $status);
        $stmt->bindparam(":client", $client);        
        $stmt->execute();

        $lastID = $this->conn->lastInsertId();
        foreach($cbServices as $serviceID){          
          $sql2 = "INSERT INTO eventos_servicos(evento_id, servico_id)
          VALUES(:lastid, :serviceid)";
          $stmt2 = $this->conn->prepare($sql2);
          $stmt2->bindparam(":lastid", $lastID);
          $stmt2->bindparam(":serviceid", $serviceID);
          $stmt2->execute();
        }

        return $stmt;
      }
      catch(PDOException $e) {
        echo("Error: ".$e->getMessage());
      }
      finally {
        $this->conn = null;
      }
    }

    public function updateEvent($id, $name, $desc, $status) {
      try {
        $sql = "UPDATE eventos
                SET evento_titulo = :name,
                evento_descricao = :desc,
                evento_situacao = :status
                WHERE evento_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam(":id", $id);
        $stmt->bindparam(":name", $name);
        $stmt->bindparam(":desc", $desc);
        $stmt->bindparam(":status", $status);
        $stmt->execute();
        return $stmt;
      } 
      catch (PDOException $e) {
        echo("Error: ".$e->getMessage());
      }
      finally {
        $this->conn = null;
      }
    }

    public function deleteEvent($id) {
      try {
        $sql = "DELETE FROM eventos_servicos where evento_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam(":id", $id);
        $stmt->execute();

        $sql = "DELETE FROM eventos where evento_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam(":id", $id);
        $stmt->execute();

        return $stmt;
      } 
      catch (PDOException $e) {
        echo("Error: ".$e->getMessage());
      }
      finally {
        $this->conn = null;
      }
    }


    // REDIRECT

    public function redirect($url) {
      header("Location: $url");
    }
  }
?>