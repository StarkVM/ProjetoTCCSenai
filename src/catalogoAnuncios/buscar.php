<?php
error_reporting(0);
require_once("../endpoints.php");
header("Content-Type: application/json; charset=UTF-8");

$endpoints = new Endpoints();
$page     = (int)($_GET["page"]     ?? 1);
$pageSize = (int)($_GET["pageSize"] ?? 50);
$name     = trim($_GET["Name"]      ?? "");
$category = trim($_GET["Category"]  ?? "");

$qs = "mine=false&page={$page}&pageSize={$pageSize}";
if ($name     !== "") $qs .= "&Name="     . urlencode($name);
if ($category !== "") $qs .= "&Category=" . urlencode($category);

$url = $endpoints->urlListing . "?" . $qs;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
$response   = curl_exec($ch);
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo ($statusCode >= 200 && $statusCode <= 299)
    ? $response
    : json_encode(["items" => [], "error" => "Erro $statusCode", "url" => $url]);