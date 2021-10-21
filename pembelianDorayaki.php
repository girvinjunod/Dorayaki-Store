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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembelian Dorayaki</title>
  <link rel="stylesheet" href="assets/detailDorayaki.css">
  <link rel="stylesheet" href="assets/style.css">
  <link rel="stylesheet" href="assets/itemlist.css">
  <link rel="stylesheet" href="assets/addVariant.css">
</head>
<body>
<?php
include "component/header.php";
?>  
<?php 
    if (isset($_GET["err"])){
        if($_GET["err"]=="0"){
        ?>
        <div class="success-msg">
            <p class="msg">Transaction Success</p>
        </div>

        <?php 
        } else if ($_GET["err"]==1){ ?>
        <div class="error-msg">
            <p>Transaction Failed, please try again</p>
        </div>

        <?php
        } else if ($_GET["err"]==2){ ?>
        <div class="error-msg delete-msg">
            <p>Delete Variant Failed, please try again</p>
        </div>      
        <?php }
    }
?>
      <?php       
        if(isset($_GET['id'])){
          $id = $_GET['id'] ;
        }
        $dataExist = false;
        $db = new SQLite3('db/doraemon.db');
        $querySearchData = $db->prepare("select * from dorayaki where id = ?");
        $querySearchData->bindParam(1,$id);
        $searchResult = $querySearchData->execute();

        while ($cek = $searchResult->fetchArray(SQLITE3_ASSOC)){ 
          $dataExist = true;
          $data = '<h1>'.$cek["nama"].'</h1>
                  <h2 class="price">Rp. <span id="hargaDorayaki">'.$cek["harga"].'</span></h2>
                  <h3 >Stok : <span id="dataStok">'.$cek["stok"].'</span></h3>
                  <h4 class="deskripsi">'.$cek["deskripsi"].'</h4> ';
                  $image = '<img src='.$cek["gambar"].' alt="">';
                  $stok = $cek["stok"];
                  $harga = $cek["harga"];
                }
        if (!$dataExist){
          ?>
          <form id="err-404" action="404.php">
            <input type="hidden" name="redirect">
          </form>
          <script>
          document.getElementById("err-404").submit();
          </script>
          <?php
        }        
      ?>

<div class="detail-container">
  <div class="picture">
    <?php echo $image ?>
  </div>
  <div class="content">
    <?php echo $data ?>
    <!-- <div class="pembelian"> -->            
      <!-- <button onclick="console.log(document.getElementById('number').innerHTML)">Mangga</button> -->
      <form class="pembelian" action="checkPembelian.php" method="POST">
        <div id="decreaseButton" class="primary-button operation" onclick="decreaseItem()">-</div>
        <input name="jumlahBarang" id="number" type="text" class="data" value="1"></input>
        <input name="idVarian" type="hidden" value="<?php echo $_GET['id'] ?>"></input>
        <div id="increaseButton" class="primary-button operation" onclick="increaseItem()">+</div>
        <input id="totalHarga" type="text" class="data totalprice" value="Rp. <?php echo $harga ?>"></input>
        <?php if ($isAdmin){ ?>
        <button name="buy" id="buyButton" class="primary-button buy">Add </button>
          <?php } else { ?>
        <button id="buyButton" class="primary-button buy">Buy</button>
          <?php } ?>
      </form>
      
      <script>
        function decreaseItem(){
          console.log("kurang");
          var number = document.getElementById('number').value;
          const harga = <?php echo $harga ?>;
          number = parseInt(number) - 1;
          if (number >= 0 && !<?php echo ($isAdmin) ?>){
            document.getElementById('number').value = parseInt(number);
            document.getElementById('totalHarga').value = 'Rp. ' + parseInt(number)*parseInt(harga);
            if (number == 0){
              document.getElementById('decreaseButton').classList.add('disabled');
              document.getElementById('buyButton').classList.add('disabled');
            } else {
              document.getElementById('increaseButton').classList.remove('disabled');   
            }              
          } else {
            document.getElementById('number').value = parseInt(number);
            if (number == -1*<?php echo $stok ?>){
              document.getElementById('decreaseButton').classList.add('disabled');
            }
            document.getElementById('totalHarga').value = 'Rp. ' + 0;
          }
        }
        function increaseItem(){
          console.log("tambah");
          var number = document.getElementById('number').value;
          const harga = <?php echo $harga ?>;
          number = parseInt(number) + 1;
          if (number <= <?php echo $stok ?> || <?php echo ($isAdmin) ?>){
            document.getElementById('number').value = parseInt(number);
            document.getElementById('totalHarga').value = 'Rp. ' + parseInt(number)*parseInt(harga);
            if (<?php echo ($isAdmin) ?>){
              document.getElementById('totalHarga').value = 'Rp. ' + 0;
            }
              if (number == <?php echo $stok ?> && <?php echo ($isAdmin) ?> == 0){
                  document.getElementById('increaseButton').classList.add('disabled');
              } else {
                  document.getElementById('decreaseButton').classList.remove('disabled');
                  document.getElementById('buyButton').classList.remove('disabled');
              }
          }
        }
        function getStockData(){
          const req = new XMLHttpRequest();
          req.open("GET","checkPembelian.php?id=" + <?php echo $_GET["id"]?>);
          req.send();
          req.onload = function(){
            if (this){
              console.log("kucing");
              console.log(this.responseText);
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

        <?php 
        if (isset($_GET["err"])){
            if($_GET["err"]=="0"){
            ?>
            setTimeout( function() {
                var sign = document.querySelector(".success-msg");
                sign.classList.add("hide2");
            } ,
            5000)
            <?php 
            } else if ($_GET["err"]=="1"){ ?>
            setTimeout( function() {
                var sign = document.querySelector(".error-msg");
                sign.classList.add("hide2");
            } ,
            5000)
            <?php 
            } else if ($_GET["err"]=="2"){ ?>
              setTimeout( function() {
                  var sign = document.querySelector(".error-msg.delete-msg");
                  sign.classList.add("hide2");
              } , 5000)
            <?php 
            }
          }
          ?>
      </script>
  </div>
</div>
</body>
</html>