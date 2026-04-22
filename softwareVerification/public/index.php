<?php

require '../config/database.php';

$conn = getConnection();

$result = $conn->query("SELECT 1");

if ($result) {
    echo "Conectado com sucesso!";
}
