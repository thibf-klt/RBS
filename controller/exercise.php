<?php

// check if user is logged on
if (!isset($_SESSION['idUser'])) {
    header('Location: /authentification.php');
    exit;
}

// call the view
require_once ROOT . "/view/head.php";
require_once ROOT . "/view/header.php";
require_once ROOT . "/view/menu.php";
require_once ROOT . "/model/exercise.php";

// get the data
$pdfs = getPdf($_SESSION['idUser']);
$medias = getMedias($_SESSION['idUser']);

require_once ROOT . "/view/exercise.php";
require_once ROOT . "/view/footer.php";
?>