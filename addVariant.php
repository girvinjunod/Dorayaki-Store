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

  $getAllDorayakiName = $db->prepare('SELECT nama from dorayaki');
  $allDorayakiName = $getAllDorayakiName->execute();
  $arrName = array();
    while ($cek = $allDorayakiName->fetchArray(SQLITE3_ASSOC)){ 
        array_push($arrName, $cek['nama']);
    }

  $soapclient = new SoapClient('http://localhost:8080/webservice/apelmanggakucing/?wsdl');
  $response = $soapclient->getAllRecipe();  

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
    <title>Add New Dorayaki Variant</title>
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
            <p class="msg">Variant successfully added.</p>
        </div>

        <?php 
        } else if ($_GET["err"]==1){ ?>
        <div class="error-msg">
            <p>Error in adding variant.</p>
        </div>

        <?php
      }
    }
?>

<div class="containervariant">

<div class="form-register">
        <h2>Add Variant</h2>
        <form action="submitAddVariant.php" method="POST" class="form" onsubmit="return valSubmit();" enctype="multipart/form-data">
        <label for="recipe" class="recipe-text">Choose Dorayaki Recipe</label>
        <select name="recipe" id="recipe" required>
                <?php
                    foreach ($response as $value) {
                        foreach ($value as $val) {
                            $someObject = json_decode($val);
                            if (!in_array($someObject->recipe_name,  $arrName)){
                                echo '<option class="recipe-opt" value=' . $someObject->id_recipe . '>' . $someObject->recipe_name . '</option>';
                            }     
                        }
                    }
                ?>
        </select>    
        
        <input type="hidden" name="nama" id="nama" value="">

            <textarea name="deskripsi" id="deskripsi" onblur="valDesc(this.value);" placeholder="Description"></textarea>
            <label for="deskripsi" class="desc-err hide label">Please fill the description field.</label>
            
            <input type="number" name="harga" id="harga" min="0"
            placeholder="Variant Price" onblur="valPrice(this.value);">
            <label for="harga" class="price-err hide label">Please fill the price field.</label>
            

            <input type="file" id="img" name="img" accept="image/*" onblur="valImg(this.value);" class="file">
            <div class="file-btn">
                <label for="img" class="file" onclick="getFileName();">Input Image File</label>
                <p id="file-name" class=""></p>
            </div>
            
            
            <label for="img" class="img-err hide">Please input an image for the variant.</label>
            
            <p id="submit-err" class="hide">Please fill all the required fields properly before registering.</p>
            
            <p id="no-recipe" class="hide">No recipe left.</p>

            <button class="add-button">Add</button>
        </form>
    </div>

</div>

<script>
    let cekRecipe = document.getElementsByName("recipe")[0];
    if (cekRecipe.value==""){
        console.log("no recipe left")
        var norecipe = document.querySelector("#no-recipe");
        norecipe.classList.remove("hide");
    }

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
        var name = document.getElementsByName("nama")[0];
        var recipe = document.getElementsByName("recipe")[0];
        name.value = recipe.options[recipe.selectedIndex].text;
        var desc = document.getElementsByName("deskripsi")[0].value;
        var price = document.getElementsByName("harga")[0].value;
        var img = document.getElementsByName("img")[0].value;

        if (name == "" || desc == "" || price == "" || img == "" || price < 0 || stock < 0 || recipe.value==""){
            event.preventDefault();
            var submitErr = document.querySelector("#submit-err");
            submitErr.classList.remove("hide");
        } else{
            return true;
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