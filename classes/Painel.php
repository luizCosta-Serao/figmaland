<?php
  class Painel {
    // Verifica se está logado
    public static function logado() {
      return isset($_SESSION['login']) ? true : false;
    }
  }

?>