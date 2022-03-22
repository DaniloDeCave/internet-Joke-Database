<?php
namespace App;

class Routes{

    // funzione per il routing
    public function callAction($route){

        include __DIR__.'/../../includes/DatabaseConnection.php';
    
        $jokesTable     = new \MyFramework\DatabaseTable($pdo, 'joke', 'id');
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
}