<?php

function updateDatabase($db,$id_recipe,$change){
  
  $ambildata = $db->prepare("select * from dorayaki where id_recipe = ?");
  $ambildata->bindParam(1, $id_recipe);
  $datavarian = $ambildata->execute();
  while($row = $datavarian->fetchArray(SQLITE3_ASSOC)) {
    $namavarian = $row["nama"];
    $harga = $row["harga"] * $change;
    $data = $row["stok"];
    $id = $row["id"];
  }

  $queryUpdateData = $db->prepare("UPDATE dorayaki SET stok = stok + ? WHERE id_recipe = ?");
  $queryUpdateRiwayat = $db->prepare("INSERT INTO riwayat(id_varian, varian, username, perubahan) VALUES(?, ?, ?, ?)");

  $queryUpdateData->bindParam(1,$change);
  $queryUpdateData->bindParam(2,$id_recipe);

  $queryUpdateRiwayat->bindParam(1, $id);
  $queryUpdateRiwayat->bindParam(2, $namavarian);
  $uname = "Admin";
  $queryUpdateRiwayat->bindParam(3, $uname);
  $queryUpdateRiwayat->bindParam(4, $change);       
  $updateRiwayat = $queryUpdateRiwayat->execute();
  $updateResult = $queryUpdateData->execute();
}
try{
  // $db = new SQLite3('/mnt/d/Kuliah/Semester5/WBD/tubes2/dorayaki-store/db/doraemon.db'); // CHANGE TO FULL PATH
  $db = new SQLite3('/mnt/d/coding/wbd/tubes2/dorayaki-store/db/doraemon.db');
  $soapclient = new SoapClient('http://localhost:8080/webservice/apelmanggakucing/?wsdl');
  $ip_server = '127.0.0.1';
  // $ip_port = $_SERVER['SERVER_PORT'];
  $ip_data = $ip_server;
  $params = array('arg0'=> $ip_data);
  $response = $soapclient->getStatusRequest($params);
  // var_dump($response);
  // print_r($response)
  $is_empty = true;
  $newarray = array();
  foreach ($response as $value) {
    $newarray = $value;
    $is_empty = false;
  }
  if (is_array($newarray)){
    foreach ($newarray as $value) {
      $seperatedData = explode(';',$value);
      $id_recipe = $seperatedData[0];
      $change = $seperatedData[1];
      updateDatabase($db,$id_recipe ,$change);
    }  
  } else if (!$is_empty) {
      $seperatedData = explode(';',$newarray);
      $id_recipe = $seperatedData[0];
      $change = $seperatedData[1];
      updateDatabase($db,$id_recipe ,$change);
  } else {
    return;
  }
} catch (Exception $e){
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
// try{
//   foreach ($newarray as $value) {
//     $seperatedData = explode(';',$value);
//     $id_recipe = $seperatedData[0];
//     $change = $seperatedData[1];
//   }
// } catch (Exception $e){
//   echo 'Caught exception: ',  $e->getMessage(), "\n";
// }

?>