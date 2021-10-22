<?php
$email = $_REQUEST["email"];
$uname = $_REQUEST["uname"];
$password = $_REQUEST["password"];
$confirmpassword = $_REQUEST["confirmpassword"];
if ($email != ""){
    $pattern = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/i";
    if (preg_match($pattern, $email)){
        echo true;
    }
    else{
        echo false;
    }
} else if ($uname != "") {
    $pattern = "/[a-z0-9_]+$/i";
    if (preg_match($pattern, $uname)){
        //database validation
        $db = new SQLite3('db/doraemon.db');
         if(!$db) {
            echo false;
         } else {    
            $res = $db->query('SELECT * FROM user');
            $valid = true;

            while($row = $res->fetchArray(SQLITE3_ASSOC)) {
                if ($row['username'] == $uname){
                    $valid = false;
                    break;
                  }
                }
            }
        $db->close();
        echo $valid;
    }
    else{
        echo false;
    }
} else if ($password != "" and $confirmpassword =="") {
    if (strlen($password) >=6){
        echo true;
    }
    else{
        echo false;
    }
} else if ($password != "" and $confirmpassword!= "") {
    if ($password == $confirmpassword){
        echo true;
    }
    else{
        echo false;
    }
}

?>
