<?php
header("Access-Control-Allow-Origin: *");
require 'vendor/autoload.php';
 
use App\SQLiteConnection;
 
$pdo = (new SQLiteConnection())->connect();
    
    $stmt = $pdo->prepare('DELETE FROM baza WHERE id = :id');
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();