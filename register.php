<?php
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

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <title>Register</title>
</head>
<body>

<?php 
    if (isset($_GET["err"])){
        if ($_GET["err"]==1){ ?>
        <div class="error-msg">
            <p>Please fill all the required fields properly before registering.</p>
        </div>

        <?php
        }
    }
?>


<div class="container">
    <div class="gambar">
        <img src="assets/img/register.png" alt="doraemon buka pintu" class="doraemon">
    </div>

    <div class="form-register">
        <h2>Register</h2>
        <form action="submitRegister.php" method="POST" class="form" onsubmit="return valSubmit();">
            <input type="text" name="email" id="email"
            placeholder="Email" onblur="valEmail(this.value);">
            <label for="email" class="email-err hide">Please enter a valid email.</label>

            <input type="text" name="uname" id="uname" 
            placeholder="Username" onblur="valUname(this.value);">
            <label for="uname" class="uname-err hide">Please make sure your username is unique and valid [a-zA-Z0-9_].</label>
            
            <input type="password" name="password" id="password" 
            placeholder="Password" onblur="valPassword(this.value);" class="pass">
            <label for="password" class="pass-err hide">Your password needs to have a minimum of 6 characters.</label>
            
            <input type="password" name="confirmpassword" id="confirmpassword" 
            placeholder="Confirm Password" onkeyup="valConfirmPassword(this.value)"> 
            <label for="confirmpassword" class="confirmpass-err hide">Those passwords didn't match, try again.</label>
            <label for="confirmpassword" id="info-label" class="redirect">Already have an account? <a href="login.php"> Login here. </a></label>
            
            <p id="submit-err" class="hide">Please fill all the required fields properly before registering.</p>
            <button class="reg-button">Register</button>
        </form>
        
    </div>

</div>

<script>
    //frontend submit validation
    function valSubmit(){
        var email = document.getElementsByName("email")[0].classList.length;
        var uname = document.getElementsByName("uname")[0].classList.length;
        var pass = document.getElementsByName("password")[0].classList.length;
        var confpass = document.getElementsByName("confirmpassword")[0].classList.length;
        
        if (!(email && uname && pass && confpass)){
            event.preventDefault();
            var submitErr = document.querySelector("#submit-err");
            submitErr.classList.remove("hide");
        } else{
            return true;
        }
    }



    function valEmail(email){
        var msg = document.querySelector(".email-err");
        var input = document.getElementsByName("email")[0];
        if (email.length > 0){
            const req = new XMLHttpRequest();
            req.onload = function (){
                if (this){
                    if (this.responseText) {
                        console.log("benar");
                        msg.classList.add("hide");
                        input.classList.add("correct");
                    }
                    else{
                        console.log("salah");
                        msg.classList.remove("hide");
                        input.classList.remove("correct");
                    }
                }
            }
            req.open("GET", "checkRegister.php?email=" + email);
            req.send()
        } else{
            msg.classList.add("hide");
            input.classList.remove("correct");
        }
    }

    function valUname(uname){
        var msg = document.querySelector(".uname-err");
        var input = document.getElementsByName("uname")[0];
        if (uname.length > 0){
            const req = new XMLHttpRequest();
            req.onload = function (){
                if (this){
                    if (this.responseText) {
                        console.log("benar");
                        msg.classList.add("hide");
                        input.classList.add("correct");
                    }
                    else{
                        console.log("salah");
                        msg.classList.remove("hide");
                        input.classList.remove("correct");
                    }
                }
            }
            req.open("GET", "checkRegister.php?uname=" + uname);
            req.send()
        }
        else{
            msg.classList.add("hide");
            input.classList.remove("correct");
        }
    }

    function valPassword(password){
        var msg = document.querySelector(".pass-err");
        if (password.length > 0){
            const req = new XMLHttpRequest();
            req.onload = function (){
                if (this){
                    if (this.responseText) {
                        console.log("benar");
                        msg.classList.add("hide");
                    }
                    else{
                        console.log("salah");
                        msg.classList.remove("hide");
                    }
                }
            }
            req.open("GET", "checkRegister.php?password=" + password);
            req.send();
        } else{
            msg.classList.add("hide");
        }
    }

    function valConfirmPassword(conpassword){
        var msg = document.querySelector(".confirmpass-err");
        var input1 = document.getElementsByName("password")[0];
        var input2 = document.getElementsByName("confirmpassword")[0];

        if (conpassword.length > 0){
            const req = new XMLHttpRequest();
            req.onload = function (){
                if (this){
                    if (this.responseText) {
                        msg.classList.add("hide");
                        input1.classList.add("correct");
                        input2.classList.add("correct");
                    }
                    else{
                        msg.classList.remove("hide");
                        input1.classList.remove("correct");
                        input2.classList.remove("correct");
                    }
                }
            }
            var password = document.querySelector(".pass").value;
            req.open("GET", "checkRegister.php?confirmpassword=" + conpassword + "&password=" + password);
            req.send()
        } else{
            msg.classList.add("hide");
            input1.classList.remove("correct");
            input2.classList.remove("correct");
        }
    }

    <?php 
    if ($_GET["err"]==1){ ?>
    setTimeout( function() {
        
        var sign = document.querySelector(".error-msg");
        sign.classList.add("hide2");
    } ,
    5000)


    <?php
    }
    ?>


</script>

</body>
</html>