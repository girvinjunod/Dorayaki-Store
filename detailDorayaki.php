<?php
session_start();
if (!isset($_SESSION["username"])){
    header('Location: '. "login.php");
}
?>
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
        $dataExist = false;
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
          $dataExist = true;
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
  <div id="popupModal" class="modal">
  <form class="modal-content" action="deleteVarian.php"  method="POST" onsubmit="showPopup()">
  <h1>Are you sure you want delete this variant?</h1>  
  <input type="hidden"  value="<?php echo $_GET['id'] ?>"></input>
        <input type="hidden" name="delete" value="<?php echo $_GET['id'] ?>"></input>
        <button id="deleteButton" class="primary-button confirmation">Delete Variant</button>
        <button type="button" class="primary-button buy" onclick="document.getElementById('popupModal').style.display='none'">Cancel</button>
      </form>
  </div>      
  <div class="detail-container">
    <div class="picture">
      <?php echo $image ?>
    </div>
    <div class="content">
    <?php if ($_SESSION['isAdmin']){ ?>
      <div class="container-relative">
        <div class="delete-button" >
              <button id="deleteButton" class="primary-button delete" onclick="document.getElementById('popupModal').style.display='block'">Delete Variant</button>
              <a href="editDorayaki.php?id=<?php echo $_GET['id'] ?>"><button id="editButton" class="primary-button edit">Edit</button></a>
        </div>
      </div>
      <?php } ?>  
    <?php echo $data ?>
      <div class="pembelian">
        <a href="pembelianDorayaki.php?id=<?php echo $id ?>"><button class="primary-button detail">Buy</button></a>
      </div>
    </div>
  </div>
</body>
</html>