<?php
    session_start();

    require_once 'connect.php';
        
    try 
  {
     $pdo = new PDO($attr,$user,$pass,$opts);
  }
  catch (PDOException $e) 
  {
     throw new PDOException($e->getMessage(),(int)$e->getCode());
  }
    
    if (isset($_POST['login']) && isset($_POST['pass'])) {
        $login=get_post($pdo,'login');
        $pass=get_post($pdo,'pass');
        $query="SELECT * FROM Users WHERE login = $login AND pass = $pass";
        $result=$pdo->query($query);
        $row=$result->fetch(PDO::FETCH_ASSOC);
        //var_dump($row);
            if ($result->rowCount() == 1) {
                $_SESSION['login'] = $login;
                $_SESSION['id'] = $row['ID'];
                header('location: /cabinet.php');
                die();
            } else {
                echo "Wrong login or password";
            }
    }  

    function get_post($pdo,$var)
      {
         return $pdo->quote($_POST[$var]);
      }
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
    <div class='login'>
    <form action='index.php' method="POST">
        Login<input type="text" name="login" autocomplete="off" autofocus='autofocus'>
        Password<input type="password" name="pass" autocomplete="off">
        <input type="submit" value="Enter">
    </form>
    <a href="/registration.php">Sign Up</a>
    </div>
</body>
</html>