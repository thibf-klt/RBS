
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwanon Breton - sophrologue</title>
</head>
<body>

<?php
use Dotenv\Dotenv;
require __DIR__.'/vendor/autoload.php';
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
</body>
</html>
