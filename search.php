<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/global.css">
  <link rel="stylesheet" href="assets/itemlist.css">
  <link rel="stylesheet" href="assets/search.css">
  <title>Search Result</title>
</head>
<body>
<?php
include "component/header.php";
?>
    <div class="container">
        <div class="card-list">
<?php

    $db = new SQLite3('db/doraemon.db');
    if (isset($_GET['q'])){
      $test = $db->prepare("select * from dorayaki where nama LIKE ? LIMIT 8");
      $query = '%'.$_GET['q'].'%';
      $test->bindParam(1,$query);
    }else{
      $test = $db->prepare("select * from dorayaki LIMIT 8 OFFSET 5");

    }
    // echo '</br>';
    // echo $query;
    // echo '</br>';
    $res = $test->execute();
    
    
    while ($cek = $res->fetchArray(SQLITE3_ASSOC)){ 
    ?>
      <div class="card">
          <img src="<?php echo $cek['gambar'] ?>">
          <div class="card-content">
              <div class="title">
                  <h6> <?php echo $cek['nama'] ?> </h6>
              </div>
              <div class="subtitle">
                  <h6> Rp <?php echo $cek['harga']  ?></h6>
              </div>
              <div class="content">
              <?php  
              if (strlen($cek['deskripsi']) >= 100){
                echo substr($cek['deskripsi'],0,100).'...' ;
              } else{
                echo $cek['deskripsi'];
              }
              ?> 
              </div>
              <button class="primary-button">
                  BUY
              </button>
          </div>
      </div>
    <?php } 
  // }
  ?>
        </div>
      </div>
      <div class="pagination justify-content-center">
        <div class="option">Previous</div>
        <div class="option">1</div>
        <div class="option">2</div>
        <div class="option">3</div>
        <div class="option">4</div>
        <div class="option">5</div>
        <div class="option">Next</div>
      </div>
</body>
</html>

