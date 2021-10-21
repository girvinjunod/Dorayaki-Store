<?php
session_start();
if (!isset($_SESSION["username"])){
    header('Location: '. "login.php");
  }
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
                ApelManggaKucing hadir menjadi toko dorayaki favorit anda, tidak perlu khawatir kami menyediakan banyak varian rasa yang tentunya sangat enak dan memiliki harga yang terjangkau.
                Berikut 10 Dorayaki Best Seller
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
                          <h6> Rp <?php echo $cek['harga']  ?></h6>
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
                      <a href="detailDorayaki.php?id=<?php echo $cek["id"] ?>"><button class="primary-button">BUY</button></a>
                  </div>
              </div>
            <?php } 

          ?>
        </div>
    </div>
</section>
<!-- End of Item List -->


<?php
include "component/footer.php";
?>

