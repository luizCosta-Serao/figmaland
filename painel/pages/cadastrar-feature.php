<?php
  // Para acessar essa página é necessário permissao de valor 2
  verificaPermissaoPagina(0);

?>
<div class="box-content">
  <h2>Adicionar Features</h2>

  <form action="" method="post" enctype="multipart/form-data">
    <?php
      if (isset($_POST['action'])) {
         // Enviei formulário
         // Função dinâmica de cadastro
         if (Painel::insert($_POST)) {
          // Se der certo
           Painel::alert('sucesso', 'Cadastro da feature realizado com sucesso');
         } else {
          // Se ocorrer algum erro
          Painel::alert('erro', 'Campos vazios não são permitidos');
         }
      }

    ?>

    <div class="form-group">
      <label for="title">Título:</label>
      <input type="text" name="title" id="title">
    </div>

    <div class="form-group">
      <label for="description">Descrição:</label>
      <textarea name="description" id="description"></textarea>
    </div>

    <div class="form-group">
      <input type="hidden" name="nome_tabela" value="site_features">
      <input type="submit" name="action" value="Atualizar">
    </div>
  </form>
</div>