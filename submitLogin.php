<?php
    session_start();
    $uname = $_POST["uname"];
    $password = $_POST["password"];
    # pastiin kalau dia cuma bisa diakses lewat submit
    if (isset($_POST['submit'])) {
        $db = new SQLite3('db/doraemon.db');
        if(!$db) {
            echo "Error opening database";
        } else { 
            # $res = $db->prepare('SELECT * FROM user where (?, ?)');
            $statement = $db->prepare('SELECT username, password, is_admin FROM user WHERE username = :username');
            $statement->bindValue(':username', $uname);
            $result = $statement->execute();
            $account = $result->fetchArray();
            if ($account != false && password_verify($password, $account['password'])) {
                $_SESSION['loginstate'] = true;
                $_SESSION['username'] = $account["username"];
                $_SESSION['isAdmin'] = $account["is_admin"];
                header('Location:index.php?login-success');
            } else {
                # invalid username / pass
                $_SESSION["error"] = "Incorrect Username or Password";
                header('Location:login.php?error=invalid-credentials');
            }
         }
        $db->close();
    } else {
        header('Location:login.php?error=invalid-ref');
    }


?>