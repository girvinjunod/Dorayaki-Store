<?php
  session_start();
  if (isset($_POST)){
    $db = new SQLite3('db/doraemon.db');
    $nama = $_POST['nama'];
    echo $nama;
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $queryEditDorayaki = $db->prepare("UPDATE dorayaki SET nama = ?, harga = ?, deskripsi = ? WHERE id=?");
    $queryEditDorayaki->bindParam(1, $nama);
    $queryEditDorayaki->bindParam(2, $harga);
    $queryEditDorayaki->bindParam(3, $deskripsi);
    $queryEditDorayaki->bindParam(4, $id);
    $hasilEditDorayaki = $queryEditDorayaki->execute();
    if($hasilEditDorayaki){
      header('Location: '. "editDorayaki.php?id=".$id."&err=0");
    } else{
      header('Location: '. "editDorayaki.php?id=".$id."&err=1");
    }
    $db->close();
  }
?>