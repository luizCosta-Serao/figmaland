<?php
  class Painel {
     // Variável de cargos do painel de controle
    public static $cargos = [
      '0' => 'Normal',
      '1' => 'Sub Administrador',
      '2' => 'Administrador'
    ];

    // Verifica se está logado
    public static function logado() {
      return isset($_SESSION['login']) ? true : false;
    }

    // Deslogar do Painel de Controle
    public static function loggout() {
      // Se fizer loggout, destruir o cookie lembrar
      setcookie('lembrar', 'true', time() - 1, '/');
      // destruir sessions
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

    // Mensagem indicativa de sucesso ou erro
    public static function alert($tipo, $mensagem) {
      if ($tipo === 'sucesso') {
        echo '<div class="sucesso">'.$mensagem.'</div>';
      } else if ($tipo === 'erro') {
        echo '<div class="erro">'.$mensagem.'</div>';
      }
    }

    // Validador do formato da imagem
    public static function imagemValida($imagem) {
      if (
        $imagem['type'] === 'image/jpeg' ||
        $imagem['type'] === 'image/jpg' ||
        $imagem['type'] === 'image/png'
      ) {
        // Se imagem for jpeg, jpg ou png

        // converter para kbytes e se vier número quebrado arredondar para número inteiro
        $tamanho = intval($imagem['size'] / 1024);
        if ($tamanho < 300) {
          // Se tamanho da imagem for 300kbytes ou menos, retornar verdadeiro
          return true;
        } else {
          // Se tamanho da imagem for maior que 300 kbytes, retornar falso
          return false;
        }
      } else {
        // Se imagem não for jpeg, jpg ou png, retornar falso
        return false;
      }
    }

    // realizar upload da nova imagem e salvar na pasta uploads
    public static function uploadFile($file) {
      // criando nome único para cada imagem
      $formatoArquivo = explode('.', $file['name']);
      $imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
      // função nativa php para upload de arquivos com primeiro parâmetro sendo o nome do arquivo e o segundo parâmetro onde vai ser salvo o arquivo
      if(move_uploaded_file($file['tmp_name'], BASE_DIR_PAINEL.'/uploads/'.$imagemNome)) {
        // Se upload der certo, retorne o nome do arquivo
        return $imagemNome;
      } else {
        // Se ocorrer problema no upload da imagem, retornar falso
        return false;
      }
    }

    // função para deletar arquivo
    public static function deleteFile($file) {
      // deletar antiga imagem na pasta uploads
      @unlink('uploads/'.$file);
    }

    // Função dinâmica para cadastro
    public static function insert($arr) {
      $certo = true;
      // obtendo o nome da tabela através do $_POST de um input:hidden
      $nome_tabela = $arr['nome_tabela'];
      // query para inserção dos dados no banco de dados
      $query = "INSERT INTO `$nome_tabela` VALUES (null";
        foreach ($arr as $key => $value) {
          $nome = $key;
          $valor = $value;
          if ($nome === 'action' || $nome === 'nome_tabela') {
            continue;
          }
          if ($value === '') {
            $certo = false;
            break;
          }
          $query.=",?";
          $parametros[] = $value;
        }
      $query.=")";
      //Fim da query para inserção dos dados no banco de dados
      if ($certo === true) {
        $sql = MySql::conectar()->prepare($query);
        $sql->execute($parametros);
      }
      return $certo;
    }

      // Função dinâmica para atualizar dados
      public static function update($arr) {
        $certo = true;
        $first = false;
        // obtendo o nome da tabela através do $_POST de um input:hidden
        $nome_tabela = $arr['nome_tabela'];
        // query para atualizar dados no banco de dados
        $query = "UPDATE `$nome_tabela` SET ";
          foreach ($arr as $key => $value) {
            $nome = $key;
            $valor = $value;
            if ($nome === 'action' || $nome === 'nome_tabela' || $nome === 'id') {
              continue;
            }
            if ($value === '') {
              $certo = false;
              break;
            }
            if ($first === false) {
              $first = true;
              $query.="$nome = ?";
            } else {
              $query.=", $nome = ?";
            }
            $parametros[] = $value;
          }
        //Fim da query para atualização dos dados no banco de dados
        if ($certo === true) {
          $parametros[] = $arr['id'];
          $sql = MySql::conectar()->prepare($query.' WHERE id = ?');
          $sql->execute($parametros);
        }
        return $certo;
      }

    // Puxar todos os dados de uma tabela do banco de dados
    public static function selectAll($tabela, $start = null, $end = null) {
      if ($start === null && $end === null) {
        $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela`");
      } else {
        $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` LIMIT $start, $end");
      }
      $sql->execute();
      // retorna os dados
      return $sql->fetchAll();
    }

    // Método para deletar dados de uma tabela do banco de dados
    public static function deletar($tabela, $id = false) {
      if ($id === false) {
        // Se id não for passado, deletar tudo
        $sql = MySql::conectar()->prepare("DELETE FROM `$tabela`");
      } else {
        // Se id for passado, deletar apenas o dado indicado
        $sql = MySql::conectar()->prepare("DELETE FROM `$tabela` WHERE id = $id");
        $sql->execute();
      }
    }

    // Função para redirecionar
    public static function redirect($url) {
      echo '<script>
        location.href = '.$url.'
      </script>';
      die();
    }

    // função para puxar um único dado de uma tabela do banco de dados
    public static function select($table, $query, $arr) {
      $sql = MySql::conectar()->prepare("SELECT * FROM `$table` WHERE $query");
      $sql->execute($arr);
      return $sql->fetch();
    }
  }

?>