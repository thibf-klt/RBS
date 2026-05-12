<?php
require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/model/testimony.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";

// prepare all the data needed
    $testimonies = getTestimonies();
    
require_once ROOT . "/app/view/testimony.php";
require_once ROOT . "/app/view/footer.php";
?>