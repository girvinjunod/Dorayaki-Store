<?php
$email = $_POST["email"];
$uname = $_POST["uname"];
$password = $_POST["password"];
$confirmpassword = $_POST["confirmpassword"];

if ($email and $uname and $password and $confirmpassword){
    $valEmail = false;
    $valUname = false;
    $valPassword = false;
    $valConfirm = false;
    if ($email != ""){
        $pattern = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/i";
        if (preg_match($pattern, $email)){
            $valEmail =  true;
        }
    } 
    if ($uname != "") {
        $pattern = "/[a-z0-9_]+$/i";
        if (preg_match($pattern, $uname)){
            //database validation
            $db = new SQLite3('db/doraemon.db');
    
            if($db) {    
                $res = $db->query('SELECT * FROM user');
                $valUname = true;
                while($row = $res->fetchArray(SQLITE3_ASSOC) ) {
                    if ($row['username'] == $uname){
                        $valUname = false;
                        break;
                      }
                    }
                }
            $db->close();
        }
    }
    if ($password != "") {
        if (strlen($password) >=6){
            $valPassword = true;
        }
    } 
    if ($password != "" and $confirmpassword!= "") {
        if ($password == $confirmpassword){
            $valConfirm = true;
        }
    }

    if ($valEmail and $valUname and $valPassword and $valConfirm){
        // echo "data valid";
        // masukin ke database
        $db = new SQLite3('db/doraemon.db');
         if(!$db) {
            // echo "Error opening database";
         } else {
            $prep = $db->prepare("INSERT INTO user(email, username, password, is_admin) VALUES (?, ?, ?, ?)");
            $prep->bindParam(1, $email);
            $prep->bindParam(2, $uname);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $prep->bindParam(3, $hashedPassword);
            $prep->bindParam(4, $admin);
            $admin = 0;
            $res = $prep->execute();
         }
        // login
        $hash = password_hash($uname, PASSWORD_DEFAULT);
        setcookie("username", $hash, time() + (1440), "/");
        $insertlogin = $db->prepare('INSERT into login(username, token, time) VALUES(?, ?, ?)');
        $insertlogin->bindParam(1, $uname);
        $insertlogin->bindParam(2, $hash);
        $insertlogin->bindParam(3, $waktulogin);
        $waktulogin = time();
        $reslogin = $insertlogin->execute();
        $db->close();
        header('Location: '. "index.php");
    } else {
        // echo $valEmail;
        // echo $valUname;
        // echo $valPassword;
        // echo $valConfirm;
        header('Location: '. "register.php?err=1");
    }
    
} else{
    header('Location: '. "register.php?err=1");
}

?>