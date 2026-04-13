<?php

require 'conexao.php';

// EVENTS NAMES - TIPOS

$loginEvento = "login";
$cadastroEvento = "cadastro";
$anuncioPostadoEvento = "anuncio_postado";

function atualizarContador($tipo, $usuario_id, $ip, $user_agent, $origem, $referencia_id, $dados)
{
    global $conn;
    $jsonDados = json_encode($dados);

    $stmt = $conn->prepare("
        INSERT INTO eventos 
        (tipo, usuario_id, ip, user_agent, origem, referencia_id, dados)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sisssis",
        $tipo,
        $usuario_id,
        $ip,
        $user_agent,
        $origem,
        $referencia_id,
        $jsonDados
    );

    $stmt->execute();

}


?>
