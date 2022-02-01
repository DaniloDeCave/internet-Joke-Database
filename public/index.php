<?php

try{

    include __DIR__.'/../includes/autoload.php';
    
    $route          = ltrim(strtok($_SERVER['REQUEST_URI'], '?'),'/');
    $entryPoint     = new \MyFramework\EntryPoint( $route, new \App\Routes() );

    echo $route;
    $entryPoint->run();

}

catch(\PDOException $e){
    $title  = 'C\' è stato un errore : ';
    $output = 'Errore in :'.$e->getMessage().'in'.$e->getFile().' : '.$e->getLine();
    include __DIR__.'/../templates/layout.html.php';
}
















