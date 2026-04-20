<?php
    require_once ROOT . "/model/post.php"; 
    require_once ROOT . "/model/testimony.php"; 

    // prepare all the data needed
    $posts = getPosts();
    $testimonies = getTestimonies();

    // start the rendering
    require_once ROOT . "/view/welcome.php";
    
?>