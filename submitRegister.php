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
            // add database validation
            $valUname = true;
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
        echo "yey";
        // masukin ke database
        // login
        // header('Location: '. "dashboard.php");
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