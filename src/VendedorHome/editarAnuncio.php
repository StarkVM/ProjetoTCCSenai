<?php
error_reporting(0);   // ← suprime warnings que quebram o JSON
ini_set('display_errors', 0);
require("../auth/auth.php");
header("Content-Type: application/json; charset=UTF-8");

$dataJS = json_decode(file_get_contents("php://input"), true);
$dataJS = $dataJS["dados"] ?? $dataJS;
$li     = $_GET["cd"] ?? null;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';
require_once("../endpoints.php");

$endpoints = new Endpoints();

$addr = $dataJS["pickupAddress"] ?? [];

$dados = [
    "title"       => $dataJS["title"]       ?? "",
    "description" => $dataJS["description"] ?? "",
    "category"    => (int)($dataJS["category"]   ?? 0),
    "dailyPrice"  => (float)($dataJS["dailyPrice"] ?? 0),
    "pickupAddress" => [
        "state"      => $addr["state"]      ?? "",  // ← estava $dataJS["state"], errado
        "city"       => $addr["city"]       ?? "",
        "district"   => $addr["district"]   ?? "",
        "street"     => $addr["street"]     ?? "",
        "number"     => $addr["number"]     ?? "",
        "zipCode"    => $addr["zipCode"]    ?? "",
        "complement" => $addr["complement"] ?? "",
    ],
    "operatorOption" => [
        "isAvailable"          => (bool)($dataJS["operatorOption"]["isAvailable"]          ?? false),
        "additionalDailyPrice" => (float)($dataJS["operatorOption"]["additionalDailyPrice"] ?? 0),
    ],
    "freightOption" => [
        "isAvailable" => (bool)($dataJS["freightOption"]["isAvailable"] ?? false),
        "fixedPrice"  => (float)($dataJS["freightOption"]["fixedPrice"] ?? 0),
    ],
];

$url = $endpoints->urlListing . "/{$li}";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $_SESSION['accessToken'],
]);

$response   = curl_exec($ch);
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($statusCode >= 200 && $statusCode <= 299) {
    echo json_encode(["status" => "success"]);
} else {
    http_response_code($statusCode);
    echo json_encode(["status" => "error", "code" => $statusCode]);
}