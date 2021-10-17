<?php
  $db = new SQLite3('db/doraemon.db');
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
  // echo "apel";
  $id = $_REQUEST["id"];
  $querySearchData = $db->prepare("select * from dorayaki where id = ?");
  $querySearchData->bindParam(1,$id);
  $searchResult = $querySearchData->execute();
  while ($cek = $searchResult->fetchArray(SQLITE3_ASSOC)){ 
    $data = $cek["stok"];
  }
  echo $data;
} else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  $id = $_POST["idVarian"];
  $jumlah = $_POST["jumlahBarang"];
  $queryUpdateData = $db->prepare("UPDATE dorayaki SET stok = stok + ? WHERE id = ?");
  // CEK ADMIN
  $jumlah = -1*$jumlah; // JIKA PESERTA
  // DO NOTHIN JIKA ADMIN

  $queryUpdateData->bindParam(1,$jumlah);
  $queryUpdateData->bindParam(2,$id);
  $updateResult = $queryUpdateData->execute();
  if ($updateResult){
    echo "success";
    header('Location: '. "pembelianDorayaki.php?id=".$id."&err=0");
  } else {
    header('Location: '. "pembelianDorayaki.php?id=".$id."&err=1");
  }

}
?>