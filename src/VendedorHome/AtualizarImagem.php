<?php
require_once("../endpoints.php");
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

header("Content-Type: application/json; charset=UTF-8");

$endpoints  = new Endpoints();
$listingId  = trim($_GET['cd'] ?? '');
$token      = $_SESSION['accessToken'] ?? '';

if (empty($listingId) || empty($token)) {
    echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
    exit;
}

$maxFileSize      = 5 * 1024 * 1024;
$allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

function normalizarArquivos(array $arquivos): array
{
    $norm = [];
    if (!isset($arquivos['name']) || !is_array($arquivos['name'])) return $norm;
    foreach ($arquivos['name'] as $i => $nome) {
        $norm[] = [
            'name'     => $nome,
            'type'     => $arquivos['type'][$i]     ?? '',
            'tmp_name' => $arquivos['tmp_name'][$i] ?? '',
            'error'    => $arquivos['error'][$i]    ?? UPLOAD_ERR_NO_FILE,
            'size'     => $arquivos['size'][$i]     ?? 0,
        ];
    }
    return $norm;
}

$arquivosValidos = [];
$finfo = new finfo(FILEINFO_MIME_TYPE);

foreach (normalizarArquivos($_FILES['imagens'] ?? []) as $arquivo) {
    if ($arquivo['error'] === UPLOAD_ERR_NO_FILE) continue;

    if ($arquivo['size'] > $maxFileSize) {
        echo json_encode(['status' => 'error', 'message' => 'Arquivo ' . $arquivo['name'] . ' excede 5MB']);
        exit;
    }

    $mime = $finfo->file($arquivo['tmp_name']);
    if (!in_array($mime, $allowedMimeTypes, true)) {
        echo json_encode(['status' => 'error', 'message' => 'Arquivo ' . $arquivo['name'] . ' não é uma imagem válida']);
        exit;
    }

    $arquivosValidos[] = $arquivo;
}

if (empty($arquivosValidos)) {
    echo json_encode(['status' => 'error', 'message' => 'Nenhuma imagem válida enviada']);
    exit;
}



$postFields = [];
$index = 0;


foreach ($arquivosValidos as $i => $arquivo) {
    $postFields["images"] = new CURLFile(
        $arquivo['tmp_name'],
        $finfo->file($arquivo['tmp_name']),
        $arquivo['name']
    );
}

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL            => $endpoints->urlListing . "/{$listingId}/images",
    CURLOPT_CUSTOMREQUEST  => 'PUT',
    CURLOPT_POSTFIELDS     => $postFields,   // cURL monta o multipart automaticamente
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => [
        "Authorization: Bearer {$token}",
        // NÃO defina Content-Type aqui — cURL define com o boundary correto
    ],
]);

$response   = curl_exec($ch);
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($statusCode >= 200 && $statusCode <= 299) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => "Ocorreu um erro ao atualizar a imagem!", 'response' => $response]);
}

?>