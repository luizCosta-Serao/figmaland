<?php
  include('../config.php');

  // Verifica se está logado
  if (Painel::logado() === false) {
    // Se não estiver logado, vai carregar página de login
    include('login.php');
  } else {
    // Se estiver logado, vai carregar o painel de controle
    include('main.php');
  }

?>