<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/global.css">
    <link rel="stylesheet" href="assets/addVariant.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <title>Add New Dorayaki Variant</title>
</head>
<body>

<!-- ini navbar -->

<!-- placeholder navbar -->
<div style="width:auto; background: brown; padding-top:20px; padding-bottom:20px;">
    placeholder navbar
</div>

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

<div class="container">

<div class="form-register">
        <h2>Add Variant</h2>
        <form action="submitAddVariant.php" method="POST" class="form" onsubmit="return valSubmit();" enctype="multipart/form-data">
            <input type="text" name="nama" id="nama"
            placeholder="Variant Name" onblur="valName(this.value);">
            <label for="nama" class="name-err hide label">Please fill the name field.</label>

            <textarea name="deskripsi" id="deskripsi" onblur="valDesc(this.value);" placeholder="Description"></textarea>
            <label for="deskripsi" class="desc-err hide label">Please fill the description field.</label>
            
            <input type="number" name="harga" id="harga" min="0"
            placeholder="Variant Price" onblur="valPrice(this.value);">
            <label for="harga" class="price-err hide label">Please fill the price field.</label>
            
            <input type="number" name="stock" id="stock" min="0"
            placeholder="Initial Stock" onblur="valStock(this.value)"> 
            <label for="stock" class="stock-err hide label">Please fill the stock field.</label>

            <input type="file" id="img" name="img" accept="image/*" onblur="valImg(this.value);" class="file">
            <div class="file-btn">
                <label for="img" class="file" onclick="getFileName();">Input Image File</label>
                <p id="file-name" class=""></p>
            </div>
            
            
            <label for="img" class="img-err hide">Please input an image for the variant.</label>
            
            <p id="submit-err" class="hide">Please fill all the required fields properly before registering.</p>
                
            <button class="add-button">Add</button>
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
        var stock = document.getElementsByName("stock")[0].value;
        var img = document.getElementsByName("img")[0].value;

        console.log(name == "");
        if (name == "" || desc == "" || price == "" || stock == "" || img == "" || price < 0 || stock < 0){
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


    function valStock(stock){
        var msg = document.querySelector(".stock-err");
        console.log("Masuk");
        if (stock.length == 0 || stock < 0){
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
    ?>


</script>

</body>
</html>


<!-- Dorayaki that tastes like dorayaki. Truly this is the greatest idea of the century! -->