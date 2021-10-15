<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <title> Dorayaki AMK </title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/dashboard.css">
    <link rel="stylesheet" href="../assets/itemlist.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="../assets/img/dorayaki.svg">
                <a href="index.php"> <h2> ApelManggaKucing </h2> </a>
            </div>
            <form method="#" action="#" class="form-search">
                <input type="text" class="navbar-input" placeholder="Search for dorayaki here">
                <button class="navbar-submit" type="submit"> <img src="../assets/img/search.svg" class="search-img"> </button>
            </form>
            <a href="#"> Daftar Pembelian </a>
            <?php
                if ($_SESSION['loginstate'] == false) {
                    echo '<a href="login.php"> <button class="navbar-button"> LOGIN </button> </a>';
                } else {
                    echo '<button class="navbar-button">'.$_SESSION['username'].'</button>';
                }
            ?>
        </nav>
     </header>