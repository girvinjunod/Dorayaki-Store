<?php
    session_start();
    $email = $_POST["email"];
    $password = $_POST["password"];
    # pastiin kalau dia cuma bisa diakses lewat submit
    if (isset($_POST['submit'])) {
        $db = new SQLite3('db/doraemon.db');
        if(!$db) {
            echo "Error opening database";
        } else {
            # echo "a"; 
            # $res = $db->prepare('SELECT * FROM user where (?, ?)');
            $statement = $db->prepare('SELECT username FROM user WHERE email = :email AND password = :password');
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);
            $result = $statement->execute();
            $account = $result->fetchArray();
            if ($account != false) {
                $_SESSION['loginstate'] = true;
                $_SESSION['username'] = $account["username"];
                header('Location:index.php?login-success');
            } else {
                # invalid username / pass
                header('Location:login.php?error=invalid-credentials');
            }
         }
        $db->close();
    } else {
        header('Location:login.php?error=invalid-ref');
    }


?>