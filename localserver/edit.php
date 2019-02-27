<?php
header("Access-Control-Allow-Origin: *");
require 'vendor/autoload.php';
 
use App\SQLiteConnection;

$pdo = (new SQLiteConnection())->connect();

if (isset($_POST['Name']) && isset($_POST['Surname']) && isset($_POST['Age']) && isset($_POST['Sex'])){
    
    $stmt = $pdo->prepare('UPDATE baza SET Name = ?, Surname = ?, Age = ?, Sex = ? WHERE id = ?');
    $stmt->execute([$_POST['Name'], $_POST['Surname'], $_POST['Age'], $_POST['Sex'], $_GET['id']]);

    echo  "<script type='text/javascript'>";
    echo "window.close();";
    echo "</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        $stmt = $pdo->prepare('SELECT * FROM baza WHERE id = :id');
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '
    <form action="edit.php?id='.$_GET['id'].'" method="post">
        Name: <input type="text" name="Name" value="'.$res[0]['Name'].'" required><br>
        Surname: <input type="text" name="Surname" value="'.$res[0]['Surname'].'" required><br>
        Age: <input type="number" name="Age" value="'.$res[0]['Age'].'" min=0 required><br>
        Sex: <select name="Sex" id="Sex">
            <option value="M">Men</option>
            <option value="K">Woman</option>
        </select><br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>  
    ';
    ?>
</body>
</html>