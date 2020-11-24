<?php 
  session_start();
  
  require_once '../model/admin.php';
  $objAdmin = new Admin();


  $id = $_SESSION["id"];
  $user = $_SESSION["user"];
  $activity = $_SESSION["last_activity"];

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="styles/dashboard.css">
  </head>
  <body>

		<!-- Side Bar -->
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
				<h1><a href="#" class="logo">R.</a></h1>
        <ul class="list-unstyled components mb-5">
          <li>
            <a href="./dashboard-admin"><span class="fa fa-home"></span> Início </a>
          </li>
          <li>
            <a href="./dashboard-admin-eventos.php"><span class="fa fa-plane"></span> Eventos </a>
          </li>
          <li>
            <a href="./dashboard-admin-usuarios.php"><span class="fa fa-users"></span> Usuários </a>
          </li>
          <li class="active">
            <a href="#"><span class="fa fa-cogs"></span> Serviços </a>
          </li>
          <li>
            <a href="./index.php"><span class="fa fa-sign-out"></span> Logout </a>
          </li>
        </ul>
    	</nav>

      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 8vh;">
          <div class="container-fluid justify-left">

            <button type="button" id="sidebarCollapse" class="">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <span class="w-100" style="text-align: center;"> Bem Vindo, <?php echo($user); ?> </span>
          </div>
        </nav>
        
        <?php include_once "./Modals/servicos.php" ?>

      </div>
		</div>

    <script src="Scripts/dashboard.js"></script>
  </body>
</html>