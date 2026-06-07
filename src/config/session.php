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






