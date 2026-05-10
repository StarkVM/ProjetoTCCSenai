<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/code.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_image'])) {
    $user_id = $_SESSION['user_id'];
    $upload_dir = '../uploads/profile/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    $file_name = $user_id . '_' . time() . '.jpg'; // ou png, etc.
    $target_file = $upload_dir . $file_name;

    // Validar imagem
    $check = getimagesize($_FILES['profile_image']['tmp_name']);
    if ($check !== false) {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            // Salvar na sessão
            $_SESSION['profile_image'] = $file_name;
            header("Location: code.html");
            exit;
        }
    }
}
?>