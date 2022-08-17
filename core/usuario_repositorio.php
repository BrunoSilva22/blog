<?php
    session_start();
    require_once '../includes/funcoes.php';
    require_once 'conexao_mysql.php';
    require_once 'sql.php';
    require_once 'mysql.php';
    $salt = '$exemplosaltifsp';

    foreach ($_POST as $indice => $dado) {
        $$indice = limparDados($dado);
    }
    
    foreach ($_GET as $indice => $dado) {
        $$indice = limparDados($dado);
    }

    switch ($acao) {
        case 'insert':
            $dados = [
                'nome' => $nome,
                'email' => $email,
                'senha' => crypt($senha,$salt)
            ];

            insere(
                'usuario',
                $dados
            );

            break;
        case 'update':
            $id = (int)$id;
            $dados = [
                'nome' => $nome,
                'email' => $email
            ];

            $criterio = [
                ['id', '=', $id]
            ];

            atualiza(
                'usuario',
                $dados,
                $criterio
            );

            break;
        case 'login':
            $criterio = [
                ['email', '=', $email],
                ['AND', 'ativo', '=', 1]
            ];

            $retorno = buscar(
                'usuario',
                ['id', 'nome', 'email', 'senha', 'adm'],
                $criterio
            );
            break;
    }
?>