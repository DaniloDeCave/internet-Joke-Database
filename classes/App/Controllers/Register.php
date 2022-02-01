<?php
namespace App\Controllers;
use \MyFramework\DatabaseTable;

class Register{

    private $authorsTable;

    public function __construct(DatabaseTable $authorsTable){
        $this->authorsTable = $authorsTable; 
    }

    public function regForm(){
        return [
            'template'  => 'regform.html.php',
            'title'     => 'Registrati'
        ];
    }
    
    public function regSuccess(){
        return [
            'template'  => 'regsuccess.html.php',
            'title'     => 'Sei Registrato'
        ];
    }
    
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
    }
}