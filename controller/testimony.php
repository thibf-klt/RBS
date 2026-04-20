<?php
require_once ROOT . "/view/head.php";
require_once ROOT . "/model/testimony.php";
require_once ROOT . "/view/header.php";
require_once ROOT . "/view/menu.php";

// prepare all the data needed
    $testimonies = getTestimonies();
    
require_once ROOT . "/view/testimony.php";
require_once ROOT . "/view/footer.php";
?>