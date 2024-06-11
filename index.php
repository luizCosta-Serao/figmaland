<?php include('config.php'); ?>
<?php include('header.php'); ?>

<?php
  // Inserir páginas dinamicamente de acordo com o valor da URL
  $url = isset($_GET['url']) ? $_GET['url'] : 'home';
  if (file_exists('pages/'.$url.'.php')) {
    include('pages/'.$url.'.php');
  } else {
    include('pages/not-found.php');
  }
?>

<?php include('footer.php'); ?>