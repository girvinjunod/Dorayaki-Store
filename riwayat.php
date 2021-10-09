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
        <h2 class="judul">Riwayat Perubahan Stok/Pembelian</h2>
        <table class="tabel-riwayat">
        <tr>
            <th>Nama Varian</th>
            <th>Username</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Waktu</th>
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

        </table>

    </div>

</div>