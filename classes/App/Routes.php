<?php
namespace App;

class Routes{

    // funzione per il routing
    public function callAction($route){

        include __DIR__.'/../../includes/DatabaseConnection.php';
    
        $jokesTable     = new \MyFramework\DatabaseTable($pdo, 'joke', 'id');
        $authorsTable   = new \MyFramework\DatabaseTable($pdo, 'author', 'id');        
    
        if($route === ''){
            
            $controller = new \App\Controllers\Joke($jokesTable, $authorsTable);
            $page   = $controller->home();

        }elseif($route === 'joke/list'){
            
            $controller = new \App\Controllers\Joke($jokesTable, $authorsTable);
            $page   = $controller->list();
            
        }elseif($route=== 'joke/edit'){
            
            $controller = new \App\Controllers\Joke($jokesTable, $authorsTable);
            $page   = $controller->edit();
            
        }elseif($route === 'joke/delete'){
            
            $controller = new \App\Controllers\Joke($jokesTable, $authorsTable);
            $page   = $controller->delete();
            
        }elseif($route === 'register'){
            
            $controller = new \App\Controllers\Register($authorsTable);
            $page   = $controller->regForm();
        }         
        
        return $page;

    }
    
}