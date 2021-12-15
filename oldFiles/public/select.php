<?php

try{
    $pdo = new PDO('mysql:host=localhost;dbname=ijdb','root','');
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $query = 'SELECT `joketext` FROM `joke`';

    // avvio della query con PDO
    $result = $pdo->query($query);

    // fetch del risultato della query
    while($row = $result->fetch()){
        $jokes[] = $row['joketext'];
    }

    $title = 'joke List';
    
    $output = '';
    // assegnazione valori array derivato dalla query alla variabile output
    foreach($jokes as $joke){
        $output .= '<blockquote>';
        $output .= '<p>';
        $output .= $joke;
        $output .= '</p>';
        $output .= '</blockquote>';
    }
}

catch(PDOException $e){
    $output = 'impossibile connettersi : '. 
    $e->getMessage(). ' in '.
    $e->getFile().' : '.$e->getLine();
}

include __DIR__.'/../templates/layout.html.php';

?>