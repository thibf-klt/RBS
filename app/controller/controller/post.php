<?php
require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/model/post.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";

// prepare all the data needed
    $posts = getPosts();

require_once ROOT . "/app/view/blog.php";
require_once ROOT . "/app/view/footer.php";

?>