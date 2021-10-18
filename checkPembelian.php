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
  $queryUpdateData = $db->prepare("UPDATE dorayaki SET stok = stok - ? WHERE id = ?");
  $queryUpdateTotalPenjualan = $db->prepare("UPDATE dorayaki SET total_penjualan = total_penjualan + ? WHERE id = ?");

  $queryUpdateData->bindParam(1,$jumlah);
  $queryUpdateTotalPenjualan->bindParam(1,$jumlah);
  $queryUpdateData->bindParam(2,$id);
  $queryUpdateTotalPenjualan->bindParam(2,$id);
  $updateResult = $queryUpdateData->execute();
  $updateTotalPenjualanResult = $queryUpdateTotalPenjualan->execute();
  if ($updateResult && $updateTotalPenjualanResult){
    echo "success";
    header('Location: '. "pembelianDorayaki.php?id=".$id."&err=0");
  } else {
    header('Location: '. "pembelianDorayaki.php?id=".$id."&err=1");
  }

}
?>