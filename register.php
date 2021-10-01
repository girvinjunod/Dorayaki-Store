<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <title>Register</title>
</head>
<body>
<div class="container">
    <div class="gambar">
        <img src="assets/register.png" alt="doraemon buka pintu" class="doraemon">
    </div>

    <div class="form-register">
        <h2>Register</h2>
        <form action="" class="form">
            <input type="text" name="email" id="email" 
            placeholder="Email" onblur="valEmail(this.value);">
            <label for="email" class="email-err hide">Please enter a valid email.</label>

            <input type="text" name="uname" id="uname" 
            placeholder="Username" onblur="valUname(this.value);" class="uname">
            <label for="uname" class="uname-err hide">Please make sure your username is unique and valid [a-zA-Z0-9_].</label>
            
            <input type="password" name="password" id="password" 
            placeholder="Password" onblur="valPassword(this.value);" class="pass">
            <label for="password" class="pass-err hide">Your password needs to have a minimum of 6 characters.</label>
            
            <input type="password" name="confirmpassword" id="confirmpassword" 
            placeholder="Confirm Password" onkeyup="valConfirmPassword(this.value)"> 
            <label for="confirmpassword" class="confirmpass-err hide">Those passwords didn't match, try again.</label>
            
            <button class="reg-button">Register</button>
        </form>
    </div>

</div>

<script>
    function valEmail(email){
        var msg = document.querySelector(".email-err");
        if (email.length > 0){
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
            req.open("GET", "checkRegister.php?email=" + email);
            req.send()
        } else{
            msg.classList.add("hide");
        }
    }

    function valUname(uname){
        var msg = document.querySelector(".uname-err");
        var input = document.querySelector(".uname");
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
        if (conpassword.length > 0){
            const req = new XMLHttpRequest();
            req.onload = function (){
                if (this){
                    if (this.responseText) {
                        msg.classList.add("hide");
                    }
                    else{
                        msg.classList.remove("hide");
                    }
                }
            }
            var password = document.querySelector(".pass").value;
            req.open("GET", "checkRegister.php?confirmpassword=" + conpassword + "&password=" + password);
            req.send()
        } else{
            msg.classList.add("hide");
        }
    }

</script>

</body>
</html>