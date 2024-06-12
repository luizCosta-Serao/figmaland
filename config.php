<?php
  // Session armazena valores, e esses valores continuam armazenados até o usuário fechar o navegador
  // Sempre que for trabalhar com session, deve-se chamar o session_start()
  session_start();

  // Carregar classes dinamicamente, sem a necessidade de instanciar com new Class
  $autoload = function($class) {
    include('classes/'.$class.'.php');
  };
  spl_autoload_register($autoload);

  // constante do caminho absoluto da página
  define('INCLUDE_PATH', 'http://localhost/figmaland');

  //constante do caminho absoluto do painel de controle
  define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'/painel');

?>