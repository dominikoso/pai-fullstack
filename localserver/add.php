<?php
    header("Access-Control-Allow-Origin: *");
    require 'vendor/autoload.php';
 
    use App\SQLiteConnection;

    if (isset($_POST['Name']) && isset($_POST['Surname']) && isset($_POST['Age']) && isset($_POST['Sex'])){
 
        $pdo = (new SQLiteConnection())->connect();
        $stmt = $pdo->prepare('INSERT INTO baza(Name, Surname, Age, Sex) VALUES (?, ?, ?, ?)');
        $stmt->execute([$_POST['Name'], $_POST['Surname'], $_POST['Age'], $_POST['Sex']]);

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
    <form action="add.php" method="post">
        Name: <input type="text" name="Name" required><br>
        Surname: <input type="text" name="Surname" required><br>
        Age: <input type="number" name="Age" min=0 required><br>
        Sex: <select name="Sex" id="Sex">
            <option value="M">Men</option>
            <option value="K">Woman</option>
        </select><br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>  
</body>
</html>
