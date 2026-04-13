<?php
class Route {
    public function redirectTowards (string $action="welcome"): void {
        switch ($action) {
        case 'welcome';
            require ROOT . "/controller/welcome.php";
            break;
        case 'exercise';
            require ROOT . "/controller/exercise.php";
            break;
        case 'testimony';
            require ROOT . "/controller/testimony.php";
            break;
        case 'protocol';
            require ROOT . "/controller/protocol.php";
            break;
        case 'post';
            require ROOT . "/controller/post.php";
            break;
        case 'connexion';
            require ROOT . "/controller/connexion.php";
            break;
        case 'service';
            require ROOT . "/controller/service.php";
            break;
        case 'updatePost';
            require ROOT . "/controller/updatePost.php";
            break;    
        default:
            require ROOT . "/controller/page404.php";
            break;
        }
    }
}