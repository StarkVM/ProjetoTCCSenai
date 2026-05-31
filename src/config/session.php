<?php

declare(strict_types=1);

/**
 * =========================================================
 * DETECÇÃO AUTOMÁTICA HTTP / HTTPS
 * =========================================================
 */

$isHttps =
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);

/**
 * =========================================================
 * CONFIGURAÇÕES DA SESSÃO
 * =========================================================
 */

session_name('HEAVYRENT_SESSION');

session_set_cookie_params([
    'lifetime' => 60 * 60 * 24 * 7, // 7 dias
    'path' => '/',
    'domain' => '',
    'secure' => $isHttps, // TRUE apenas em HTTPS
    'httponly' => true,
    'samesite' => 'Lax' // melhor compatibilidade local
]);

/**
 * =========================================================
 * CONFIGURAÇÕES INTERNAS DO PHP
 * =========================================================
 */

ini_set('session.use_only_cookies', '1');
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_secure', $isHttps ? '1' : '0');
ini_set('session.cookie_samesite', 'Lax');

/**
 * =========================================================
 * INICIA SESSÃO
 * =========================================================
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * =========================================================
 * PROTEÇÃO CONTRA SESSION FIXATION
 * =========================================================
 */

if (!isset($_SESSION['created'])) {

    session_regenerate_id(true);

    $_SESSION['created'] = time();
}

/**
 * =========================================================
 * REGENERAÇÃO AUTOMÁTICA DO ID
 * =========================================================
 */

if ((time() - $_SESSION['created']) > 1800) {

    session_regenerate_id(true);

    $_SESSION['created'] = time();
}

/**
 * =========================================================
 * TIMEOUT DE INATIVIDADE
 * =========================================================
 */

$timeout = 60 * 60 * 24 * 7;

if (isset($_SESSION['last_activity'])) {

    if ((time() - $_SESSION['last_activity']) > $timeout) {

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
    }
}

$_SESSION['last_activity'] = time();




