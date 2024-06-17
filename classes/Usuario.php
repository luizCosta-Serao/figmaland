<?php
  class Usuario {
    // função para atualizar usuário do painel de controle
    public function atualizarUsuario($nome, $senha, $imagem) {
      // Atualizar no banco de dados com os novos valores
      $sql = MySql::conectar()->prepare("UPDATE `usuarios_admin` SET nome = ?, password = ?, img = ? WHERE user = ?");
      if($sql->execute(array($nome, $senha, $imagem, $_SESSION['user']))) {
        // Se der certo
        return true;
      } else {
        // Se ocorrer algum problema
        return false;
      }
    }

    // Função para verificar se login já existe no banco de dados
    public static function userExists($login) {
      $sql = MySql::conectar()->prepare("SELECT `id` FROM `usuarios_admin` WHERE user = ?");
      $sql->execute(array($login));
      if($sql->rowCount() === 1) {
        return true;
      } else {
        return false;
      }
    }

    // Função para cadastrar usuário do painel de controle no banco de dados
    public static function cadastrarUsuario($user, $senha, $imagem, $cargo, $nome) {
      $sql = MySql::conectar()->prepare("INSERT INTO `usuarios_admin` VALUES (null,?,?,?,?,?)");
      $sql->execute(array($user,$senha,$imagem,$cargo,$nome));
    }
  }


?>