<div class="container flex flow-column" id="events" style="height: 100vh;">
  <h2>Eventos</h2>  
  <div class="card-deck mb-5">
    <?php 
      $queryEventos = "SELECT * FROM eventos
                  INNER JOIN usuarios ON eventos.fk_usuario = usuarios.usuario_id
                  ORDER BY eventos.evento_situacao, usuarios.usuario_id, eventos.evento_inicio, eventos.evento_titulo";
      $stmt = $objAdmin->runQuery($queryEventos);
      $stmt->execute();

      if($stmt->rowCount() > 0) {
        while($rowEvento = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $eventoID = $rowEvento['evento_id'];
          $queryServicos = "SELECT servico_titulo, servico_descricao FROM eventos
                              INNER JOIN eventos_servicos ON eventos_servicos.evento_id = eventos.evento_id
                              INNER JOIN servicos ON eventos_servicos.servico_id = servicos.servico_id
                              WHERE eventos_servicos.evento_id = $eventoID
                              ORDER BY eventos.evento_inicio, eventos.evento_titulo";
          $stmt2 = $objAdmin->runQuery($queryServicos);
          $stmt2->execute();
          
    ?>
          <div class="card mb-5" style="min-width: 30%; max-width: 100%">
            <div class="card-body bg-black">
              <h4 class="card-title mb-4" style="color:#fff;"><?php echo($rowEvento["evento_titulo"]) ?></h4>
              <p class="card-text" style="color:#fff;"><?php echo($rowEvento["evento_descricao"]) ?></p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><b>Serviços:</b> <ul class="m-2"><?php while($rowServico = $stmt2->fetch(PDO::FETCH_ASSOC)) {?> <li><?php echo($rowServico["servico_titulo"]); ?></li> <?php } ?></ul></li>
              <li class="list-group-item"><b>Cliente:</b> <p class="m-2"><?php echo($rowEvento["usuario_nome"]) ?></p></li>
              <li class="list-group-item"><b>Data de início:</b> <p class="m-2"><?php echo($rowEvento["evento_inicio"]) ?></p></li>
              <li class="list-group-item"><b>Data de término:</b> <p class="m-2"><?php echo($rowEvento["evento_termino"] == "" ? '--------------' : $rowEvento["evento_termino"]) ?></p></li>
              <li class="list-group-item"><b>Situação:</b> <p class="m-2"><?php echo($rowEvento["evento_situacao"]) ?></p></li>            
            </ul>
            <button type="button" class="btn btn-danger rounded-0"  data-toggle="modal" data-target="#modalDeletarEventos" data-id="<?php print $rowEvento['evento_id'] ?>" data-name="<?php print $rowEvento['evento_titulo'] ?>">
              Excluir Evento
            </button>
            <button type="button" class="btn btn-warning rounded-0" data-toggle="modal" data-target="#modalEditarEventos" data-id="<?php print $rowEvento['evento_id'] ?>" data-name="<?php print $rowEvento['evento_titulo'] ?>" data-description="<?php print $rowEvento['evento_descricao'] ?>" data-services="<?php print $rowEvento['servico_id'] ?>" data-begin="<?php print $rowEvento['evento_inicio'] ?>" data-end="<?php print $rowEvento['evento_termino'] ?>" data-status="<?php print $rowEvento['evento_situacao'] ?>" data-client="<?php print $rowEvento['usuario_id'] ?>">
                Alterar Evento</a>
            </button>
          </div>
        <?php
            }
          }        
        ?>
  </div>
</div>




