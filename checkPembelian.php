<?php
  session_start();
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
  $queryUpdateRiwayat = $db->prepare("INSERT INTO riwayat(id_varian, varian, username, harga, perubahan) VALUES(?, ?, ?, ?, ?)");

  $queryUpdateRiwayat->bindParam(1, $id);
  $queryUpdateRiwayat->bindParam(2, $namavarian);
  $queryUpdateRiwayat->bindParam(3, $uname);
  $queryUpdateRiwayat->bindParam(4, $harga);
  $queryUpdateRiwayat->bindParam(5, $perubahan);

  $ambildata = $db->prepare("select * from dorayaki where id = ?");
  $ambildata->bindParam(1, $id);
  $datavarian = $ambildata->execute();
  while($row = $datavarian->fetchArray(SQLITE3_ASSOC)) {
    $namavarian = $row["nama"];
    $harga = $row["harga"] * $jumlah;
  }
  
  $uname = $_SESSION["username"];
  $perubahan = -1 * $jumlah;

  $queryUpdateData->bindParam(1,$jumlah);
  $queryUpdateTotalPenjualan->bindParam(1,$jumlah);
  $queryUpdateData->bindParam(2,$id);
  $queryUpdateTotalPenjualan->bindParam(2,$id);
  echo "$namavarian";
  echo "$harga";
  echo "$perubahan";
  $updateRiwayat = $queryUpdateRiwayat->execute();
  $updateResult = $queryUpdateData->execute();
  $updateTotalPenjualanResult = $queryUpdateTotalPenjualan->execute();
  if ($updateResult && $updateTotalPenjualanResult && $updateRiwayat){
    echo "success";
    header('Location: '. "pembelianDorayaki.php?id=".$id."&err=0");
  } else {
    header('Location: '. "pembelianDorayaki.php?id=".$id."&err=1");
  }

}
$db->close();
?>