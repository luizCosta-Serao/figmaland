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

    // Carregar dinamicamente a página do Painel de Controle
    public static function carregarPagina() {
      $url = explode('/', @$_GET['url']);
      if (
        isset($_GET['url']) &&
        file_exists('pages/'.$url[0].'.php')
      ) {

        include('pages/'.$url[0].'.php');
      
      } else {
        //header('Location: '.INCLUDE_PATH_PAINEL);
        include('pages/home.php');
      
      }
    }

    // obter os usuários online na página
    public static function listarUsuariosOnline() {
      self::limparUsuariosOnline();
      $sql = MySql::conectar()->prepare("SELECT * FROM `users_online`");
      $sql->execute();
      return $sql->fetchAll();
    }

    // Limpar usuários que estão inativos na página
    public static function limparUsuariosOnline() {
      $date = date('Y-m-d H:i:s');
      $sql = MySql::conectar()->exec("DELETE FROM `users_online` WHERE ultima_acao < '$date' - INTERVAL 1 MINUTE");
    }
  }

?>