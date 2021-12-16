<?php

    $pdo = new PDO('mysql:host=localhost;dbname=ijdb','root','');
    // ATTR_ERRMODE costante della classe PDO che controlla la modalita di errore
    // ERRMODE_EXCEPTION permette impostare la modalitá che lancia eccezioni
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
