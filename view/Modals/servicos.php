<div class="container pt-5 flex flow-column" id="services" style="height: 100vh;">
  <h2>Serviços</h2>
  <button type="button" class="mb-4 ml-auto" data-toggle="modal" data-target="#modalCadastrarServicos">
    Cadastrar Serviço
  </button>
  <table class="table table-stripped">
      <thead>
      <tr>
        <th style="width: 30%;">Nome</th>
        <th style="width: 50%;">Descrição</th>
        <th style="width: 10%;">Editar</th>
        <th style="width: 10%;">Excluir</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $query = "SELECT * from servicos ORDER BY servico_titulo";
        $stmt = $objAdmin->runQuery($query);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
          while($rowServico = $stmt->fetch(PDO::FETCH_ASSOC)) {
      ?>
          <tr>
            <td><?php  echo($rowServico['servico_titulo']); ?></td>
            <td><?php  echo($rowServico['servico_descricao']); ?></td>
            <td>
              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditarServicos" data-id="<?php print $rowServico['servico_id'] ?>" data-name="<?php print $rowServico['servico_titulo'] ?>" data-description="<?php print $rowServico['servico_descricao'] ?>">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                </svg>
              </button>
            </td>
            <td>
              <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#modalDeletarServicos" data-id="<?php print $rowServico['servico_id'] ?>" data-name="<?php print $rowServico['servico_titulo'] ?>">
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




<!-- Modal Cadastrar Serviço -->
<div class="modal fade" id="modalCadastrarServicos" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cadastrar Serviço</h5>
      </div>
      <div class="modal-body">  

        <form action="../controll/ctr_admin.php" method="POST">
          <input type="hidden" name="add_service" value="1">
          <div class="form-group">
            <label for="service-name">Serviço:</label>
            <input type="text" class="form-control" id="service-name" name="txtName" required>
          </div>
          <div class="form-group">
            <label for="service-description">Descrição:</label>
            <textarea class="form-control" id="service-description" name="txtDesc" required></textarea> 
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

<!-- Modal Editar Serviço -->
<div class="modal fade" id="modalEditarServicos" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Serviço</h5>
      </div>
      <div class="modal-body">  

        <form action="../controll/ctr_admin.php" method="POST">
          <input type="hidden" id="service-edit-id" name="edit_service" value="">
          <div class="form-group">
            <label for="service-edit-name">Name:</label>
            <input type="text" class="form-control" id="service-edit-name" name="txtName" required>
          </div>
          <div class="form-group">
            <label for="service-edit-description">Descrição:</label>
            <textarea class="form-control" id="service-edit-description" name="txtDesc" required></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="bg-white" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="">Salvar</button>
          </div> 
        </form>   
      </div>        
    </div>
  </div>
</div>


<!-- Modal Deletar Usuario -->
<div class="modal fade" id="modalDeletarServicos" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Deletar Serviço</h5>
      </div>
      <div class="modal-body">  

        <form action="../controll/ctr_admin.php" method="POST">
          <input type="hidden" id="service-delete-id" name="delete_service" value="">
          <div class="form-group">
            <label for="service-delete-name">Serviço:</label>
            <input type="email" class="form-control" id="service-delete-name" name="txtName" disabled>
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

  /* Modal Editar Serviço */

$('#modalEditarServicos').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget);  
  var recipientId = button.data('id');
  var recipientName = button.data('name');
  var recipientDesc = button.data('description');

  var modal = $(this);      
  modal.find('#service-edit-id').val(recipientId);
  modal.find('#service-edit-name').val(recipientName);
  modal.find('#service-edit-description').val(recipientDesc);
});


/* Modal Deletar Serviço */

$('#modalDeletarServicos').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget);
  var recipientId = button.data('id');
  var recipientName = button.data('name');

  var modal = $(this);      
  modal.find('#service-delete-id').val(recipientId);
  modal.find('#service-delete-name').val(recipientName);
});

</script>