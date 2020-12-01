<?php 
  require_once '../model/admin.php';
  $objAdmin = new Admin();

  // USUARIOS

  if(isset($_POST['add_user'])) {
    $user = $_POST['txtUser'];
    $password = $_POST['txtPassword'];
    $admin = $_POST['txtAdmin'];

    if($objAdmin->insertUser($user, $password, $admin)) {
      $objAdmin->redirect('../view/dashboard-admin-usuarios.php');
    }
  }

  if(isset($_POST['edit_user'])) {
    $id = $_POST['edit_user'];
    $user = $_POST['txtUser'];
    $password = $_POST['txtPassword'];
    $admin = $_POST['txtAdmin'];

    if($objAdmin->updateUser($id, $user, $password, $admin)) {
      $objAdmin->redirect('../view/dashboard-admin-usuarios.php');
    }
  }

  if (isset($_POST['delete_user'])) {
    $id = $_POST['delete_user'];

    if($objAdmin->deleteUser($id)) {
      $objAdmin->redirect('../view/dashboard-admin-usuarios.php');
    }
  }

  // SERVIÇOS  

  if(isset($_POST['add_service'])) {
    $name = $_POST['txtName'];
    $desc = $_POST['txtDesc'];
    

    if($objAdmin->insertService($name, $desc)) {
      $objAdmin->redirect('../view/dashboard-admin-servicos.php');
    }
  }

  if(isset($_POST['edit_service'])) {
    $id = $_POST['edit_service'];
    $name = $_POST['txtName'];
    $desc = $_POST['txtDesc'];

    if($objAdmin->updateService($id, $name, $desc)) {
      $objAdmin->redirect('../view/dashboard-admin-servicos.php');
    }
  }
  
  if (isset($_POST['delete_service'])) {
    $id = $_POST['delete_service'];

    if($objAdmin->deleteService($id)) {
      $objAdmin->redirect('../view/dashboard-admin-servicos.php');
    }
  }

  // EVENTOS

  if(isset($_POST['add_event'])) {
    $name = $_POST['txtName'];
    $desc = $_POST['txtDesc'];
    $begin = $_POST['txtBeginDate'];
    $end = $_POST['txtDueDate'];
    $status = $_POST['txtStatus'];
    $client = $_POST['txtClient'];
    $cbServices = $_POST['cbServices'];


    if($objAdmin->insertEvent($name, $desc, $begin, $end, $status, $cbServices, $client)) {
      $objAdmin->redirect('../view/dashboard-admin-eventos.php');
    }
  }

  if(isset($_POST['edit_event'])) {
    $id = $_POST['edit_event'];
    $name = $_POST['txtName'];
    $desc = $_POST['txtDesc'];
    $status = $_POST['txtStatus'];
    
    if($objAdmin->updateEvent($id, $name, $desc, $status)) {
      $objAdmin->redirect('../view/dashboard-admin-eventos.php');
    }
  }
  
  if (isset($_POST['delete_event'])) {
    $id = $_POST['delete_event'];

    if($objAdmin->deleteEvent($id)) {
      $objAdmin->redirect('../view/dashboard-admin-eventos.php');
    }
  }
  

?>