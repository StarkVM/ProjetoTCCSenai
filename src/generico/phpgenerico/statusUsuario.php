<?php
session_start();

// força guest
unset($_SESSION['user']);

if (!isset($_SESSION['user'])) {
    echo json_encode(["status" => "guest"]);
} elseif ($_SESSION['user']['role'] === 'admin') {
    echo json_encode(["status" => "super"]);
} else {
    echo json_encode(["status" => "logged"]);
}