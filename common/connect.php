<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=classicmodels', 'root', '');
    $pdo->exec('SET NAMES UTF8'); //Récupère des valeurs en utf8
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Option d'envoi des erreurs mysql
} catch (PDOException $e) {
    echo $e->getMessage();
}