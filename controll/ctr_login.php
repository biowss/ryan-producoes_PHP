<?php 
  require_once '../model/login.php';
  $objLogin = new Login();

  if(isset($_POST['validate'])) {
    $user = $_POST['user'];
    $password = $_POST['user-password'];    

    if($stmt = $objLogin->validate($user, $password)) {
      if($stmt->rowCount() > 0) {
        $rowUsuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        session_start();
        $_SESSION["id"] = $rowUsuario["usuario_id"];
        $_SESSION["user"] = $rowUsuario["usuario_nome"];
        $_SESSION["admin"] = $rowUsuario["usuario_admin"];
        $_SESSION["last_activity"] = time();

        if($_SESSION["admin"]) {
          $objLogin->redirect('../view/dashboard-admin.php');
        }
        else {
          $objLogin->redirect('../view/dashboard-cliente.php');
        }
      }
      else {
        echo "<script>                
                alert('Login Invalido!');
                window.location.href='../view/login.php';
              </script>";
      }
    }
  }
?>