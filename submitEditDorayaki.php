<?php
  if (isset($_POST)){
    $db = new SQLite3('db/doraemon.db');
    // $nama = $_POST['nama'];
    $id = $_POST['id'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $img = false;
    if ($_FILES["img"]["tmp_name"]){
      $img = getimagesize($_FILES["img"]["tmp_name"]);
    }
    if ($img){
      $target_dir = "db/img/";
      $target_file = $target_dir . $id . ".";
      $imageFileType = strtolower(pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION));
      $target_file .= $imageFileType;
      move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
      $queryEditDorayaki = $db->prepare("UPDATE dorayaki SET harga = ?, deskripsi = ?, gambar=? WHERE id=?");
      $queryEditDorayaki->bindParam(1, $harga);
      $queryEditDorayaki->bindParam(2, $deskripsi);
      $queryEditDorayaki->bindParam(3, $target_file);
      $queryEditDorayaki->bindParam(4, $id);
      $hasilEditDorayaki = $queryEditDorayaki->execute();
    }
    else{
      $queryEditDorayaki = $db->prepare("UPDATE dorayaki SET harga = ?, deskripsi = ? WHERE id=?");
      $queryEditDorayaki->bindParam(1, $harga);
      $queryEditDorayaki->bindParam(2, $deskripsi);
      $queryEditDorayaki->bindParam(3, $id);
      $hasilEditDorayaki = $queryEditDorayaki->execute();
    }
    if($hasilEditDorayaki){
      header('Location: '. "editDorayaki.php?id=".$id."&err=0");
    } else{
      header('Location: '. "editDorayaki.php?id=".$id."&err=1");
    }
    $db->close();
  }
?>