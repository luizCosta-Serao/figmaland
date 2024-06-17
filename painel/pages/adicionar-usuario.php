<?php
  // Para acessar essa página é necessário permissao de valor 2
  verificaPermissaoPagina(2);

?>
<div class="box-content">
  <h2>Adicionar Usuário</h2>

  <form action="" method="post" enctype="multipart/form-data">
    <?php
      if (isset($_POST['action'])) {
        
      }

    ?>

    <div class="form-group">
      <label for="login">Login:</label>
      <input type="text" name="login" id="login" required>
    </div>
    <div class="form-group">
      <label for="name">Nome:</label>
      <input type="text" name="name" id="name" required>
    </div>
    <div class="form-group">
      <label for="password">Senha:</label>
      <input type="password" name="password" id="password" required>
    </div>
    <div class="form-group">
      <label for="image">Foto Perfil:</label>
      <input type="file" name="image" id="image" required>
    </div>

    <div class="form-group">
      <input type="submit" name="action" value="Atualizar">
    </div>
  </form>
</div>