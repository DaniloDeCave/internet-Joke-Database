<?php
include_once __DIR__.'/includes/DatabaseConnection.php';

function totalJokes($pdo){

    $query = $pdo->prepare('SELECT COUNT(*) FROM `joke`');
    $query->execute();

    $row = $query->fetch();

    return $row[0];
}

?>