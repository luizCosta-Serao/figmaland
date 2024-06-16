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
  }


?>