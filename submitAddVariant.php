<?php
$name = $_POST["nama"];
$desc = $_POST["deskripsi"];
$price = $_POST["harga"];
$stock = $_POST["stock"];




echo $name . "<br>";
echo $desc . "<br>";
echo $price . "<br>";
echo $stock . "<br>";  


if ($name and $desc and $price and $stock){
    $valName = false;
    $valDesc = false;
    $valPrice = false;
    $valStock = false;
    



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

    if ($valName and $valPrice and $valDesc and $valStock){
        echo "yey";
        $db = new SQLite3('db/doraemon.db');

        if(!$db) {
            echo "Error opening database";
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
            
            echo $imageFileType . "<br>";
            echo $_FILES["img"]["name"] . "<br>";
            foreach($img as $x => $x_value) {
                echo "Key=" . $x . ", Value=" . $x_value;
                echo "<br>";
              }

            $valImg = false;
            $img = getimagesize($_FILES["img"]["tmp_name"]);
            if ($img){
                $prep = $db->prepare("INSERT INTO dorayaki(nama, deskripsi, harga, stok, gambar) VALUES (?, ?, ?,?,?)");
                $prep->bindParam(1, $name);
                $prep->bindParam(2, $desc);
                $prep->bindParam(3, $price);
                $prep->bindParam(4, $stock);
                $prep->bindParam(5, $path);
                $path = $target_file;
                $res = $prep->execute();
                if(!$res) {
                    echo $db->lastErrorMsg();
                } else {
                        echo "Data Inserted";
                }


                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {

                    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }

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