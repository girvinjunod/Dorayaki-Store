<?php
if(!isset($_COOKIE['username'])) {
  header('Location: '. "login.php");
}
else{
  $db = new SQLite3('db/doraemon.db');
  $prep = $db->prepare('SELECT * from login where token=:token ORDER BY id_login desc LIMIT 1');
  $token = $_COOKIE['username'];
  $prep->bindParam(':token', $token);
  $rescookie = $prep->execute();
  $valid = 0;
  while($rowcookie = $rescookie->fetchArray(SQLITE3_ASSOC)) {
      $valid = 1;
      if (time() - $rowcookie['time'] > 300){
          $valid = 0;
      }
  }
  if (!$valid){
      setcookie("username", "", time() - 3600);
      header('Location: '. "login.php");
  }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
<?php
include "component/header.php";
?>
 <!-- Start of Dashboard -->
<section class="dashboard">
    <div class="container index">
        <div class="paragraph">
            <div class="title">
                <h1> 
                      ApelManggaKucing
                </h1>
            </div>
            <div class="subtitle">
                <h4>Since 2021</h4>
            </div>
            <div class="content">
                <p>ApelManggaKucing is here to serve the highest quality dorayakis. We serve the most exotics of dorayaki that people used to only be able to dream of eating.
                  We work day and night to guarantee that our dorayakis will be able to blow you away and make you keep coming back for more.
                </p>
                
                <p>Below are our top 8 best seller.</p>
            </div>
            <!-- <a href="#"> <button class="primary-button"> Learn More </button> </a> -->
        </div>
        <div class="flat">
            <img src="assets/img/doraemon1.png">
        </div>
    </div>
    <!-- <div class="arrow-down">
        <a href="#item-list"> &#8964; </a>
    </div> -->
</section>
<!-- End of Dashboard -->


<!-- Start of Item List -->
 <section id="item-list">
    <div class="container">
        <div class="card-list">
          <?php
            $db = new SQLite3('db/doraemon.db');
            $querySearchData = $db->prepare("SELECT * from dorayaki ORDER BY total_penjualan desc LIMIT 8;");
            $searchResult = $querySearchData->execute();
            while ($cek = $searchResult->fetchArray(SQLITE3_ASSOC)){ 
              ?>
              <div class="card">
                  <div class="card-image">
                    <img src="<?php echo $cek['gambar'] ?>">
                  </div>
                  <div class="card-content">
                      <div class="title">
                          <h6>
                          <?php  
                            if (strlen($cek['nama']) >= 15){
                              echo substr($cek['nama'],0,15).'...' ;
                            } else{
                              echo $cek['nama'];
                            }
                          ?> 
                          </h6>
                      </div>
                      <div class="subtitle">
                          <h6> Rp<?php echo $cek['harga']  ?></h6>
                      </div>
                      <div class="content">
                        <h6>
                      <?php  
                      if (strlen($cek['deskripsi']) >= 100){
                        echo substr($cek['deskripsi'],0,100).'...' ;
                      } else{
                        echo $cek['deskripsi'];
                      }
                      ?> 
                      </h6>
                      </div>
                      <a href="detailDorayaki.php?id=<?php echo $cek["id"] ?>"><button class="primary-button">Details</button></a>
                  </div>
              </div>
            <?php } 

          ?>
        </div>
    </div>
</section>
<!-- End of Item List -->
</body>
</html>
