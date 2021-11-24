<?php
  $db = new SQLite3('db/doraemon.db');
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
  $id = $_REQUEST["id"];
  $querySearchData = $db->prepare("select * from dorayaki where id = ?");
  $querySearchData->bindParam(1,$id);
  $searchResult = $querySearchData->execute();
  while ($cek = $searchResult->fetchArray(SQLITE3_ASSOC)){ 
    $data = $cek["stok"];
  }
  echo $data;
} else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
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
    $id = $_POST["idVarian"];
    $jumlah = $_POST["jumlahBarang"];
    $ambildata = $db->prepare("select * from dorayaki where id = ?");
    $ambildata->bindParam(1, $id);
    $datavarian = $ambildata->execute();
    while($row = $datavarian->fetchArray(SQLITE3_ASSOC)) {
      $namavarian = $row["nama"];
      $harga = $row["harga"] * $jumlah;
      $data = $row["stok"];
    }
  if (!$isAdmin){
    if ($jumlah > $data || $jumlah == 0){
      header('Location: '. "pembelianDorayaki.php?id=".$id."&err=1");
    } else {
      $queryUpdateData = $db->prepare("UPDATE dorayaki SET stok = stok - ? WHERE id = ?");
      $queryUpdateTotalPenjualan = $db->prepare("UPDATE dorayaki SET total_penjualan = total_penjualan + ? WHERE id = ?");
      $queryUpdateRiwayat = $db->prepare("INSERT INTO riwayat(id_varian, varian, username, harga, perubahan) VALUES(?, ?, ?, ?, ?)");
    
      $queryUpdateRiwayat->bindParam(1, $id);
      $queryUpdateRiwayat->bindParam(2, $namavarian);
      $queryUpdateRiwayat->bindParam(3, $uname);
      $queryUpdateRiwayat->bindParam(4, $harga);
      $queryUpdateRiwayat->bindParam(5, $perubahan);
    

      $perubahan = -1 * $jumlah;
    
      $queryUpdateData->bindParam(1,$jumlah);
      $queryUpdateTotalPenjualan->bindParam(1,$jumlah);
      $queryUpdateData->bindParam(2,$id);
      $queryUpdateTotalPenjualan->bindParam(2,$id);
      // echo "$namavarian";
      // echo "$harga";
      // echo "$perubahan";
      $updateRiwayat = $queryUpdateRiwayat->execute();
      $updateResult = $queryUpdateData->execute();
      $updateTotalPenjualanResult = $queryUpdateTotalPenjualan->execute();
      if ($updateResult && $updateTotalPenjualanResult && $updateRiwayat){
        if($jumlah==$data){
          header('Location: '. "detailDorayaki.php?id=".$id."&err=0");
        }
        else{
          header('Location: '. "pembelianDorayaki.php?id=".$id."&err=0");
        }
      } else {
        header('Location: '. "pembelianDorayaki.php?id=".$id."&err=1");
      }
    }
  } else {

        if ($jumlah*-1 > $data || $jumlah <= 0){ // TODO: Bisa negatif?
          header('Location: '. "pembelianDorayaki.php?id=".$id."&err=1");
        } else {
            $soapclient = new SoapClient('http://localhost:8080/webservice/apelmanggakucing?wsdl');
            $ip_server = $_SERVER['REMOTE_ADDR'];
            $ip_port = $_SERVER['SERVER_PORT'];
            $ip_data = $ip_server.':'.$ip_port;

            $ambildata = $db->prepare("select * from dorayaki where id = ?");
            $ambildata->bindParam(1, $id_recipe);
            $datavarian = $ambildata->execute();
            while($row = $datavarian->fetchArray(SQLITE3_ASSOC)) {
              $id_recipe = $row["id_recipe"];
            }

            $params = array('arg0' => $ip_data, 'arg1' => 'http://localhost:8080/webservice/apelmanggakucing', 'arg2'=>$id_recipe, 'arg3'=>$jumlah);
            $response = $soapclient->addRequest($params);
            foreach ($response as $value){
              $newdata = $value;
            }
            if ($newdata == '1'){
              header('Location: '. "pembelianDorayaki.php?id=".$id."&err=0");
            } else {
              header('Location: '. "pembelianDorayaki.php?id=".$id."&err=1");
            }
        
          }
      }
}
$db->close();
?>
