<?php
    require_once ROOT . "/app/model/post.php"; 
    require_once ROOT . "/app/model/testimony.php"; 
    require_once ROOT . "/app/view/head.php";
    require_once ROOT . "/app/view/header.php";
    require_once ROOT . "/app/view/menu.php";

    // prepare all the data needed
    $posts = getPosts();
    $testimonies = getTestimonies();

    // start the rendering
    require_once ROOT . "/app/view/welcome.php";
    require_once ROOT . "/app/view/service.php";
    require_once ROOT . "/app/view/post.php";
    require_once ROOT . "/app/view/testimony.php";
    require_once ROOT . "/app/view/footer.php";
    
?>