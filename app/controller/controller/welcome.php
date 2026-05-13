<?php
    require_once ROOT . "/app/model/post.php"; 
    require_once ROOT . "/app/model/testimony.php"; 

    // prepare all the data needed
    $posts = getPosts();
    $testimonies = getTestimonies();

    // start the rendering
    require_once ROOT . "/app/view/welcome.php";
    
?>