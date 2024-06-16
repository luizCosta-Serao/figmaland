<div class="box-content">
  <h2>Editar Usuário</h2>

  <form action="" method="post" enctype="multipart/form-data">
    <?php
      if (isset($_POST['action'])) {
        // Enviei formulário

        // Guardando na variável os valores de cada input
        $nome = $_POST['name'];
        $senha = $_POST['password'];
        $imagem = $_FILES['image'];
        $imagem_atual = $_POST['imagem_atual'];

        // Instanciando a classe Usuario
        $usuario = new Usuario();

        if ($imagem['name'] !== '') {
          // Se selecionou uma img
          if(Painel::imagemValida($imagem)) {
            // Se a imagem for válida (jpeg, jpg, png)

            // Deletar antiga imagem da pasta uploads
            Painel::deleteFile($imagem_atual);

            // Salvar nova imagem na pasta uploads
            $imagem = Painel::uploadFile($imagem);

            // Atualiza usuário com os novos valores
            if($usuario->atualizarUsuario($nome, $senha, $imagem)) {
              // Se não houver nenhum problema na atualização do usuário
              
              // Inserir nova imagem na session[img]
              $_SESSION['img'] = $imagem;

              // Mensagem indicativa de sucesso
              Painel::alert('sucesso', 'Atualizado com sucesso junto com a imagem!');
            } else {
              // Se ocorrer algum problema na atualização dos dados com a nova imagem
              Painel::alert('erro', 'Ocorreu um erro ao atualizar junto com a imagem');
            }
          } else {
            // Se ocorrer algum problema na formato da nova imagem
            Painel::alert('erro', 'O formato da imagem não é válido');
          }
        } else {
          // Se não tiver inserido nenhuma nova imagem

          // Define a variável imagem como a imagem antiga
          $imagem = $imagem_atual;
          // Atualiza usuario sem alteração de imagem
          if($usuario->atualizarUsuario($nome, $senha, $imagem)) {
            // mensagem indicativa de que deu certo
            Painel::alert('sucesso', 'Atualizado com sucesso!');
          } else {
            // mensagem indicativa de que houve um problema na atualização do usuário
            Painel::alert('erro', 'Ocorreu um erro ao atualizar');
          }
        }
      }

    ?>

    <div class="form-group">
      <label for="name">Nome:</label>
      <input type="text" name="name" id="name" required value="<?php echo $_SESSION['nome'] ?>">
    </div>
    <div class="form-group">
      <label for="password">Senha:</label>
      <input type="password" name="password" id="password" value="<?php echo $_SESSION['password'] ?>">
    </div>
    <div class="form-group">
      <label for="image">Foto Perfil:</label>
      <input type="file" name="image" id="image">
      <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img'] ?>">
    </div>

    <div class="form-group">
      <input type="submit" name="action" value="Atualizar">
    </div>
  </form>
</div>