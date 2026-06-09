<?php

require_once("../endpoints.php");
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

$endpoints = new Endpoints();
$maxFileSize = 5 * 1024 * 1024;
$allowedMimeTypes = [
    "image/jpg"  => "jpg",
    "image/jpeg" => "jpeg",
    "image/png"  => "png",
    "image/webp" => "webp",
];

function normalizarArquivos(array $arquivos): array
{
    $normalizados = [];
    if (!isset($arquivos["name"]) || !is_array($arquivos["name"])) {
        return $normalizados;
    }
    foreach ($arquivos["name"] as $indice => $nome) {
        $normalizados[] = [
            "name"     => $nome,
            "type"     => $arquivos["type"][$indice]     ?? "",
            "tmp_name" => $arquivos["tmp_name"][$indice] ?? "",
            "error"    => $arquivos["error"][$indice]    ?? UPLOAD_ERR_NO_FILE,
            "size"     => $arquivos["size"][$indice]     ?? 0,
        ];
    }
    return $normalizados;
}

try {
    $finfo  = new finfo(FILEINFO_MIME_TYPE);
    $erros  = null;
    $arquivosValidos = [];

    foreach (normalizarArquivos($_FILES["imagens"]) as $arquivo) {
        if ($arquivo["error"] === UPLOAD_ERR_NO_FILE) {
            continue;
        }
        if ($arquivo["size"] > $maxFileSize) {
            $erros = "A imagem " . htmlspecialchars($arquivo["name"], ENT_QUOTES, "UTF-8") . " excede 5MB.";
            break; // Para no primeiro erro
        }

        $mimeType = $finfo->file($arquivo["tmp_name"]);
        if (!isset($allowedMimeTypes[$mimeType])) {
            $erros = "O arquivo " . htmlspecialchars($arquivo["name"], ENT_QUOTES, "UTF-8") . " nao e uma imagem valida.";
            break;
        }

        // Só acumula se passou nas validações
        $arquivosValidos[] = $arquivo;
    }

    if ($erros !== null) {
        header("Location: code.php?er=" . urlencode($erros));
        exit();
    }

    $dadosMaquina = [
        "nomeAtivo"            => trim($_POST["nomeAtivo"]            ?? ""),
        "tipoMaquina"          => trim($_POST["tipoMaquina"]          ?? ""),
        "marca"                => trim($_POST["marca"]                ?? ""),
        "cep"                  => trim($_POST["cep"]                  ?? ""),
        "logradouro"           => trim($_POST["logradouro"]           ?? ""),
        "bairro"               => trim($_POST["bairro"]               ?? ""),
        "localCidade"          => trim($_POST["localCidade"]          ?? ""),
        "localUF"              => trim($_POST["localUF"]              ?? ""),
        "numCasa"              => trim($_POST["numeroCasa"]           ?? ""),
        "descricao"            => trim($_POST["descricao"]            ?? ""),
        "precoDiariaMaquina"   => trim($_POST["precoDiariaMaquina"]   ?? "0"),
        "disponibilizaOperador"=> $_POST["disponibilizaOperador"]     ?? "false",
        "precoDiariaMaoObra"   => empty($_POST["precoDiariaMaoObra"]) ? 0 : $_POST["precoDiariaMaoObra"],
        "disponibilizaFrete"   => $_POST["disponibilizaFrete"]        ?? "false",
        "precoFrete"           => empty($_POST["precoFrete"])         ? 0 : $_POST["precoFrete"],
        "tipoUnidade"          => $_POST["tipoUnidade"]               ?? "false",
    ];

    $token = $_SESSION["accessToken"];
    $url   = $endpoints->urlListing;

    // Substitua o bloco de montagem do $postData e o curl_init pelo código abaixo:

    $boundary = '----HeavyRentBoundary' . bin2hex(random_bytes(16));
    $body = '';

// Campos de texto
    $campos = [
        'title'              => $dadosMaquina['nomeAtivo'],
        'description'        => $dadosMaquina['descricao'],
        'category'           => $dadosMaquina['tipoMaquina'],
        'dailyPrice'         => $dadosMaquina['precoDiariaMaquina'],
        'pickupState'        => $dadosMaquina['localUF'],
        'pickupCity'         => $dadosMaquina['localCidade'],
        'pickupDistrict'     => $dadosMaquina['bairro'],
        'pickupStreet'       => $dadosMaquina['logradouro'],
        'pickupNumber'       => $dadosMaquina['numCasa'],
        'pickupZipCode'      => $dadosMaquina['cep'],
        'pickupComplement'   => '',
        'operatorAvailable'  => $dadosMaquina['disponibilizaOperador'],
        'operatorDailyPrice' => $dadosMaquina['precoDiariaMaoObra'],
        'freightAvailable'   => $dadosMaquina['disponibilizaFrete'],
        'freightFixedPrice'  => $dadosMaquina['precoFrete'],
        'isFleet'            => $dadosMaquina['tipoUnidade'],
    ];

    foreach ($campos as $nome => $valor) {
        $body .= "--{$boundary}\r\n";
        $body .= "Content-Disposition: form-data; name=\"{$nome}\"\r\n\r\n";
        $body .= "{$valor}\r\n";
    }

// Imagens — todas com name="images[]"
    foreach ($arquivosValidos as $arquivo) {
        $conteudo  = file_get_contents($arquivo['tmp_name']);
        $mimeType  = mime_content_type($arquivo['tmp_name']);
        $nomeArq   = basename($arquivo['name']);

        $body .= "--{$boundary}\r\n";
        $body .= "Content-Disposition: form-data; name=\"images[]\"; filename=\"{$nomeArq}\"\r\n";
        $body .= "Content-Type: {$mimeType}\r\n\r\n";
        $body .= $conteudo . "\r\n";
    }

    $body .= "--{$boundary}--\r\n";

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $body,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => [
            "Authorization: Bearer {$token}",
            "Content-Type: multipart/form-data; boundary={$boundary}",
            "Content-Length: " . strlen($body),
        ],
    ]);

    $response   = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError  = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        throw new RuntimeException("Erro cURL: " . $curlError);
    }

    if ($statusCode >= 200 && $statusCode <= 299) {
        header("Location: /ProjetoTCCSenai/src/VendedorHome/code.php");

    } else {
        // Falha da API
        header("Location: code.php?er=" . urlencode("Erro ao criar anuncio. Codigo: {$statusCode}"));
        exit();
    }

} catch (Throwable $th) {
    header("Location: ../error/code.php?er=" . $statusCode);
    exit();
}
?>