<?php
session_start();

if (isset($_SESSION["username"])){
    header('Location: '. "index.php");
  }

?>

<head>
    <link rel="stylesheet" href="assets/global.css">
    <link rel="stylesheet" href="assets/login.css">
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