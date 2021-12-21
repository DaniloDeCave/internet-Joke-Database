<?php
if(isset($_POST['joketext'])){
    try{
        // inclusione script connessione al database    
            include __DIR__.'/../includes/DatabaseConnection.php';
            include __DIR__.'/../includes/DatabaseFunctions.php';

            
            $fields= [
                'authorid'=> 1,
                'joketext'=> $_POST['joketext'],
                'jokedate'=> new DateTime()
            ];

            // function insert($pdo, $table, $fields)
            insert($pdo,'joke',$fields);

        header('location: jokes.php');
    }
    catch(PDOException $e){
        $output = 'C e\' stato un errore nell \' inserimento : '. 
        $e->getMessage(). ' in '.
        $e->getFile().' : '.$e->getLine();
    }
}
else{
    $title = "Add a new Joke";
    ob_start();
    include __DIR__.'/../templates/addjoke.html.php';
    $output = ob_get_clean();
}
include __DIR__.'/../templates/layout.html.php';

?>