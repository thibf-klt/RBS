
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('RBS');
    session_start();
}
require __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
require "app/config.php";
require ROOT . "/app/model/connect.php";
$pdo = connexionPDO();
require ROOT . "/app/router.php";

$action = "";
if (isset($_GET["action"])) {
    $action = $_GET["action"];
    $route = new Route($pdo); // ✅ $pdo passé au constructeur
    $route->redirectTowards($action);
} else {
    require ROOT . "/app/controller/welcome.php";
}
?>