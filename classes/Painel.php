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
      // função nativa php para upload de arquivos com primeiro parâmetro sendo o nome do arquivo e o segundo parâmetro onde vai ser salvo o arquivo
      if(move_uploaded_file($file['tmp_name'], BASE_DIR_PAINEL.'/uploads/'.$file['name'])) {
        // Se upload der certo, retorne o nome do arquivo
        return $file['name'];
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
  }

?>