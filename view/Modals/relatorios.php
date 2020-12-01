<?php 


if($_POST != null) {

  $begin = $_POST["txtBeginDate"];
  $end = $_POST["txtDueDate"];
  $status = $_POST["txtStatus"];

  if($begin && $end && $status) {
    $queryEventos = "SELECT * FROM eventos
                    INNER JOIN usuarios ON eventos.fk_usuario = usuarios.usuario_id
                    WHERE eventos.evento_situacao = '$status'
                    AND eventos.evento_inicio >= '$begin' 
                    AND eventos.evento_termino <= '$end'
                    ORDER BY eventos.evento_situacao, usuarios.usuario_id, eventos.evento_inicio, eventos.evento_titulo";

  }
  else if($begin && $end) {
    $queryEventos = "SELECT * FROM eventos
                    INNER JOIN usuarios ON eventos.fk_usuario = usuarios.usuario_id
                    WHERE eventos.evento_inicio >= '$begin' 
                    AND eventos.evento_termino <= '$end'
                    ORDER BY eventos.evento_situacao, usuarios.usuario_id, eventos.evento_inicio, eventos.evento_titulo";
  }
  else {
    $queryEventos = "SELECT * FROM eventos
                    INNER JOIN usuarios ON eventos.fk_usuario = usuarios.usuario_id
                    WHERE eventos.evento_situacao = '$status'
                    ORDER BY eventos.evento_situacao, usuarios.usuario_id, eventos.evento_inicio, eventos.evento_titulo";
  }

}
else {
  $queryEventos = "SELECT * FROM eventos
                  INNER JOIN usuarios ON eventos.fk_usuario = usuarios.usuario_id
                  ORDER BY eventos.evento_situacao, usuarios.usuario_id, eventos.evento_inicio, eventos.evento_titulo";
}

?>



<link rel="stylesheet" href="styles/dashboaed-relatorio.css">
<div class="container flex flow-column" id="events" style="height: 100vh;">
  <h2>Eventos</h2>

  <form method="POST">
    <div class="form-group flex w-75" style="justify-content: space-around;">
      <div class="w-50 m-2">
        <div class="form-group">
          <label for="event-begin-date">Inicio do evento:</label>
          <input type="datetime-local" data-format="dd/MM/yyyy hh:mm:ss" class="form-control" id="event-begin-date" name="txtBeginDate">
        </div>
        <div class="form-group">
          <label for="event-due-date">Término do evento:</label>
          <input type="datetime-local" data-format="dd/MM/yyyy hh:mm:ss" class="form-control" id="event-due-date" name="txtDueDate">
        </div>
      </div>
      <div class="w-50 m-2">
        <div class="form-group">
          <label for="event-status">Situação do Evento:</label>
          <select class="form-control" id="event-status" name="txtStatus">
            <option value="">Selecione...</option>
            <option value="Aberto">Aberto</option>
            <option value="Cancelado">Cancelado</option>
            <option value="Finalizado">Finalizado</option>
          </select>
        </div>
        <div class="form-group"> 
          <label for="search" style="opacity: 0;">Pesquisar</label>   
          <button id="search" type="submit" class="w-100">
            Pesquisar
          </button>
        </div>
      </div>
    </form>
  </div>
  
  <table class="table table-stripped mt-5">
      <thead>
      <tr class="table1">
        <th>Nome do Evento:</th> 
        <th>Descrição:</th>
        <th>Serviços:</th>
        <th>Cliente:</th>
        <th>Inicio:</th>
        <th>Fim:</th>        
        <th>Situação:</th>
      </tr>
    </thead>
    <tbody>
      <?php         
        $stmt = $objAdmin->runQuery($queryEventos);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
        while($rowEvento = $stmt->fetch(PDO::FETCH_ASSOC)) {          
          $eventoID = $rowEvento['evento_id'];
          $queryServicos = "SELECT servico_titulo, servico_descricao FROM eventos
                          INNER JOIN eventos_servicos ON eventos_servicos.evento_id = eventos.evento_id
                          INNER JOIN servicos ON eventos_servicos.servico_id = servicos.servico_id
                          WHERE eventos.evento_id = $eventoID
                          ORDER BY eventos.evento_inicio, eventos.evento_titulo";
          $stmt2 = $objAdmin->runQuery($queryServicos);
          $stmt2->execute();
      ?>
          <tr>
            <td><?php  echo($rowEvento["evento_titulo"]); ?></td>
            <td><?php  echo($rowEvento["evento_descricao"]); ?></td>
            <td><ul><?php  while($rowServico = $stmt2->fetch(PDO::FETCH_ASSOC)) {?> <li class="mb-4"> <?php echo($rowServico["servico_titulo"]); ?> </li> <?php } ?></ul></td>            
            <td><?php  echo($rowEvento["usuario_nome"]); ?></td>
            <td><?php  echo($rowEvento["evento_inicio"]); ?></td>
            <td><?php  echo($rowEvento["evento_termino"]); ?></td>
            <td><?php  echo($rowEvento["evento_situacao"]); ?></td>
          </tr>
      <?php
          }
        }        
      ?>
      
    </tbody>
  </table>
</div>
