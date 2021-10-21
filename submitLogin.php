<?php
    session_start();
    $uname = $_POST["uname"];
    $password = $_POST["password"];
    # pastiin kalau dia cuma bisa diakses lewat submit
    if (isset($_POST['submit'])) {
        $db = new SQLite3('db/doraemon.db');
        if(!$db) {
            echo "Error opening database";
            exit();
        } else { 
            $statement = $db->prepare('SELECT username, password, is_admin FROM user WHERE username = :username');
            $statement->bindValue(':username', $uname);
            $result = $statement->execute();
            $account = $result->fetchArray();
            if ($account != false && password_verify($password, $account['password'])) {
                # Cookie
                $hash = hash('sha256', $uname);
                $prep = $db->prepare("INSERT INTO login(session_id, username, is_admin) VALUES (?, ?, ?)");
                $prep->bindParam(1, $hash);
                $prep->bindParam(2, $uname);
                $admin = 0;
                $prep->bindParam(3, $admin);
                $res = $prep->execute();
                setcookie('session_id', $hash, time()+120);
                
                # Session
                $_SESSION['loginstate'] = true;
                $_SESSION['username'] = $account["username"];
                $_SESSION['isAdmin'] = $account["is_admin"];
                header('Location:index.php?login-success');
                exit();
            } else {
                # invalid username / pass
                $_SESSION["error"] = "Incorrect Username or Password";
                header('Location:login.php?error=invalid-credentials');
                exit();
            }
         }
        $db->close();
    } else {
        header('Location:login.php?error=invalid-ref');
    }


?>