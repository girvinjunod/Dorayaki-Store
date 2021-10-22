<?php
session_start();
if(isset($_COOKIE['username'])) {
    $db = new SQLite3('db/doraemon.db');
    $prep = $db->prepare('SELECT * from login where token=? ORDER BY id_login desc LIMIT 1');
    $prep->bindParam(1, $_COOKIE['username']);
    $rescookie = $prep->execute();
    $valid = 0;
    while($rowcookie = $rescookie->fetchArray(SQLITE3_ASSOC)) {
        $valid = 1;
        if (time() - $rowcookie['time'] > 300){
            $valid = 0;
        }
    }
    if ($valid){
        header('Location: '. "index.php");
    }
    else{
        setcookie("username", "", time() - 3600);
    }
}
?>

<head>
    <link rel="stylesheet" href="assets/global.css">
    <link rel="stylesheet" href="assets/login.css">
    <link rel="icon" type="image/x-icon" href="assets/img/dorayaki.ico"/>
    <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<div class="container">
    <div class="gambar">
        <img src="assets/img/doraemon3.png" alt="doraemon terbang" class="doraemon">
    </div>
    <div class="form-register">
        <h2>LOGIN</h2>
        <form action="submitLogin.php" method="POST" class="form">
            <input type="text" name="uname" id="uname"
                placeholder="Username" onblur="valUname(this.value);">
            <label for="uname" class="uname-err err-msg hide">
                Please enter your username.
            </label>
            <input type="password" name="password" id="password" 
                placeholder="Password" onblur="valPassword(this.value);">
            <label for="password" class="pass-err err-msg hide">Please fill the password field.</label>
            <label for="password" id="info-label">
                Don't have an account? <a href="register.php"> Register here. </a>
            </label>
            <?php
                if(isset($_SESSION["error"])){
                    $error = $_SESSION["error"];
                    echo "<label id='invalid-label'>";
                    echo $error;
                    echo "</label>";
                }
            ?> 
            <button class="reg-button" type="submit" name="submit">LOGIN</button>
        </form>
    </div>
</div>

<script>
    function valUname(uname){
        var msg = document.querySelector(".uname-err");
        console.log("Masuk");
        if (uname.length == 0){
            msg.classList.remove("hide");
            console.log("muncul");
        } else{
            msg.classList.add("hide");
            console.log("sembunyi");
            
        }
    }
    function valPassword(pass){
        var msg = document.querySelector(".pass-err");
        console.log("Masuk");
        if (pass.length == 0){
            msg.classList.remove("hide");
            console.log("muncul");
        } else{
            msg.classList.add("hide");
            console.log("sembunyi");
            
        }
    }
</script>


<?php
    unset($_SESSION["error"]);
?>