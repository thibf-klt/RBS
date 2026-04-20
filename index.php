
<?php

if (!isset($_SESSION)) {
    session_start();
}

require __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require "app/config.php";
require ROOT . "/app/router.php";
require ROOT . "/model/connect.php";

$action = "";

if (isset($_GET["action"])) {
    $action = $_GET["action"];
    $route = new Route();
        $route->redirectTowards($action);
    
} else {
    require ROOT . "/controller/welcome.php";
}

?>

