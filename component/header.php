<?php
$token = $_COOKIE['username'];
$getuname = $db->prepare('SELECT username FROM login WHERE token = :token');
$getuname->bindValue(':token', $token);
$resUname = $getuname->execute();
$unameArr = $resUname->fetchArray();
$uname = $unameArr['username'];

$statement = $db->prepare('SELECT is_admin FROM user WHERE username = :username');
$statement->bindValue(':username', $uname);
$result = $statement->execute();
$account = $result->fetchArray();
$isAdmin = false;
if ($account != false) {
    $isAdmin = $account["is_admin"];
}

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
    <link rel="stylesheet" href="../assets/navbar.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="../assets/img/dorayaki.svg">
                <a href="/"> <h2> ApelManggaKucing </h2> </a>
            </div>
            <form method="GET" action="../getSearchPage.php" class="form-search">
                <input name="query" type="text" class="navbar-input" placeholder="Search for dorayaki here">
                <button class="navbar-submit" type="submit"> <img src="../assets/img/search.svg" class="search-img"> </button>
            </form>
            <?php
                if ($isAdmin){
            ?>
                <a href="addVariant.php"> Add Variant </a>
                <a href="riwayat.php"> Stock History </a>
            <?php
                } else{
            ?>
                <a href="riwayat.php"> Purchase History </a>
            <?php
                }
            ?>
            <div class="dropdown">
                <?php
                    echo '<button class="navbar-button">'.$uname.'</button>';
                ?>
                <div class="dropdown-content hide-dropdown">
                <form action="logout.php" method="post">
                    <input type="submit" class="logout-btn" value=" Logout "/>
                </form>
                </div>
            </div>
        <script>
            const dropdown = document.querySelector('.dropdown');
            const content = document.querySelector('.dropdown-content');

            dropdown.addEventListener('mouseover', () => {
                console.log("Masuk dropdown");
                content.classList.toggle('hide-dropdown');
            })

            dropdown.addEventListener('mouseout', () => {
                console.log("Keluar dropdown");
                content.classList.toggle('hide-dropdown');
            })
        </script>
         
        </nav>
     </header>