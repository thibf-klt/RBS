<?php
$errors = [];
$insertSuccess = false;

require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once ROOT . "/app/model/createPost.php";
}

require_once ROOT . "/app/view/createPost.php";
require_once ROOT . "/app/view/footer.php";
?>