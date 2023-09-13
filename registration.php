<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo</title>
    <link rel="stylesheet" href="style/main.css">

    <script>
        function validate(form)
        {
            fail = validateLogin(form.login.value)
            fail += validatePassword(form.pass.value)
            fail += validateName(form.name.value)

            if (fail == "") return true
            else { alert(fail); return false}
        }

        function validateLogin(field)
        {
            if (field == "") return "No login was entered.\n"
            else if (field.length < 5) return "Login must be at least 5 characters.\n"
            return ""
        }

        function validatePassword(field)
        {
            if (field == "") return "No Password was entered.\n"
            else if (field.length < 5) return "Password must be at least 5 characters.\n"
            return ""
        }

        function validateName(field)
        {
            return (field == "") ? "No Name was entered.\n" : ""
        }
    </script>
</head>
<body>
    <form action="registration.php" method="POST" onsubmit="return validate(this)">
        Login<input type="text" name="login">
        Password<input type="password" name="pass">
        Your Name<input type="text" name="name">
        <input type="submit" value="Sign Up">
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

        if (isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['name'])) {
            $login = get_post($pdo,'login');
            $query="SELECT login FROM Users WHERE login = $login";
            $result=$pdo->query($query);

            if($result->rowCount() == 0) {
                $pass = get_post($pdo,'pass');
                $name = get_post($pdo,'name');

                $query="INSERT INTO Users VALUES (NULL,$login,$pass,$name)";
                $result=$pdo->query($query);

                echo "Registred";
            } else {
                echo "User already exist";
            }
        } 
        function get_post($pdo,$var)
      {
         return $pdo->quote($_POST[$var]);
      }
     ?>

     <a href="index.php">Log In</a>
</body>
</html>