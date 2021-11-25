<?php
$name = $_POST["nama"];
$desc = $_POST["deskripsi"];
$price = $_POST["harga"];
$stock = $_POST["stock"];
$recipe = $_POST["recipe"];
if ($name and $desc and $price and $stock and $recipe){
    $valName = false;
    $valDesc = false;
    $valPrice = false;
    $valStock = false;
    $valRecipe = false;

    if ($name != ""){
        $valName = true;
    }

    if ($desc != ""){
        $valDesc = true;
    }

    if ($price != "" and $price >= 0){
        $valPrice = true;
    }

    if ($stock != "" and $stock >= 0){
        $valStock = true;
    }
    if ($recipe != ""){
        $valRecipe = true;
    }

    if ($valName and $valPrice and $valDesc and $valStock){
        $db = new SQLite3('db/doraemon.db');

        if(!$db) {
            // echo "Error opening database";
         } else {
            $res = $db->query("SELECT COUNT(1) from dorayaki");
            while($row = $res->fetchArray()) {
                $lastrow = $row["COUNT(1)"] + 1;
            }
         }
            $target_dir = "db/img/";
            $target_file = $target_dir . $lastrow . ".";
            $imageFileType = strtolower(pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION));
            $target_file .= $imageFileType;

            $valImg = false;
            $img = getimagesize($_FILES["img"]["tmp_name"]);
            if ($img){
                $prep = $db->prepare("INSERT INTO dorayaki(nama, deskripsi, harga, stok, gambar, id_recipe) VALUES (?, ?, ?,?,?, ?)");
                $prep->bindParam(1, $name);
                $prep->bindParam(2, $desc);
                $prep->bindParam(3, $price);
                $prep->bindParam(4, $stock);
                $prep->bindParam(5, $path);
                $prep->bindParam(6, $recipe);
                $path = $target_file;
                $res = $prep->execute();
                move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                $db->close();
                header('Location: '. "addVariant.php?err=0");
            } else{
                header('Location: '. "addVariant.php?err=1");
            }
    } else{
        header('Location: '. "addVariant.php?err=1");
    }
} else{
    header('Location: '. "addVariant.php?err=1");
}

?>