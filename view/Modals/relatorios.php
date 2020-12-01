<div class="container flex flow-column" id="events" style="height: 100vh;">
  <h2>Eventos</h2>
  <div class="form-group">
  <div class="form-group flex">    
    <button type="button" class="mb-4 ml-auto" data-toggle="modal" data-target="#modalCadastrarEventos">
      Cadastrar Evento
    </button>
  </div>
  <table class="table table-stripped">
      <thead>
      <tr>
        <th>Nome do Evento</th>
        <th>Descrição</th>
        <th>Serviços</th>
        <th>Inicio</th>
        <th>Fim</th>        
        <th>Situação</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $queryEventos = "SELECT * FROM eventos
                         INNER JOIN usuarios ON eventos.fk_usuario = usuarios.usuario_id
                         ORDER BY eventos.evento_situacao, usuarios.usuario_id, eventos.evento_inicio, eventos.evento_titulo";
        $stmt = $objAdmin->runQuery($queryEventos);
        $stmt->execute();

        $queryServicos = "SELECT servico_titulo, servico_descricao FROM eventos
                          INNER JOIN eventos_servicos ON eventos_servicos.evento_id = eventos.evento_id
                          INNER JOIN servicos ON eventos_servicos.servico_id = servicos.servico_id
                          ORDER BY eventos.evento_inicio, eventos.evento_titulo";
        $stmt2 = $objAdmin->runQuery($queryServicos);
        $stmt2->execute();

        if($stmt->rowCount() > 0) {
        while($rowEvento = $stmt->fetch(PDO::FETCH_ASSOC)) {
      ?>
          <tr>
            <td><?php  echo($rowEvento["evento_titulo"]); ?></td>
            <td><?php  echo($rowEvento["evento_descricao"]); ?></td>
            <td><?php  while($rowServico = $stmt2->fetch(PDO::FETCH_ASSOC)) {?> <p> <?php echo($rowServico["servico_titulo"]); ?> </p> <?php } ?> </td>            
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
