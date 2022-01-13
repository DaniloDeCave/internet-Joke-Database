<?php
// inclusione script connessione al database    
include __DIR__.'/../includes/DatabaseConnection.php';
include __DIR__.'/../includes/DatabaseTable.php';

$jokesTable = new DatabaseTable($pdo,'joke','id');


try{
    if(isset($_POST['joketext'])){

        // function updateJoke($pdo, $jokeId, $joketext, $authorId)
        // updateJoke($pdo, $_POST['jokeid'], $_POST['joketext'], 1);

        // Array Contenente i parametri da passare alla funzione updateJoke() di DatabaseFunctions.php
        $fields = [
            'id'=>$_POST['jokeid'],
            'joketext'=>$_POST['joketext'],
            'jokedate'=>new DateTime(),
            'authorid'=>1            
        ];

        // function save($pdo, $table, $primaryKey, $record)
        $jokesTable->save($joke);

        header('location: jokes.php');
    }
    else{
        if(isset ($_GET['id'])){
            // function findById($pdo, $table, $primaryKey,$value)
            $joke = $jokesTable->findById($_GET['id']);
        }
            $title = "edit Joke";
            
            ob_start();
            include __DIR__.'/../templates/editjoke.html.php';
            $output = ob_get_clean();
    }
    
}
catch(PDOException $e){
    $message = 'Errore ! : '. 
    $e->getMessage(). ' in '.
    $e->getFile().' : '.$e->getLine();
}
include __DIR__.'/../templates/layout.html.php';

?>