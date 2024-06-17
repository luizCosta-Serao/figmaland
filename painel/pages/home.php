<?php
  // guardando numa variável os usuários online
  $usuariosOnline = Painel::listarUsuariosOnline();
  
  // Obtendo total de visitas no site e guardando numa variável
  $pegarVisitasTotais = MySql::conectar()->prepare("SELECT * FROM `visits`");
  $pegarVisitasTotais->execute();
  $pegarVisitasTotais = $pegarVisitasTotais->rowCount();

  // Obtendo total de visitas hoje e guardando numa variável;
  $pegarVisitasHoje = MySql::conectar()->prepare("SELECT * FROM `visits` WHERE dia = ?");
  $hoje = date('Y-m-d');
  $pegarVisitasHoje->execute(array($hoje));
  $pegarVisitasHoje = $pegarVisitasHoje->rowCount();
?>
<h1>Painel de Controle</h1>
      <ul class="metrics">  
        <li class="metrics-single users-online">
          <h1>Usuários Online</h1>
          <p><?php echo count($usuariosOnline); ?></p>
        </li>
        <li class="metrics-single visits-total">
          <h1>Total de Visitas</h1>
          <p><?php echo $pegarVisitasTotais; ?></p>
        </li>
        <li class="metrics-single visits-today">
          <h1>Visitas Hoje</h1>
          <p><?php echo $pegarVisitasHoje; ?></p>
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

<div class="usuarios-online">
  <h2>Usuários do Painel</h2>
  <table class="usuarios-online-table">
    <thead>
      <th>Nome</th>
      <th>Cargo</th>
    </thead>
    <tbody>
      <?php
        // Obtendo usuários do painel de controle no banco de dados
        $usuariosPainel = MySql::conectar()->prepare("SELECT * FROM `usuarios_admin`");
        $usuariosPainel->execute();
        $usuariosPainel = $usuariosPainel->fetchAll();
        // Listando Usuário do painel de controle
        foreach ($usuariosPainel as $key => $value) {
      ?>
        <tr>
          <td><?php echo $value['user']; ?></td>
          <td>
            <?php
              // Cargo do usuário
              echo Painel::$cargos[$value['cargo']]; 
            ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>