<!-- Modal Cadastrar Evento -->
<div class="modal fade" id="modalCadastrarEventos" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cadastrar Evento</h5>
      </div>
      <div class="modal-body">  
        <form action="../controll/ctr_admin.php" method="POST">
          <input type="hidden" name="add_event" value="1">
          <div class="form-group">
            <label for="event-name">Evento:</label>
            <input type="text" class="form-control" id="event-name" name="txtName" required>
          </div>
          <div class="form-group">
            <label for="event-description">Descrição:</label>
            <textarea class="form-control" id="event-description" name="txtDesc" required></textarea> 
          </div>
          <div class="form-group">
            <?php 
                $query = "SELECT * FROM servicos ORDER BY servico_titulo"; 
                $stmt = $objAdmin->runQuery($query);
                $stmt->execute();
                if($stmt->rowCount() > 0) {
                while($rowServico = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $servico_id = $rowServico['servico_id'];
                  $servico_titulo = $rowServico['servico_titulo'];            
            ?>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="cbServices[]" value="<?php echo($servico_id) ?>" id="<?php echo($servico_id) ?>">
              <label class="form-check-label" for="<?php echo($servico_id) ?>">
                <?php echo($servico_titulo) ?>
              </label>
            </div>
              <?php 
                  }
                }
              ?>
          </div>
          <div class="form-group">
            <label for="event-begin-date">Inicio do evento:</label>
            <input type="datetime-local" data-format="dd/MM/yyyy hh:mm:ss" class="form-control" id="event-begin-date" name="txtBeginDate" required>
          </div>
          <div class="form-group">
            <label for="event-due-date">Término do evento:</label>
            <input type="datetime-local" data-format="dd/MM/yyyy hh:mm:ss" class="form-control" id="event-due-date" name="txtDueDate">
          </div>
          <div class="form-group">
            <label for="event-status">Situação do Evento:</label>
            <select class="form-control" id="event-status" name="txtStatus" required>
              <option value="">Selecione...</option>
              <option value="Aberto">Aberto</option>
              <option value="Cancelado">Cancelado</option>
              <option value="Finalizado">Finalizado</option>
            </select>
          </div>
          <div class="form-group">
            <label for="event-client">Cliente:</label>
            <select class="form-control" id="event-client" name="txtClient" required>
              <option value="">Selecione...</option>
              <?php 
                $query = "SELECT * FROM usuarios ORDER BY usuario_nome"; 
                $stmt = $objAdmin->runQuery($query);
                $stmt->execute();
                if($stmt->rowCount() > 0) {
                while($rowUsuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $usuario_id = $rowUsuario['usuario_id'];
                  $usuario_nome = $rowUsuario['usuario_nome'];
              ?><option value="<?php echo($usuario_id) ?>"><?php echo($usuario_nome) ?></option>
              <?php 
                  }
                }
              ?>
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

<!-- Modal Editar Evento -->
<div class="modal fade" id="modalEditarEventos" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Evento</h5>
      </div>
      <div class="modal-body">  

        <form action="../controll/ctr_admin.php" method="POST">
          <input type="hidden" id="event-edit-id" name="edit_event" value="">
          <div class="form-group">
            <label for="event-name">Evento:</label>
            <input type="text" class="form-control" id="event-edit-name" name="txtName" required>
          </div>
          <div class="form-group">
            <label for="event-description">Descrição:</label>
            <textarea class="form-control" id="event-edit-description" name="txtDesc" required></textarea> 
          </div>
          <div class="form-group">
            <label for="event-status">Situação do Evento:</label>
            <select class="form-control" id="event-edit-status" name="txtStatus" required>
              <option value="">Selecione...</option>
              <option value="Aberto">Aberto</option>
              <option value="Cancelado">Cancelado</option>
              <option value="Finalizado">Finalizado</option>
            </select>
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


<!-- Modal Deletar Evento -->
<div class="modal fade" id="modalDeletarEventos" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Deletar Evento</h5>
      </div>
      <div class="modal-body">  
        <form action="../controll/ctr_admin.php" method="POST">
          <input type="hidden" id="event-delete-id" name="delete_event" value="">
          <div class="form-group">
            <label for="event-delete-name">Evento:</label>
            <input type="text" class="form-control" id="event-delete-name" name="txtName" disabled>
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

/* Modal Editar Evento */

$('#modalEditarEventos').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget);  
  var recipientId = button.data('id');
  var recipientName = button.data('name');
  var recipientDesc = button.data('description');
  var recipientStatus = button.data('status');

  var modal = $(this);      
  modal.find('#event-edit-id').val(recipientId);
  modal.find('#event-edit-name').val(recipientName);
  modal.find('#event-edit-description').val(recipientDesc);
  modal.find('#event-edit-status').val(recipientStatus);
});


/* Modal Deletar Evento */

$('#modalDeletarEventos').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget);
  var recipientId = button.data('id');
  var recipientName = button.data('name');

  var modal = $(this);      
  modal.find('#event-delete-id').val(recipientId);
  modal.find('#event-delete-name').val(recipientName);
});

</script>