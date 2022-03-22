<?php
namespace App\Controllers;
use \MyFramework\DatabaseTable;

class Register{

    private $authorsTable;

    public function __construct(DatabaseTable $authorsTable){
        $this->authorsTable = $authorsTable; 
    }

    public function registrationForm(){
        return [
            'template'  => 'regform.html.php',
            'title'     => 'Registrati'
        ];
    }
    
    public function registrationSuccess(){
        return [
            'template'  => 'regsuccess.html.php',
            'title'     => 'Sei Registrato'
        ];
    }
    
    public function registerUser(){
        $author = $_POST['author'];

        // inizializzo array vuoto per contenere gli errori riscontrati
        $errors = [];

        // presumo che i campi inseriti siano validi
        $valid = true;
        // controllo se tutti i campi siano stati riempiti
        if(empty($author['name'])){
            $valid    = false;
            $errors[] = " il nome non può essere vuoto";
        }
        if (empty($author['email'])){
            $valid = false;
            $errors[] = " la mail non può essere vuota";
        }

        if (empty($author['password'])){
            $valid = false;
            $errors[] = " la password non può essere vuota";
        }

        if(filter_var($author['email'],FILTER_VALIDATE_EMAIL)===false){
            $valid = false;
            $errors[] = " Formato email non valido;

        }

        if($valid==true){
            $this->authorsTable->save($author);
            header('Location: index.php?route=author/success');
        }
        else{
            return [
                'template'  => 'regform.html.php',
                'title'     => 'Registrati',
                'variables' =>[
                    'errors' =>$errors,
                    'author' => $author
                ]
            ];
        }

    }
}