<?php

  class Site {
    // Atualizar Usuários online para exibir no 'Usuários Online' no Painel de Controle
    public static function updateUsuariosOnline() {
      // Se usuário já tiver visitado a página
      if (isset($_SESSION['online'])) {
        // Obter o token
        $token = $_SESSION['online'];
        // Obter a data e hora de acesso
        $horarioAtual = date('Y-m-d H:i:s');
        $check = MySql::conectar()->prepare("SELECT `id` FROM `users_online` WHERE token = ?");
        $check->execute(array($_SESSION['online']));

        if ($check->rowCount() === 1) {
          // Atualiza dados do acesso do usuário
          $sql = MySql::conectar()->prepare("UPDATE `users_online` SET ultima_acao = ? WHERE token = ?");
          $sql->execute(array($horarioAtual, $token));
        } else {
          // Obter IP do usuário
          $ip = $_SERVER['REMOTE_ADDR'];
          // Definir o token
          $token = $_SESSION['online'];
          // Definir o horário atual
          $horarioAtual = date('Y-m-d H:i:s');
          // Inserir o usuário no banco de dados
          $sql = MySql::conectar()->prepare("INSERT INTO `users_online` VALUES (null,?,?,?)");
          $sql->execute(array($ip, $horarioAtual, $token));
        }

      } else {
        // Se Usuário não tiver acessado a página ainda ou fechou o navegador
        
        // definir id único para o usuário
        $_SESSION['online'] = uniqid();
        // Obter IP do usuário
        $ip = $_SERVER['REMOTE_ADDR'];
        // Definir o token
        $token = $_SESSION['online'];
        // Definir o horário atual
        $horarioAtual = date('Y-m-d H:i:s');
        // Inserir o usuário no banco de dados
        $sql = MySql::conectar()->prepare("INSERT INTO `users_online` VALUES (null,?,?,?)");
        $sql->execute(array($ip, $horarioAtual, $token));
      }
    }
  }

?>