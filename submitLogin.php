<?php
    session_start();
    $uname = $_POST["uname"];
    $password = $_POST["password"];
    # pastiin kalau dia cuma bisa diakses lewat submit
    if (isset($_POST['submit'])) {
        $db = new SQLite3('db/doraemon.db');
        if(!$db) {
            // echo "Error opening database";
        } else { 
            # $res = $db->prepare('SELECT * FROM user where (?, ?)');
            $statement = $db->prepare('SELECT username, password, is_admin FROM user WHERE username = :username');
            $statement->bindValue(':username', $uname);
            $result = $statement->execute();
            $account = $result->fetchArray();
            if ($account != false && password_verify($password, $account['password'])) {
                $_SESSION['loginstate'] = true;
                $hash = password_hash($uname, PASSWORD_DEFAULT);
                setcookie("username", $hash, time() + (1440), "/");
                $insertlogin = $db->prepare('INSERT into login(username, token, time) VALUES(?, ?, ?)');
                $insertlogin->bindParam(1, $uname);
                $insertlogin->bindParam(2, $hash);
                $insertlogin->bindParam(3, $waktulogin);
                $waktulogin = time();
                $reslogin = $insertlogin->execute();
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