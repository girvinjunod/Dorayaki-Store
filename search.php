<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/global.css">
  <link rel="stylesheet" href="assets/itemlist.css">
  <title>Search Result</title>
</head>
<body>
<?php
include "component/header.php";
?>
    <div class="container">
        <div class="card-list">
<?php

  // if (){
    $db = new SQLite3('db/doraemon.db');
    if (isset($_GET['q'])){
      $test = $db->prepare("select * from dorayaki where nama LIKE ?");
      $query = '%'.$_GET['q'].'%';
      $test->bindParam(1,$query);
    }else{
      $test = $db->prepare("select * from dorayaki");

    }
    // echo '</br>';
    // echo $query;
    // echo '</br>';
    $res = $test->execute();
    
    
    while ($cek = $res->fetchArray(SQLITE3_ASSOC)){ 
    ?>
      <div class="card">
          <img src="https://dummyimage.com/600x600/000/fff">
          <div class="card-content">
              <div class="title">
                  <h6> <?php echo $cek['nama'] ?> </h6>
              </div>
              <div class="subtitle">
                  <h6> Rp <?php echo $cek['harga'] ?></h6>
              </div>
              <div class="content">
              <?php echo $cek['deskripsi'] ?> 
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
</body>
</html>

