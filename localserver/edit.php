<?php
header("Access-Control-Allow-Origin: *");
require 'vendor/autoload.php';
 
use App\SQLiteConnection;
 
$pdo = (new SQLiteConnection())->connect();
    
    $stmt = $pdo->prepare('UPDATE baza SET Name = :name, Surname = :surname, Age = :age, Sex = :sex WHERE id = :id');
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->bindParam(':name', $_GET['name'], PDO::PARAM_STR);
    $stmt->bindParam(':surname', $_GET['surname'], PDO::PARAM_STR);
    $stmt->bindParam(':age', $_GET['age'], PDO::PARAM_INT);
    $stmt->bindParam(':sex', $_GET['sex'], PDO::PARAM_STR);
    $stmt->execute();