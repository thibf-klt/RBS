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
        case 'presentation';
            require ROOT . "/controller/presentation.php";
            break;
        case 'prestation';
            require ROOT . "/controller/prestation.php";
            break;  
        case 'authentification';
            require ROOT . "/controller/authentification.php";
            break; 
        case 'contact';
            require ROOT . "/controller/contact.php";
            break;
        case 'individual';
            require ROOT . "/controller/individual.php";
            break;    
        case 'entreprise';
            require ROOT . "/controller/entreprise.php";
            break;    
        case 'personalSpace';
            require ROOT . "/controller/personalSpace.php";
            break;    
        case 'confidentiality';
            require ROOT . "/controller/confidentiality.php";
            break;  
        default:
            require ROOT . "/controller/page404.php";
            break;
        }
    }
}