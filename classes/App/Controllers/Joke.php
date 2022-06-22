<?php
namespace App\Controllers;
use \MyFramework\DatabaseTable;


class Joke{
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
                'id'       => $joke['id'],
                'joketext' => $joke['joketext'],
                'jokedate' => $joke['jokedate'],
                'name'     => $author['name'],
                'email'    => $author['email']
            ];
        }
    
        $title = 'joke List';
        // function findAll($pdo, $table)
        $totalJokes = $this->jokesTable->totalJokes();
        
        // output buffering permette di memorizzare , all'interno di un buffer sul server
        // il contenuto resituito da un echo.
        // prevede due funzioni : ob_start() e ob_get_clean()
        // il primo ( ob_start() ) avvia il buffer e tutto ció    
        // che viene visualizzato con echo o html ,viene memorizzato 
        // invece di essere inviato al browser
        // il secondo ( ob_get_clean() ) restituisce il contenuto del buffer e svuota il buffer;
    
       return [
           'template'=>'jokes.html.php',
           'title'=>$title,
           'variables' => [
               'totalJokes' => $totalJokes,
               'jokes'      => $jokes
           ]
        ];

    }
    
    public function home(){
        $title = 'internet Joke Database';
        $totalJokes = $this->jokesTable->totalJokes();

        return [
            'title'=>$title,
            'template'=>'home.html.php',
            'variables' => [
                'totalJokes' => $totalJokes            
            ]
        ];
    }

    public function delete(){
        $this->jokesTable->delete($_POST['id']);
        header('location: index.php?route=joke/list');
    }

    public function edit(){
        if(isset($_POST['joke'])){

            $joke              = $_POST['joke'];
            $joke['jokedate']  = new \DateTime();
            $joke['authorid']  = 1;
    
            // function save($pdo, $table, $primaryKey, $record)
            $this->jokesTable->save($joke);
    
            header('location: index.php?route=joke/list');
        }
        else{
            if(isset ($_GET['id'])){
                // function findById($pdo, $table, $primaryKey,$value)
                $joke = $this->jokesTable->findById($_GET['id']);
            }

            $title = "edit Joke";
            
            return [
                'template'  => 'editjoke.html.php',
                'title'     => $title,
                'variables' => [
                    'joke'  =>$joke ?? null
                ]
             ];
     
        }        
    }
}