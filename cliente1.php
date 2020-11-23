<?php 
  require_once '../model/cliente.php';
  $objCliente = new Cliente();
  session_start();
  $id = $_SESSION["id"];
  $user = $_SESSION["user"];
  $activity = $_SESSION["last_activity"];
  
  echo $id;
  echo $user;
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <title>Cliente</title>
</head>
<body>
  <div class="container">
    <h2>Cliente</h2>

    <button type="button" class="btn btn-outline-secondary mt-2 mb-2" data-toggle="modal" data-target="#myModalCadastrar">
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
      </svg>      
      Add Cliente
    </button>

    <table class="table table-stripped">
        <thead>
        <tr>
          <th>Nome</th>
          <th>Idade</th>
          <th>Sexo</th>
          <th>Editar</th>
          <th>Excluir</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $query = "SELECT * from cliente";
          $stmt = $objCliente->runQuery($query);
          $stmt->execute();

          if($stmt->rowCount() > 0) {
            while($rowCliente = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr>
              <td><?php  echo($rowCliente['nome']); ?></td>
              <td><?php  echo($rowCliente['idade']); ?></td>
              <td><?php  echo($rowCliente['sexo']); ?></td>
              <td>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalEditar" data-clienteid="<?php print $rowCliente['id'] ?>" data-clientenome="<?php print $rowCliente['nome'] ?>" data-clienteidade="<?php print $rowCliente['idade'] ?>" data-clientesexo="<?php print $rowCliente['sexo'] ?>">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                  </svg>
                </button>
              </td>
              <td>
                <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#myModalDeletar" data-clienteid="<?php print $rowCliente['id'] ?>" data-clientenome="<?php print $rowCliente['nome'] ?>">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                  </svg>
                </button>
              </td>
            </tr>
        <?php
            }
          }        
        ?>
        
      </tbody>
    </table>
  </div>

  <!-- Modal Cadastrar Cliente -->
  <div class="modal fade" id="myModalCadastrar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cadastrar Cliente</h5>
        </div>
        <div class="modal-body">  

          <form action="../controll/ctr_cliente.php" method="POST">
            <input type="hidden" name="insert" value="1">
            <div class="form-group">
              <label for="nome">Nome:</label>
              <input type="text" class="form-control" id="nome" name="txtNome" required>
            </div>
            <div class="form-group">
              <label for="idade">Idade:</label>
              <input type="number" class="form-control" id="idade" name="txtIdade" required> 
            </div>
            <div class="form-group">
              <label for="idade">Sexo:</label>
              <select class="form-control" name="txtSexo" required>
                <option value="">Selecione...</option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-secondary">Cadastrar</button>
            </div> 
          </form>   
        </div>        
      </div>
    </div>
  </div>

  <!-- Modal Editar Cliente -->
  <div class="modal fade" id="myModalEditar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Cliente</h5>
        </div>
        <div class="modal-body">  

          <form action="../controll/ctr_cliente.php" method="POST">
            <input type="hidden" id="recipient-id" name="editar_id" value="">
            <div class="form-group">
              <label for="nome">Nome:</label>
              <input type="text" class="form-control" id="recipient-nome" name="txtNome" required>
            </div>
            <div class="form-group">
              <label for="idade">Idade:</label>
              <input type="number" class="form-control" id="recipient-idade" name="txtIdade" required> 
            </div>
            <div class="form-group">
              <label for="idade">Sexo:</label>
              <select class="form-control" id="recipient-sexo" name="txtSexo" required>
                <option value="">Selecione...</option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-secondary">Cadastrar</button>
            </div> 
          </form>   
        </div>        
      </div>
    </div>
  </div>


  <!-- Modal Deletar Cliente -->
  <div class="modal fade" id="myModalDeletar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Deletar Cliente</h5>
        </div>
        <div class="modal-body">  

          <form action="../controll/ctr_cliente.php" method="GET">
            <input type="hidden" id="recipient-id" name="delete_id" value="">
            <div class="form-group">
              <label for="nome">Nome:</label>
              <input type="text" class="form-control" id="recipient-nome" name="txtNome" disabled>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-danger">Deletar</button>
            </div> 
          </form>   
        </div>        
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>