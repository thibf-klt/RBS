<?php
require_once ROOT . "/view/head.php";
require_once ROOT . "/model/post.php";
require_once ROOT . "/view/header.php";
require_once ROOT . "/view/menu.php";

// prepare all the data needed
    $posts = getPosts();

require_once ROOT . "/view/blog.php";
require_once ROOT . "/view/footer.php";

?>