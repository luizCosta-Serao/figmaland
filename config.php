<?php
  // Session armazena valores, e esses valores continuam armazenados até o usuário fechar o navegador
  // Sempre que for trabalhar com session, deve-se chamar o session_start()
  session_start();

  // Definir horário de São Paulo
  date_default_timezone_set('America/Sao_Paulo');

  // Carregar classes dinamicamente, sem a necessidade de instanciar com new Class
  $autoload = function($class) {
    include('classes/'.$class.'.php');
  };
  spl_autoload_register($autoload);

  // constante do caminho absoluto da página
  define('INCLUDE_PATH', 'http://localhost/figmaland');

  //constante do caminho absoluto do painel de controle
  define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'/painel');

  // constante do caminho do painel de controle para funçoes de imagem
  define('BASE_DIR_PAINEL', __DIR__.'/painel');

  // Conectar com banco de dados
  define('HOST', 'localhost');
  define('USER', 'root');
  define('PASSWORD', '');
  define('DATABASE', 'figmaland');

  // Funções

  // Função para obter o cargo de permissao no painel de controle
  function pegaCargo($cargo) {
    $arr = [
      '0' => 'Normal',
      '1' => 'Sub Administrador',
      '2' => 'Administrador'
    ];
    return $arr[$cargo];
  }

?>