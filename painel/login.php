<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>/css/style.css">
  <title>Painel de Controle</title>
</head>
<body>
  <section class="login-painel">
    <?php
      // Login
      if(isset($_POST['action'])) {
        // puxar user e password do form inseridos
        $user = $_POST['user'];
        $password = $_POST['password'];
        // Conectar ao banco de dados e verificar se existe o usuário inserido no form
        $sql = MySql::conectar()->prepare("SELECT * FROM `usuarios_admin` WHERE user = ? AND password = ?");
        $sql->execute(array($user, $password));
        // Verificar se usuário existir
        if ($sql->rowCount() == 1) {
          // Usuário existe
          // obter as informações do usuario
          $info = $sql->fetch();

          // Salvar na session os dados do usuario obtidos do banco de dados
          $_SESSION['login'] = true;
          $_SESSION['user'] = $user;
          $_SESSION['password'] = $password;
          $_SESSION['cargo'] = $info['cargo'];
          $_SESSION['nome'] = $info['nome'];
          $_SESSION['img'] = $info['img'];
          // Redirecionar para o painel
          header('Location: '.INCLUDE_PATH_PAINEL);
          die();
        } else {
          // Usuário não existe
          echo '<div class="erro-box">Usuário ou Senha incorretos</div>';
        }
      }
    ?>
    <h1>Efetue o login</h1>
    <form method="post">
      <input type="text" name="user" placeholder="Login" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" name="action" value="Login">
    </form>
  </section>
  
</body>
</html>