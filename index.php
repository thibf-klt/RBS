<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('RBS');

    // Cookie destroyed when the browser is closed
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Strict'
    ]);

    session_start();

    // Deconnected automatically after 30 minutes without activity
    $timeout = 1800;
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
        session_unset();
        session_destroy();
        session_start();
    }
    $_SESSION['last_activity'] = time();
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
    $route = new Route($pdo);
    $route->redirectTowards($action);
} else {
    require ROOT . "/app/controller/welcome.php";
}
?>