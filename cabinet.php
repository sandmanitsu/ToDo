<?php 
session_start();
$login=$_SESSION['login'];
$id=$_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <? 
        $loginSees=str_replace('\'','',$login);
        echo "User: $loginSees";     
    ?>

    <form action="cabinet.php" method="POST">
        <input type="text" name="todo" placeholder="Need to do...">
        <input type="submit" value="Add record">
    </form>

    <?php
        require_once 'connect.php';
        
        try 
      {
         $pdo = new PDO($attr,$user,$pass,$opts);
      }
      catch (PDOException $e) 
      {
         throw new PDOException($e->getMessage(),(int)$e->getCode());
      }

        if (isset($_POST['delete']) && isset($_POST['id'])) // delete button check 
        {
            $id = get_post($pdo,'id'); //deleting record...
            $query = "DELETE FROM todo WHERE ID=$id";
            $result=$pdo->query($query);
        } 
        
        if (isset($_POST['todo'])) {
            $task = get_post($pdo,'todo');
            $query = "INSERT INTO todo VALUES (NULL,$task,$login)";
            $result=$pdo->query($query);
        }

        $query = "SELECT * FROM todo WHERE login=$login"; //query for output records 
        $result = $pdo->query($query);

        while($row=$result->fetch()) // record output 
            {
            $r0 = $row['ID'];
            $r1 = htmlspecialchars($row['task']);
         
                echo "<div class='res'>".'' . htmlentities($r1)."<br>";;

                echo  "<form action='cabinet.php' method='POST'>"; //delete form
                echo "<input type='hidden' name='delete' value ='yes'>";
                echo "<input type='hidden' name='id' value='$r0'>";
                echo "<input type='submit' value='Done'>";
                echo "</form>"."</div>";
            }

      function get_post($pdo,$var)
      {
         return $pdo->quote($_POST[$var]);
      }
    ?>

    <a href="logout.php">Log Out</a>
</body>
</html>