<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Dorayaki</title>
  <link rel="stylesheet" href="assets/detailDorayaki.css">
  <link rel="stylesheet" href="assets/style.css">
  <link rel="stylesheet" href="assets/itemlist.css">
</head>
<body>
<?php
include "component/header.php";
?>  
      <?php 
        if(isset($_GET['id'])){
          $id = $_GET['id'] ;
        }
        $db = new SQLite3('db/doraemon.db');
        $querySearchData = $db->prepare("select * from dorayaki where id = ?");
        $querySearchData->bindParam(1,$id);
        $searchResult = $querySearchData->execute();
        while ($cek = $searchResult->fetchArray(SQLITE3_ASSOC)){ 
          $data = '<h1>'.$cek["nama"].'</h1>
                  <h2>Rp. '.$cek["harga"].'</h2>
                  <h4 class="deskripsi">'.$cek["deskripsi"].'</h4> ';
          $image = '<img src='.$cek["gambar"].' alt="">';
        }
        
      ?>
  <div class="detail-container">
    <div class="picture">
      <?php echo $image ?>
    </div>
    <div class="content">
      <?php echo $data ?>
      <div class="pembelian">
        <button class="primary-button">Buy</button>
      </div>
    </div>
  </div>
</body>
</html>