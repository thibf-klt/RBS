<?php
$errors = [];
$insertSuccess = isset($_GET['success']);
$updateSuccess = isset($_GET['updated']);
$deleteSuccess = isset($_GET['deleted']);
$posts = [];

require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";

require_once ROOT . "/app/model/createPost.php";

require_once ROOT . "/app/view/createPost.php";
require_once ROOT . "/app/view/footer.php";
?>