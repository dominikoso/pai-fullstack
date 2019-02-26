<?php
header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');
require 'vendor/autoload.php';
 
use App\SQLiteConnection;
 
$pdo = (new SQLiteConnection())->connect();

    if(!isset($_GET['id'])){
        $stmt = $pdo->prepare("SELECT * FROM baza");
    }else{
        $stmt = $pdo->prepare("SELECT * FROM baza WHERE id = :id");
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    }

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($results);
