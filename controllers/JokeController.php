<?php 


class JokeController{
    private $jokesTable;
    private $authorsTable;

    public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable){
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
    }

    public function list(){
        $result = $this->jokesTable->findAll();

        $jokes = [];
        // Ricerca autore per ID 
        foreach($result as $joke){
            // function findById($pdo, $table,$primaryKey,$value)
            $author = $this->authorsTable->findById($joke['authorid']);
            
            $jokes[] = [
                'id'=>$joke['id'],
                'joketext'=>$joke['joketext'],
                'jokedate'=>$joke['jokedate'],
                'name'=>$author['name'],
                'email'=>$author['email']
            ];
        }
    
        $title = 'joke List';
        // function findAll($pdo, $table)
        $totalJokes = $this->jokesTable->totalJokes();
        
        // output buffering serve per memorizzare , all'interno di un buffer sul server
        // il contenuto resituito da un echo.
        // prevede due funzioni : ob_start() e ob_get_clean()
        // il primo ( ob_start() ) avvia il buffer e tutto ció    
        // che viene visualizzato con echo o html ,viene memorizzato 
        // invece di essere inviato al browser
        // il secondo ( ob_get_clean() ) restituisce il contenuto del buffer e svuota il buffer;
    
       ob_start();
       include __DIR__.'/../templates/jokes.html.php';
       $output = ob_get_clean();

       return ['output'=>$output,'title'=>$title];

    }
    
    public function home(){
        $title = 'internet Joke Database';
        ob_start();
        include __DIR__.'/templates/layout.html.php';
        $output = ob_get_clean();

        return ['output'=>$output,'title'=>$title];
    }

    public function delete(){
        $this->jokesTable->delete($_POST['id']);
        header('location: jokes.php');
    }

    public function edit(){
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
            $this->jokesTable->save($joke);
    
            header('location: jokes.php');
        }
        else{
            if(isset ($_GET['id'])){
                // function findById($pdo, $table, $primaryKey,$value)
                $joke = $this->jokesTable->findById($_GET['id']);
            }
                $title = "edit Joke";
                
                ob_start();
                include __DIR__.'/../templates/editjoke.html.php';
                $output = ob_get_clean();

                return ['output'=>$output,'title'=>$title];

        }        
    }


}