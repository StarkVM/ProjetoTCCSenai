<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo json_encode(["status" => "guest"]);
} elseif ($_SESSION['user']['role'] === 'admin') {
    echo json_encode(["status" => "super"]);
} else {
    echo json_encode(["status" => "logged"]);
}
