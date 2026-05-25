<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['url']) && !empty($data['url'])) {

    // salva na sessão
    $_SESSION['ultima_url'] = $data['url'];
    $_SESSION['tempo_saida'] = time();

    // salva no cookie
    setcookie("ultima_url", $data['url'], [
        'expires' => time() + 20, // 15 minutos
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
}








