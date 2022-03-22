<?php
namespace App;

class Routes{

    // funzione per il routing
    public function callAction($route){

        include __DIR__.'/../../includes/DatabaseConnection.php';
    
        $jokesTable     = new \MyFramework\DatabaseTable($pdo, 'joke', 'id');
<<<<<<< HEAD
        $authorsTable   = new \MyFramework\DatabaseTable($pdo, 'author', 'id');

        $jokeController = new \App\Controllers\Joke($jokesTable,$authorsTable);
        $authorController = new \App\Controllers\Register($authorsTable);              
              
        // elenco rotte con metodi REST
        $routes = [

            'author/register'=>[
                'POST' => [
                    'controller'=> $authorController,
                    'action'=> 'registerUser'
                ],
                'GET' => [
                    'controller'=> $authorController,
                    'action'=> 'registrationForm'
                ]
            ],

            'author/success'=>[
                'GET' => [
                    'controller'=> $authorController,
                    'action'=> 'registrationSuccess'
                ]
            ],

            'joke/edit'=>[
                'POST' => [
                    'controller'=> $jokeController,
                    'action'=> 'edit'
                ],
                'GET' => [
                    'controller'=> $jokeController,
                    'action'=> 'edit'
                ]
            ],

            'joke/delete'=>[
                'POST' => [
                    'controller'=> $jokeController,
                    'action'=> 'delete'
                ]
            ],

            
            'joke/list'=>[
                'GET' => [
                    'controller'=> $jokeController,
                    'action'=> 'list'
                ]
            ],

            'home'=>[
                'GET' => [
                    'controller'=> $jokeController,
                    'action'=> 'home'
                ]
            ]
        ];

        $method = $_SERVER['REQUEST_METHOD'];
        $controller = $routes[$route][$method]['controller'];
        $action = $routes[$route][$method]['action'];

        return $controller->$action();
    }  
=======
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
    
>>>>>>> d114055bd114124502be3663ea0fbbbff02cda87
}