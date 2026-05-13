<?php
        
$errors = [];

if (!empty($_POST)) {    
            
    $title = $_POST['title'] ?? null;
    $content = $_POST['content'] ?? null;
    $date = $_POST['date'] ?? null;
            
    // Validation of 'title'
    if (!$title) {
        $errors['title'] = "Requis";     // if not filled
    }
    // Validation of 'content'
    if (!$content) {
        $errors['content'] = "Requis";
    }
    // Validation of 'date'
    if (!$date) {
        $errors['date'] = "Requis";
    }
}
    if (empty($_POST) || !empty($errors)) { 
    
    require ROOT . "/";    
    
    } else {
    require ROOT . "/"; 
    }
?>