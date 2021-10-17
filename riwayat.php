<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/riwayat.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <title>Add New Dorayaki Variant</title>
</head>
<body>

<!-- ini navbar -->
<?php
include "component/header.php";
?>

<div class="riwayat-container">
    <div class="riwayat-list">
        <?php
            if ($_SESSION['isAdmin']){
        ?>
            <h2 class="judul">Stock History</h2>
        <?php
            } else{
        ?>
            <h2 class="judul">Purchase History</h2>
        <?php
            }
        ?>
        <table class="tabel-riwayat">
        <?php
            if ($_SESSION['isAdmin']){
        ?>
            
            <tr>
            <th>Variant Name</th>
            <th>Username</th>
            <th>Stock Change</th>
            <th>Price</th>
            <th>Time</th>
        </tr>
        <?php
            $db = new SQLite3('db/doraemon.db');
            $res = $db->query('SELECT * FROM riwayat ORDER BY waktu desc');
            while($row = $res->fetchArray(SQLITE3_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row["varian"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["perubahan"] . "</td>";
                echo "<td>" . $row["harga"] . "</td>";
                echo "<td>" . $row["waktu"] . "</td>";
                echo "</tr>";
            }
        ?>

        <?php
            } else{
        ?>
          <tr>
            <th>Variant Name</th>
            <th>Amount</th>
            <th>Price</th>
            <th>Time</th>
        </tr>
        <?php
            $db = new SQLite3('db/doraemon.db');
            $res = $db->query('SELECT * FROM riwayat, user 
            where riwayat.username = user.username and is_admin = 0 
            ORDER BY waktu desc');
            while($row = $res->fetchArray(SQLITE3_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row["varian"] . "</td>";
                echo "<td>" . abs($row["perubahan"]) . "</td>";
                echo "<td>" . $row["harga"] . "</td>";
                echo "<td>" . $row["waktu"] . "</td>";
                echo "</tr>";
            }
        ?>  



        <?php
            }
        ?>

        </table>

    </div>

</div>