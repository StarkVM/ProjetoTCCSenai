<?php
header('Content-Type: application/json');
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['image'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Requisição inválida']);
    exit;
}

$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : 'facial';
$upload_dir = __DIR__ . '/../../uploads/documentos/';

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

$file = $_FILES['image'];
$filename = 'foto_rosto_' . uniqid() . '.jpg';
$filepath = $upload_dir . $filename;

// Validar mime type
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime_type = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (!in_array($mime_type, ['image/jpeg', 'image/png', 'image/webp'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Tipo inválido']);
    exit;
}

if (move_uploaded_file($file['tmp_name'], $filepath)) {
    $_SESSION['foto_rosto'] = $filename;
    echo json_encode([
        'success' => true,
        'message' => 'Foto salva com sucesso',
        'filename' => $filename
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Erro ao salvar']);
}

