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
                  <h2 class="price">Rp. <span id="hargaDorayaki">'.$cek["harga"].'</span></h2>
                  <h3 >Stok : <span id="dataStok">'.$cek["stok"].'</span></h3>
                  <h4 class="deskripsi">'.$cek["deskripsi"].'</h4> ';
                  
          $image = '<img src='.$cek["gambar"].' alt="">';
          $stok = $cek["stok"];
        }
        
      ?>
  <div class="detail-container">
    <div class="picture">
      <?php echo $image ?>
    </div>
    <div class="content">
      <?php echo $data ?>
      <div class="pembelian">
        <!-- <button onclick="console.log(document.getElementById('number').innerHTML)">Mangga</button> -->
        <button class="primary-button operation" onclick="decreaseItem()">-</button>
        <button id="number" class="primary-button data" disabled>0</button>
        <button class="primary-button operation" onclick="increaseItem()">+</button>
        <button class="primary-button buy" onclick="buyItem()">Buy</button>
        <script>
          function decreaseItem(){
            var number = document.getElementById('number').innerHTML;
            if (number > 0){
              document.getElementById('number').innerHTML = parseInt(number)-1;
            }

          }
          function increaseItem(){
            var number = document.getElementById('number').innerHTML;
            if (number < <?php echo $stok ?>){
              document.getElementById('number').innerHTML = parseInt(number)+1;
            }
          }
          function getStockData(){
            const req = new XMLHttpRequest();
            req.open("GET","checkStock.php?id=" + <?php echo $_GET["id"] ?>);
            req.send();
            req.onload = function(){
              if (this){
                if (parseInt(this.responseText) != parseInt(document.getElementById('dataStok').innerHTML)){
                  document.getElementById('dataStok').innerHTML = parseInt(this.responseText)
                }
              }
            }

          }
          function getStockDataBerkala(){
            // var myid = setInterval(getStockData(),5000)
            setInterval(() => {
              getStockData();
            }, 5000);
          }
          getStockDataBerkala();
        </script>
      </div>
    </div>
  </div>
</body>
</html>