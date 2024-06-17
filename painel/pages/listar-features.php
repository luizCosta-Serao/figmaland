<?php
  // Para acessar essa página é necessário permissao de valor 2
  verificaPermissaoPagina(0);

  // Puxando dados da tabela site_features
  $features = Painel::selectAll('site_features');
?>
<div class="box-content">
  <h2>Features Cadastrados</h2>

  <table>
    <tr>
      <td>Título</td>
      <td>Descrição</td>
      <td>##</td>
      <td>##</td>
    </tr>
    <?php
      // Iterando a variável features para listar os dados
      foreach ($features as $key => $value) {
    ?>
      <tr>
        <td><?php echo $value['title']; ?></td>
        <td><?php echo $value['description'] ?></td>
        <td><a class="btn-edit" href="">Editar</a></td>
        <td><a class="btn-delete" href="">Excluir</a></td>
      </tr>
    <?php } ?>
  </table>
</div>