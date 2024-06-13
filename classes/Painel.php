<?php
  class Painel {
    // Verifica se está logado
    public static function logado() {
      return isset($_SESSION['login']) ? true : false;
    }

    // Deslogar do Painel de Controle
    public static function loggout() {
      session_destroy();
      header('Location: '.INCLUDE_PATH_PAINEL);
    }
  }

?>