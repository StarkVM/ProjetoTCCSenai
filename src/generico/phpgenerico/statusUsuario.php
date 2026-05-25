<?php
require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

header('Content-Type: application/json');
if (!isset($_SESSION['logado']) || $_SESSION['logado'] == false) {
    echo json_encode(["status" => "guest"]);
} else if (isset($_SESSION['user']['role']) &&  $_SESSION['user']['role'] == 'admin') {
    echo json_encode(["status" => "super"]);
} else {
    echo json_encode(["status" => "logged"]);
}