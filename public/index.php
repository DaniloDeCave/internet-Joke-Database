<?php

try{

    include __DIR__.'/../includes/autoload.php';
    
    $route          = $_GET['route'] ?? 'home';

    $entryPoint     = new \MyFramework\EntryPoint( $route, new \App\Routes() );

    $entryPoint->run();


}

catch(\PDOException $e){
    $title  = 'C\' è stato un errore : ';
    $output = 'Errore in :'.$e->getMessage().'in'.$e->getFile().' : '.$e->getLine();
    include __DIR__.'/../templates/layout.html.php';

}
// include __DIR__.'/../templates/layout.html.php';



















