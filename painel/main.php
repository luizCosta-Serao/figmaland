<?php
  // Loggout do Painel de Controle
  if (isset($_GET['loggout'])) {
    Painel::loggout();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>/css/style.css">
  <title>Painel de Controle</title>
</head>
<body>
  <header class="header">
    <div class="menu-btn">
      <button><img src="<?php echo INCLUDE_PATH; ?>/assets/painel/menu.svg" alt="Menu"></button>
    </div>
    <div>
      <a href="<?php echo INCLUDE_PATH_PAINEL; ?>/?loggout">Sair</a>
    </div>
    </header>
    
  <aside>

    <div class="box-usuario">
      <?php
        // verificar img no banco de dados
        if ($_SESSION['img'] === '') {
          // Se img estiver vazio, inserir img padrão
      ?>
        <div class="img-usuario">
          <img src="<?php echo INCLUDE_PATH; ?>/assets/painel/person.svg" alt="Avatar">
        </div>
      <?php
        // Se img estiver preenchida adicionar a mesma 
        } else { 
      ?>
        <div class="img-usuario">
          <img src="<?php echo INCLUDE_PATH_PAINEL; ?>/uploads/<?php echo $_SESSION['img'] ?>" alt="">
        </div>
      <?php } ?>
    
      <div class="nome-usuario">
        <p><?php echo $_SESSION['nome'] ?></p>
        <p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
      </div>
    </div>
  </aside>

  <section class="container">
    
  </section>

  <script src="<?php echo INCLUDE_PATH; ?>/js/jquery-3.7.1.min.js"></script>
  <script type="module" src="<?php echo INCLUDE_PATH_PAINEL; ?>/js/index.js"></script>
</body>
</html>