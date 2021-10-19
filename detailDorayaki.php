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
        
        $db = new SQLite3('db/doraemon.db');
        $querySearchData = $db->prepare("select * from dorayaki where id = ?");
        $querySearchData->bindParam(1,$id);
        $searchResult = $querySearchData->execute();
        $ada = 0;
        while ($cek = $searchResult->fetchArray(SQLITE3_ASSOC)){
          $ada = 1; 
          $data = '<h1>'.$cek["nama"].'</h1>
          <h2 class="price">Rp. <span id="hargaDorayaki">'.$cek["harga"].'</span></h2>
          <h3 >Stok : <span id="dataStok">'.$cek["stok"].'</span></h3>
          <h4 class="deskripsi">'.$cek["deskripsi"].'</h4> ';
          $image = '<img src='.$cek["gambar"].' alt="">';
        }
        if ($ada){
      ?>
  <div class="detail-container">
    <div class="picture">
      <?php echo $image ?>
    </div>
    <div class="content">
      <?php echo $data ?>
      <div class="pembelian">
        <a href="pembelianDorayaki.php?id=<?php echo $id ?>"><button class="primary-button detail">Buy</button></a>
      </div>
    </div>
  </div>

  <?php
          }
          else{
            header('Location: '. "404.php");
          }
  }
    else{
      header('Location: '. "404.php");
    }
  ?>
</body>
</html>