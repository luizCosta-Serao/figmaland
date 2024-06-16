<?php
  // guardando numa variável os usuários online
  $usuariosOnline = Painel::listarUsuariosOnline();
  
?>
<h1>Painel de Controle</h1>
      <ul class="metrics">  
        <li class="metrics-single users-online">
          <h1>Usuários Online</h1>
          <p><?php echo count($usuariosOnline); ?></p>
        </li>
        <li class="metrics-single visits-total">
          <h1>Total de Visitas</h1>
          <p>100</p>
        </li>
        <li class="metrics-single visits-today">
          <h1>Visitas Hoje</h1>
          <p>3</p>
        </li>
      </ul>

<div class="usuarios-online">
  <h2>Usuários online</h2>
  <table class="usuarios-online-table">
    <thead>
      <th>IP</th>
      <th>Última Ação</th>
    </thead>
    <tbody>
      <?php
        // Listando Usuário online
        foreach ($usuariosOnline as $key => $value) {
      ?>
        <tr>
          <td><?php echo $value['ip']; ?></td>
          <td>
            <?php
              // Formatando a data
              echo date('d/m/Y H:i:s',strtotime($value['ultima_acao'])); 
            ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>