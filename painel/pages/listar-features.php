<?php
  // Para acessar essa página é necessário permissao de valor 2
  verificaPermissaoPagina(0);

  // Excluir item da lista de features
  if (isset($_GET['excluir'])) {
    // obtendo id da feature
    $idExcluir = intval($_GET['excluir']);
    // Método para deletar a feature
    Painel::deletar('site_features', $idExcluir);
  }

  // Paginação
  $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
  $porPagina = 2;
  // Puxando dados da tabela site_features com sistema de paginação
  $features = Painel::selectAll('site_features', ($paginaAtual - 1) * $porPagina, $porPagina);
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
        <td><a class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>/listar-features?excluir=<?php echo $value['id']; ?>">Excluir</a></td>
      </tr>
    <?php } ?>
  </table>

  <div class="paginacao">
    <?php
      // Paginação
      $totalPaginas = ceil(count(Painel::selectAll('site_features')) / $porPagina);
      for ($i=1; $i <= $totalPaginas; $i++) { 
        if ($i === $paginaAtual) {
          echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'/listar-features?pagina='.$i.'">'.$i.'</a>';
        } else {
          echo '<a href="'.INCLUDE_PATH_PAINEL.'/listar-features?pagina='.$i.'">'.$i.'</a>';
        }
      }
    ?>
  </div>
</div>