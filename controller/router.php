<?php

/**
*	Module du routage
*	Chaque action est récupérée par la méthode : $_GET
*/

function redirectTowards($action="default") {
	
    $actions = array();
    $actions["default"] = "welcome.php";
    $actions["exercise"] = "exercises.php";
    $actions["post"] = "posts.php";
    $actions["protocol"] = "protocols.php";
    $actions["testimony"] = "testimonies.php";
    $actions["authentification"] = "authentification.php";

	$controller_id = $actions[$action];

	//si le fichier n'existe pas :
	if(! file_exists(__DIR__ . '/'. $controller_id) ) die("Le fichier : " . $controller_id . " n'existe pas !");

	//si la clé "action" existe dans notre tableau "actions" :
    if (array_key_exists($action, $actions)) {
		// le fichier à inclure sera retourné :
        return $controller_id;
    } else {
        return $actions["default"];
    }
}

?>