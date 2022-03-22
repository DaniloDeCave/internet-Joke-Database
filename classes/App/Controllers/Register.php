<?php
namespace App\Controllers;
use \MyFramework\DatabaseTable;

class Register{

    private $authorsTable;

    public function __construct(DatabaseTable $authorsTable){
        $this->authorsTable = $authorsTable; 
    }

<<<<<<< HEAD
    public function registrationForm(){
=======
    public function regForm(){
>>>>>>> d114055bd114124502be3663ea0fbbbff02cda87
        return [
            'template'  => 'regform.html.php',
            'title'     => 'Registrati'
        ];
    }
    
<<<<<<< HEAD
    public function registrationSuccess(){
=======
    public function regSuccess(){
>>>>>>> d114055bd114124502be3663ea0fbbbff02cda87
        return [
            'template'  => 'regsuccess.html.php',
            'title'     => 'Sei Registrato'
        ];
    }
    
<<<<<<< HEAD
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

=======
    private function registerUser(){
        $author = $_POST['author'];
        
        // presumo che i campi inseriti siano validi
        $valid = true;

        // controllo se tutti i campi siano stati riempiti
        switch ($author) {
            case empty($author['name']):
                $valid = false;
                break;
            case empty($author['email']):
                $valid = false;
                break;
            case empty($author['password']):
                $valid = false;
                break;            
            default:
                return [
                    'template'  => 'regform.html.php',
                    'title'     => 'Registrati'
                ];
                break;
        }

        $this->authorsTable->save($author);
        header('location: /author/success');
>>>>>>> d114055bd114124502be3663ea0fbbbff02cda87
    }
}