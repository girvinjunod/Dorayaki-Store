<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/riwayat.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <title>History</title>
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
        <?php
            $db = new SQLite3('db/doraemon.db');
            $res = $db->query('SELECT * FROM riwayat ORDER BY waktu desc');
            $ada = 0;
            while($row = $res->fetchArray(SQLITE3_ASSOC)) {
                $ada = 1;
            }
            if ($ada){
                echo "<tr>";
                    echo "<th>Variant Name</th>";
                    echo "<th>Username</th>";
                    echo "<th>Stock Change</th>";
                    echo "<th>Price</th>";
                    echo "<th>Time</th>";
                echo "</tr>";

                while($row = $res->fetchArray(SQLITE3_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . "<a href='" . "pembelianDorayaki.php?id=" . $row['id_varian'] . "'>" . $row["varian"] . "</a></td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["perubahan"] . "</td>";
                    echo "<td>" . $row["harga"] . "</td>";
                    echo "<td>" . $row["waktu"] . "</td>";
                    echo "</tr>";
                }
            }
            else{
                echo "<p>You haven't purchased anything yet :(</p>";
            }
            $db->close();
        ?>

        <?php
            } else{
        ?>
        <?php
            $db = new SQLite3('db/doraemon.db');
            // $res = $db->query('SELECT * FROM riwayat, user 
            // where riwayat.username = user.username and is_admin = 0 
            // ORDER BY waktu desc');
            $prep = $db->prepare('SELECT * FROM riwayat, user 
            where riwayat.username = user.username and is_admin = 0 and user.username = ? 
            ORDER BY waktu desc');
            $prep->bindParam(1, $uname);
            $uname = $_SESSION['username'];
            $res = $prep->execute();
            $ada = 0;
            while($row = $res->fetchArray(SQLITE3_ASSOC)) {
                $ada = 1;
            }
            if ($ada){
                echo "<tr>";
                    echo "<th>Variant Name</th>";
                    echo "<th>Amount</th>";
                    echo "<th>Price</th>";
                    echo "<th>Time</th>";
                echo "</tr>";

                while($row = $res->fetchArray(SQLITE3_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . "<a href='" . "pembelianDorayaki.php?id=" . $row['id_varian'] . "'>" . $row["varian"] . "</a></td>";
                    echo "<td>" . abs($row["perubahan"]) . "</td>";
                    echo "<td>" . $row["harga"] . "</td>";
                    echo "<td>" . $row["waktu"] . "</td>";
                    echo "</tr>";
                }

            }
            else{
                echo "<p>You haven't purchased anything yet :(</p>";
            }
            $db->close();
        ?>  



        <?php
            }
        ?>

        </table>

    </div>

</div>