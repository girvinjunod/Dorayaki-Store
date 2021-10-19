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
</head>

<div class="container">
    <div class="gambar">
        <img src="assets/img/doraemon3.png" alt="doraemon terbang" class="doraemon">
    </div>
    <div class="form-register">
        <h2>LOGIN</h2>
        <form action="submitLogin.php" method="POST" class="form">
            <input type="email" name="email" id="email"
                placeholder="Email" required>
            <label id="info-label">
                Please enter a valid email.
            </label>
            <input type="password" name="password" id="password" 
                placeholder="Password" required>
            <label id="info-label">
                Don't have an account? <a href="register.php"> click here </a>
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

<?php
    unset($_SESSION["error"]);
?>