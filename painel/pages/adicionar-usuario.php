<?php
  // Para acessar essa página é necessário permissao de valor 2
  verificaPermissaoPagina(2);

?>
<div class="box-content">
  <h2>Adicionar Usuário</h2>

  <form action="" method="post" enctype="multipart/form-data">
    <?php
      if (isset($_POST['action'])) {
         // Enviei formulário

        // Guardando na variável os valores de cada input
        $login = $_POST['login'];
        $nome = $_POST['name'];
        $senha = $_POST['password'];
        $imagem = $_FILES['image'];
        $cargo = $_POST['cargo'];

        // Instanciando a classe Usuario
        $usuario = new Usuario();

        // Verificação dos campos
        if ($login === '') {
          Painel::alert('erro', 'O login está vazio');
        } else if ($nome === '') {
          Painel::alert('erro', 'O nome está vazio');
        } else if ($senha === '') {
          Painel::alert('erro', 'A senha está vazia');
        } else if ($cargo === '') {
          Painel::alert('erro', 'O cargo precisa estar selecionado');
        } else if ($imagem['name'] === '') {
          Painel::alert('erro', 'É necessário selecionar uma imagem');
        } else {
          // Todos os inputs foram preenchidos
          if ($cargo > $_SESSION['cargo']) {
            // Erro: Cargo selecionado é maior que o cargo do usuário
            Painel::alert('erro', 'Você precisa selecionar um cargo menor que o seu!');
          } else if (Painel::imagemValida($imagem) === false) {
            // Erro: É necessario inserir uma imagem no formato jpeg, jpg ou png 
            Painel::alert('erro', 'O formato especificado não está correto');
          } else if(Usuario::userExists($login)) {
            // Erro: Login inserido já existe no banco de dados
            Painel::alert('erro', 'O login já existe, selecione outro login');
          } else {
            // Cadastrar no banco de dados

            // Salvando imagem do usuário na pasta uploads
            $imagem = Painel::uploadFile($imagem);

            // Cadastro do usuário no banco de dados
            $usuario->cadastrarUsuario($login,$senha,$imagem,$cargo,$nome);
            
            // Mensagem indicativa de sucesso
            Painel::alert('sucesso', 'O cadastro do usuário'.$login.' foi feito com sucesso');
          }
        }
      }

    ?>

    <div class="form-group">
      <label for="login">Login:</label>
      <input type="text" name="login" id="login">
    </div>
    <div class="form-group">
      <label for="name">Nome:</label>
      <input type="text" name="name" id="name">
    </div>
    <div class="form-group">
      <label for="password">Senha:</label>
      <input type="password" name="password" id="password">
    </div>
    <div class="form-group">
      <label for="cargo">Cargo:</label>
      <select name="cargo" id="cargo">
        <?php
          foreach (Painel::$cargos as $key => $value) {
            if($key < $_SESSION['cargo']) {
              echo '<option value="'.$key.'">'.$value.'</option>';
            }
          }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="image">Foto Perfil:</label>
      <input type="file" name="image" id="image">
    </div>

    <div class="form-group">
      <input type="submit" name="action" value="Atualizar">
    </div>
  </form>
</div>