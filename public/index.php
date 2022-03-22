<?php

try{

    include __DIR__.'/../includes/autoload.php';
    
<<<<<<< HEAD
    $route          = $_GET['route'] ?? 'home';

    $entryPoint     = new \MyFramework\EntryPoint( $route, new \App\Routes() );

    $entryPoint->run();

=======
    $route          = ltrim(strtok($_SERVER['REQUEST_URI'], '?'),'/');
    $entryPoint     = new \MyFramework\EntryPoint( $route, new \App\Routes() );

    echo $route;
    $entryPoint->run();
>>>>>>> d114055bd114124502be3663ea0fbbbff02cda87

}

catch(\PDOException $e){
    $title  = 'C\' è stato un errore : ';
    $output = 'Errore in :'.$e->getMessage().'in'.$e->getFile().' : '.$e->getLine();
    include __DIR__.'/../templates/layout.html.php';
<<<<<<< HEAD

}
// include __DIR__.'/../templates/layout.html.php';



=======
}
>>>>>>> d114055bd114124502be3663ea0fbbbff02cda87
















