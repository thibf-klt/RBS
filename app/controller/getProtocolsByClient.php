<?php
require_once ROOT . "/app/model/authentification.php"; 
require_once ROOT . "/app/model/protocol.php";
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isLoggedOn()) { http_response_code(401); exit(); }

$idClient = intval($_GET["idClient"] ?? 0);
$protocols = getProtocolsByClient($idClient);

header("Content-Type: application/json");
echo json_encode($protocols);
exit();