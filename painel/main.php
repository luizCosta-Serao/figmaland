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
    <div>
      <a href="<?php echo INCLUDE_PATH_PAINEL; ?>/?loggout">Sair</a>
    </div>
    </header>
    
  <aside class="header-left">

  </aside>
  <section class="container">

  </section>
</body>
</html>