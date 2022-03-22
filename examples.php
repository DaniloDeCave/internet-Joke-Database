<?php

<<<<<<< HEAD
// include __DIR__.'/includes/DatabaseConnection.php';

// // $data = [
// //     'nome' => 'danilo',
// //     'cognome' => 'de cave', 
// //     'tel' => '321654789'  
// // ];

// // extract($data);

// // echo $nome.'</br>';
// // echo $cognome;


// $sql = "SELECT * FROM `joke`";

// $query = $pdo->prepare($sql);

// $query->execute();

// $columns = $query->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// // var_dump($columns);
// print_r($columns);
// echo "</pre>";
// echo "</br>";


// foreach($columns as $column=>$values){
//     // echo $column."</br>";
//     foreach($values as $key=>$value){
//         echo $key.": ".$value."</br>";
//     }
//     echo "<hr>";
    
// }

echo $requestUri;
echo "<br/>";
echo "<pre>";
print_r ($queryString);
echo "</pre>";
echo $routing;
echo "<br/>";
echo $newroute;
echo "<br/>";



=======
include __DIR__.'/includes/DatabaseConnection.php';

// $data = [
//     'nome' => 'danilo',
//     'cognome' => 'de cave', 
//     'tel' => '321654789'  
// ];

// extract($data);

// echo $nome.'</br>';
// echo $cognome;


$sql = "SELECT * FROM `joke`";

$query = $pdo->prepare($sql);

$query->execute();

$columns = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
// var_dump($columns);
print_r($columns);
echo "</pre>";
echo "</br>";


foreach($columns as $column=>$values){
    // echo $column."</br>";
    foreach($values as $key=>$value){
        echo $key.": ".$value."</br>";
    }
    echo "<hr>";
    
}
>>>>>>> d114055bd114124502be3663ea0fbbbff02cda87
