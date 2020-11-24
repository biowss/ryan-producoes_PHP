<div class="container pt-5 flex flow-column" id="users" style="height: 100vh;">
  <h2>Usuários</h2>
  <button type="button" class="mb-4 ml-auto" data-toggle="modal" data-target="#modalCadastrarUsuarios">
    Cadastrar Usuario
  </button>
  <table class="table table-stripped">
      <thead>
      <tr>
        <th style="width: 30%;">Usuario</th>
        <th style="width: 30%;">Senha</th>
        <th style="width: 20%;">Admin?</th>
        <th style="width: 10%;">Editar</th>
        <th style="width: 10%;">Excluir</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $query = "SELECT * from usuarios ORDER BY usuario_admin, usuario_nome";
        $stmt = $objAdmin->runQuery($query);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
          while($rowUsuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
      ?>
          <tr>
            <td><?php  echo($rowUsuario['usuario_nome']); ?></td>
            <td><?php  echo($rowUsuario['usuario_senha']); ?></td>
            <td><?php  echo($rowUsuario['usuario_admin'] ? "Sim" : "Não"); ?></td>
            <td>
              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditarUsuarios" data-id="<?php print $rowUsuario['usuario_id'] ?>" data-username="<?php print $rowUsuario['usuario_nome'] ?>" data-password="<?php print $rowUsuario['usuario_senha'] ?>" data-admin="<?php print $rowUsuario['usuario_admin'] ?>">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                </svg>
              </button>
            </td>
            <td>
              <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#modalDeletarUsuarios" data-id="<?php print $rowUsuario['usuario_id'] ?>" data-username="<?php print $rowUsuario['usuario_nome'] ?>">
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




<!-- Modal Cadastrar Usuario -->
<div class="modal fade" id="modalCadastrarUsuarios" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cadastrar Usuario</h5>
      </div>
      <div class="modal-body">  

        <form action="../controll/ctr_admin.php" method="POST">
          <input type="hidden" name="add_user" value="1">
          <div class="form-group">
            <label for="user-id">Usuario:</label>
            <input type="email" class="form-control" id="user-id" name="txtUser" required>
          </div>
          <div class="form-group">
            <label for="user-idade">Senha:</label>
            <input type="password" class="form-control" id="user-password" name="txtPassword" required> 
          </div>
          <div class="form-group">
            <label for="user-admin">Nível de Acesso:</label>
            <select class="form-control" id="user-admin" name="txtAdmin" required>
              <option value="">Selecione...</option>
              <option value="1">Administrador</option>
              <option value="0">Cliente</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="bg-white" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="">Cadastrar</button>
          </div> 
        </form>   
      </div>        
    </div>
  </div>
</div>

<!-- Modal Editar Usuario -->
<div class="modal fade" id="modalEditarUsuarios" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Usuario</h5>
      </div>
      <div class="modal-body">  

        <form action="../controll/ctr_admin.php" method="POST">
          <input type="hidden" id="user-edit-id" name="edit_user" value="">
          <div class="form-group">
            <label for="user-edit-user">User:</label>
            <input type="email" class="form-control" id="user-edit-user" name="txtUser" required>
          </div>
          <div class="form-group">
            <label for="user-edit-password">Password:</label>
            <input type="password" class="form-control" id="user-edit-password" name="txtPassword" required> 
          </div>
          <div class="form-group">
            <label for="user-edit-admin">Nivel de Acesso:</label>
            <select class="form-control" id="user-edit-admin" name="txtAdmin" required>
              <option value="">Selecione...</option>
              <option value="1">Administrador</option>
              <option value="0">Cliente</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="bg-white" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="">Salver</button>
          </div> 
        </form>   
      </div>        
    </div>
  </div>
</div>


<!-- Modal Deletar Usuario -->
<div class="modal fade" id="modalDeletarUsuarios" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Deletar Usuario</h5>
      </div>
      <div class="modal-body">  

        <form action="../controll/ctr_admin.php" method="POST">
          <input type="hidden" id="user-delete-id" name="delete_user" value="">
          <div class="form-group">
            <label for="user-delete-user">Usuario:</label>
            <input type="email" class="form-control" id="user-delete-user" name="txtUser" disabled>
          </div>

          <div class="modal-footer">
            <button type="button" class="bg-white" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="">Deletar</button>
          </div> 
        </form>   
      </div>        
    </div>
  </div>
</div>


<script>

  /* Modal Editar Cliente */

$('#modalEditarUsuarios').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget);  
  var recipientId = button.data('id');
  var recipientUser = button.data('username');
  var recipientPassword = button.data('password');
  var recipientAdmin = button.data('admin');

  var modal = $(this);      
  modal.find('#user-edit-id').val(recipientId);
  modal.find('#user-edit-user').val(recipientUser);
  modal.find('#user-edit-password').val(recipientPassword);
  modal.find('#user-edit-admin').val(recipientAdmin);
});


/* Modal Deletar Cliente */

$('#modalDeletarUsuarios').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget);
  var recipientId = button.data('id');
  var recipientUser = button.data('username');

  var modal = $(this);      
  modal.find('#user-delete-id').val(recipientId);
  modal.find('#user-delete-user').val(recipientUser);
});

</script>