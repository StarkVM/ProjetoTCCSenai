<?php

include __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

function getConnection() {
    try {
        $conn = new mysqli(
            $_ENV['DB_HOST'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            $_ENV['DB_NAME']
        );

        if ($conn->connect_error) {
            throw new Exception("Erro na conexão: " . $conn->connect_error);
        }

        $conn->set_charset("utf8mb4");

        return $conn;

    } catch (Exception $e) {
        error_log($e->getMessage());
        die("Erro ao conectar ao banco.");
    }
}
