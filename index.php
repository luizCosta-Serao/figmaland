<?php include('config.php'); ?>
<?php
  // Função para atualizar ou adicionar usuário online na página
  Site::updateUsuariosOnline();
?>
<?php include('header.php'); ?>

<?php
  // Inserir páginas dinamicamente de acordo com o valor da URL
  $url = isset($_GET['url']) ? $_GET['url'] : 'home';
  if (file_exists('pages/'.$url.'.php')) {
    include('pages/'.$url.'.php');
  } else if (
    $_GET['url'] === 'product' ||
    $_GET['url'] === 'pricing' ||
    $_GET['url'] === 'about'
  ) {
    include('pages/home.php');
  } else {
    include('pages/not-found.php');
  }
?>

<?php include('footer.php'); ?>