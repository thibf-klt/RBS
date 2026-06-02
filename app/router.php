<?php
class Route {
    private array $protected = [
        'exercise', 'protocol', 'personalSpace',
        'updatePost', 'backOffice', 'updateUser', 'updateDataUser',
        'manageExercise', 'createExercise'
    ];
    
    private $pdo; 

    public function __construct($pdo) 
    {
        $this->pdo = $pdo;
    }

    private function checkSession(): void {
        if (!isset($_SESSION['email'])) {
            header('Location: index.php?action=connexion');
            exit;
        }
    }

    public function redirectTowards(string $action = "welcome"): void {
        $pdo = $this->pdo; 
        if (in_array($action, $this->protected)) {
            $this->checkSession();
        }
        switch ($action) {
            case 'welcome':
                require ROOT . "/app/controller/welcome.php";
                break;
            case 'exercise':
                require ROOT . "/app/controller/exercise.php";
                break;
            case 'testimony':
                require ROOT . "/app/controller/testimony.php";
                break;
            case 'protocol':
                require ROOT . "/app/controller/protocol.php";
                break;
            case 'post':
                require ROOT . "/app/controller/post.php";
                break;
            case 'connexion':
                require ROOT . "/app/controller/connexion.php";
                break;
            case 'service':
                require ROOT . "/app/controller/service.php";
                break;
            case 'updatePost':
                require ROOT . "/app/controller/updatePost.php";
                break;
            case 'presentation':
                require ROOT . "/app/controller/presentation.php";
                break;
            case 'prestation':
                require ROOT . "/app/controller/prestation.php";
                break;
            case 'authentification':
                require ROOT . "/app/controller/authentification.php";
                break;
            case 'contact':
                require ROOT . "/app/controller/contact.php";
                break;
            case 'individual':
                require ROOT . "/app/controller/individual.php";
                break;
            case 'entreprise':
                require ROOT . "/app/controller/entreprise.php";
                break;
            case 'personalSpace':
                require ROOT . "/app/controller/personalSpace.php";
                break;
            case 'confidentiality':
                require ROOT . "/app/controller/confidentiality.php";
                break;
            case 'backoffice':
                require ROOT . "/app/controller/backoffice.php";
                break;
            case 'updateUser':
                require ROOT . "/app/controller/updateUser.php";
                break;
            case 'manageTestimony':
                require ROOT . "/app/controller/manageTestimony.php";
                break;
            case 'createProtocol':
                require ROOT . "/app/controller/createProtocol.php";
                break;
            case 'deleteProtocol':
                require ROOT . "/app/controller/deleteProtocol.php";
                break;
            case 'getProtocolsByClient':
                require ROOT . "/app/controller/getProtocolsByClient.php";
                break;
            case "downloadPdf":
                require_once ROOT . "/app/controller/downloadPdf.php";
                break;
            case 'createPost':
                require ROOT . "/app/controller/createPost.php";
                break;
            case 'manageExercise':
                require ROOT . "/app/controller/manageExercise.php";
                break;
            case 'createExercise':
                require ROOT . "/app/controller/manageExercise.php";
                break;
            case 'logout':
                require ROOT . "/app/controller/deconnexion.php";
                break;
            case 'updateDataUser':
                require ROOT . "/app/controller/updateDataUser.php";
                break;
            case 'deleteDataUser':
                require ROOT . "/app/controller/updateDataUser.php";
                break;
            default:
                require ROOT . "/app/controller/page404.php";
                break;
        }
    }
}