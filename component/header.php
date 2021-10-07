<?php
// $query = $_POST["query"];
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  if ($_POST["query"]){
    header('Location: '. "search.php?q=".$_POST["query"]);
  } else {
    header('Location: '. "search.php?q=");
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a href="/"> <h2> ApelManggaKucing </h2> </a>
            </div>
            <form method="POST" action="" class="form-search">
                <input name="query" type="text" class="navbar-input" placeholder="Search for dorayaki here">
                <button class="navbar-submit" type="submit"> <img src="../assets/img/search.svg" class="search-img"> </button>
            </form>
            <a href="#"> Daftar Pembelian </a>
            <button class="navbar-button"> username </button>
        </nav>
     </header>