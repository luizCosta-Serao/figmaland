<?php
  // Para acessar essa página é necessário permissao de valor 2
  verificaPermissaoPagina(0);

  // Se parâmetro id na URL estiver definido
  if (isset($_GET['id'])) {
    // obtendo ID da feature através da URL
    $id = (int)$_GET['id'];
    // Puxar dados de uma feature única
    $feature = Painel::select('site_features', 'id = ?', array($id));
  } else {
    // Se o parâmetro id estiver vazio
    Painel::alert('erro', 'Você precisa passar o parâmetro ID');
    die();
  }


?>
<div class="box-content">
  <h2>Editar Feature</h2>

  <form action="" method="post" enctype="multipart/form-data">
    <?php
      if (isset($_POST['action'])) {
        // Enviei formulário
        if(Painel::update($_POST)) {
          // Mensagem de sucesso
          Painel::alert('sucesso', 'A feature foi editada com sucesso');
          // Puxando novamente os dados de uma feature única para atualizar automaticamente os valores do input
          $feature = Painel::select('site_features', 'id = ?', array($id));
        } else {
          // Erro: campos vazios, mostrar mensagem de erro
          Painel::alert('erro', 'Campos vazios não são permitidos');
        }
      }

    ?>

    <div class="form-group">
      <label for="title">Título:</label>
      <input type="text" name="title" id="title" value="<?php echo $feature['title'] ?>">
    </div>

    <div class="form-group">
      <label for="description">Descrição:</label>
      <textarea name="description" id="description"><?php echo $feature['description'] ?></textarea>
    </div>

    <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $id ?>">
      <input type="hidden" name="nome_tabela" value="site_features">
      <input type="submit" name="action" value="Atualizar">
    </div>
  </form>
</div>