<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/global.css">
    <link rel="stylesheet" href="assets/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="gambar">
            <img src="assets/img/register.png" alt="doraemon buka pintu" class="doraemon">
        </div>

        <div class="form-register">
            <h2>LOGIN</h2>
            <form action="#" method="POST" class="form">
                <input type="text" name="email" id="email"
                    placeholder="Email" onblur="valEmail(this.value);">
                <label id="info-label">
                    Please enter a valid email.
                </label>

                <input type="password" name="password" id="password" 
                    placeholder="Password" onblur="valPassword(this.value);" class="pass">
                <label id="info-label">
                    Your password needs to have a minimum of 6 characters.
                </label>
                <button class="reg-button" type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>
</html>