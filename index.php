
<?php

if (!isset($_SESSION)) {
    session_start();
}

require __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require "controller/config.php";
require ROOT . "/controller/router2.php";
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

