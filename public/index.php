<?php

// funzione caricamento file template
function loadTemplate($templateFileName, $variables = []){

    extract($variables);

    ob_start();
    include __DIR__.'/../templates/'.$templateFileName;

    return ob_get_clean();
}

try{
    
    include __DIR__.'/../includes/DatabaseConnection.php';
    include __DIR__.'/../classes/DatabaseTable.php';
    include __DIR__.'/../Controllers/JokeController.php';

    $jokesTable     = new DatabaseTable($pdo,'joke','id');
    $authorsTable   = new DatabaseTable($pdo,'author','id');
    $jokeController = new JokeController($jokesTable,$authorsTable);

    $action = $_GET['action'] ?? 'list';
    $page   = $jokeController->$action();

    $title  = $page['title'];
    
    if(isset($page['variables'])){
      $output = loadTemplate($page['template'],$page['variables']);
    }
    else{
        $output = loadTemplate($page['template']);
    }

}

catch(PDOException $e){
    $title  = 'C\' è stato un errore : ';
    $output = 'Errore Database in :'.$e->getMessage().'in'.$e->getFile().' : '.$e->getLine();
}

include __DIR__.'/../templates/layout.html.php';




