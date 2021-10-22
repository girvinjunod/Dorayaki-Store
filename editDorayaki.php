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
  } else{
    $token = $_COOKIE['username'];
    $getuname = $db->prepare('SELECT username FROM login WHERE token = :token');
    $getuname->bindValue(':token', $token);
    $resUname = $getuname->execute();
    $unameArr = $resUname->fetchArray();
    $uname = $unameArr['username'];
    
    $statement = $db->prepare('SELECT is_admin FROM user WHERE username = :username');
    $statement->bindValue(':username', $uname);
    $result = $statement->execute();
    $account = $result->fetchArray();
    $isAdmin = false;
    if ($account != false) {
        $isAdmin = $account["is_admin"];
    }
    if (!$isAdmin){
        header('Location: '. "index.php");
    }
  }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/addVariant.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets/img/dorayaki.ico"/>
    <title>Edit Dorayaki</title>
</head>
<body>

<!-- ini navbar -->
<?php
include "component/header.php";
?>

<?php 
    if (isset($_GET["err"])){
        if($_GET["err"]=="0"){
        ?>
        <div class="success-msg">
            <p class="msg">Variant successfully edited.</p>
        </div>

        <?php 
        } else if ($_GET["err"]==1){ ?>
        <div class="error-msg">
            <p>Error in editing variant.</p>
        </div>

        <?php
      }
    }
?>

<div class="containervariant">

<div class="form-register">
        <h2>Edit Variant</h2>
        <?php 
          $id = 0;
          $nama = '';
          $deskripsi = '';
          $harga = 0;
          if (isset($_GET['id'])){
            $id = $_GET['id'] ;
            $db = new SQLite3('db/doraemon.db');
            $querySearchData = $db->prepare("select * from dorayaki where id = ?");
            $querySearchData->bindParam(1,$id);
            $searchResult = $querySearchData->execute();
            $dataExist = false;
            while ($cek = $searchResult->fetchArray(SQLITE3_ASSOC)){ 
              $nama = $cek['nama'];
              $deskripsi = $cek['deskripsi'];
              $harga = $cek['harga'];
              $dataExist = true;
            }
            if (!$dataExist){
            ?>
                <form id="err-404" action="404.php">
                <input type="hidden" name="redirect">
                </form>
                <script>
                console.log("kucinggarong");
                document.getElementById("err-404").submit();
                </script>
                <?php
              }        
            }
            else{
                ?>
                <form id="err-404" action="404.php">
                <input type="hidden" name="redirect">
                </form>
                <script>
                console.log("kucinggarong");
                document.getElementById("err-404").submit();
                </script>
                <?php
              }      
            ?>
            <form action="submitEditDorayaki.php" method="POST" class="form" enctype="multipart/form-data">
            <input type="text" name="nama" id="nama"
            placeholder="Variant Name"  value="<?php echo $nama ?>">
            <label for="nama" class="name-err hide label">Please fill the name field.</label>

            <textarea name="deskripsi" id="deskripsi"  placeholder="Description"><?php echo $deskripsi ?></textarea>
            <label for="deskripsi" class="desc-err hide label">Please fill the description field.</label>
            
            <input type="number" name="harga" id="harga" min="0"
            placeholder="Variant Price"  value="<?php echo $harga ?>">
            <label for="harga" class="price-err hide label">Please fill the price field.</label>
            
            <input type="hidden" name="id" value="<?php echo $id ?>"></input>

            <input type="file" id="img" name="img" accept="image/*" onblur="valImg(this.value);" class="file">
            <div class="file-btn">
                <label for="img" class="file" onclick="getFileName();">Change Image</label>
                <p id="file-name" class=""></p>
            </div>
            
            
            <!-- <label for="img" class="img-err hide">Please input an image for the variant.</label> -->
            
            <p id="submit-err" class="hide">Please fill all the required fields properly before registering.</p>
                
            <button class="add-button">Edit</button>
        </form>
    </div>

</div>

<script>

    function getFileName(){
        var p = document.getElementById("file-name");
        
        console.log(img);
        setInterval(function(){
            var img = document.getElementsByName("img")[0].value;
            var idx = img.indexOf("fakepath") + 9;
            p.textContent = img.slice(idx);
        }, 500);
        
    }

    function valSubmit(){
        var name = document.getElementsByName("nama")[0].value;
        var desc = document.getElementsByName("deskripsi")[0].value;
        var price = document.getElementsByName("harga")[0].value;
        // var stock = document.getElementsByName("stock")[0].value;
        // var img = document.getElementsByName("img")[0].value;

        if (name == "" || desc == "" || price == "" || price < 0){
            event.preventDefault();
            var submitErr = document.querySelector("#submit-err");
            submitErr.classList.remove("hide");
        } else{
            return true;
        }
    }

    function valName(name){
        var msg = document.querySelector(".name-err");
        console.log("Masuk");
        if (name.length == 0){
            msg.classList.remove("hide");
            console.log("muncul");
        } else{
            msg.classList.add("hide");
            console.log("sembunyi");
            
        }
    }

    function valDesc(desc){
        var msg = document.querySelector(".desc-err");
        console.log("Masuk");
        if (desc.length == 0){
            msg.classList.remove("hide");
            console.log("muncul");
        } else{
            msg.classList.add("hide");
            console.log("sembunyi");
        }
    }


    function valPrice(price){
        var msg = document.querySelector(".price-err");
        console.log("Masuk");
        console.log(typeof price);
        if (price.length == 0 || price < 0){
            msg.classList.remove("hide");
            console.log("muncul");
        } else{
            msg.classList.add("hide");
            console.log("sembunyi");
        }
    }


    // function valStock(stock){
    //     var msg = document.querySelector(".stock-err");
    //     console.log("Masuk");
    //     if (stock.length == 0 || stock < 0){
    //         msg.classList.remove("hide");
    //         console.log("muncul");
    //     } else{
    //         msg.classList.add("hide");
    //         console.log("sembunyi");
    //     }
    // }

    function valImg(img){
        var msg = document.querySelector(".img-err");
        if (img == ""){
            msg.classList.remove("hide");
        } else{
            msg.classList.add("hide");
        }
    }

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
        } else if ($_GET["err"]==1){ ?>
        setTimeout( function() {
            
            var sign = document.querySelector(".error-msg");
            sign.classList.add("hide2");
        } ,
        5000)


    <?php
        }
    }
    ?>


</script>

</body>
</html>