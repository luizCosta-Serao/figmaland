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
        $user = $_POST['user'];
        $password = $_POST['password'];
        $sql = MySql::conectar()->prepare("SELECT * FROM `usuarios_admin` WHERE user = ? AND password = ?");
        $sql->execute(array($user, $password));
        if ($sql->rowCount() == 1) {
          $_SESSION['login'] = true;
          $_SESSION['user'] = $user;
          $_SESSION['password'] = $password;
          header('Location: '.INCLUDE_PATH_PAINEL);
          die();
        } else {
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