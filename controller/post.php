<?php

require_once ROOT . "/model/post.php";

// get the data
$posts = getPosts();

// call the view
include ROOT . "/view/post.php";
?>