<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/endpoints.php';

$endpoints = new Endpoints();

try {
    // Se houver um token, tenta fazer logout via API para todas as sessões
    if (isset($_SESSION['accessToken']) && !empty($_SESSION['accessToken'])) {
        // Verifica se há um endpoint de logout de todas as sessões
        // Se não houver, o servidor retornará um erro e vamos apenas destruir a sessão local
        $url = $endpoints->UrlPadrao . "/api/v1/user-access/auth/logout-all-sessions";
        
        $ch = curl_init($url);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $_SESSION['accessToken']
        ]);
        
        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }
} catch (Exception $e) {
    // Se houver erro na API, continua com o logout local
}

// Limpa a sessão
$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 60 * 60 * 24 * 7,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();

// Redireciona para a página de login
header("Location: ../login/code.php");
exit;
?>
