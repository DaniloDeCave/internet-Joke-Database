<?php
namespace MyFramework;

class EntryPoint {

    private $route;
    private $routes;

    public function __construct($route, $routes){

        $this->route = $route;
        // assegno alla variabile routes , l' oggetto istanziato della classe Routes.
        $this->routes = $routes;
        // richiamo funzione per controllo URL 
        $this->checkUrl();

    }

    // funzione controllo URL (controllo se scritto in minuscolo)
    private function checkUrl(){

        if($this->route != strtolower($this->route)){
            http_response_code(301);
            header('location: '.strtolower($this->route));    
        }

    }

    // funzione caricamento file template
    public function loadTemplate($templateFileName, $variables = []){

        extract($variables);

        ob_start();
        include __DIR__.'/../../templates/'.$templateFileName;

        return ob_get_clean();
    }

    public function run(){

        // richiamo funzione routing e assegno il valore ritornato alla variabile page
        $page = $this->routes->callAction($this->route);

        $title  = $page['title'];
    
        if(isset($page['variables'])){
          $output = $this->loadTemplate($page['template'],$page['variables']);
        }
        else{
            $output = $this->loadTemplate($page['template']);
        }

        include __DIR__.'/../../templates/layout.html.php';
    }

}