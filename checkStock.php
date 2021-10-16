<?php
$id = $_REQUEST["id"];
$db = new SQLite3('db/doraemon.db');
$querySearchData = $db->prepare("select * from dorayaki where id = ?");
$querySearchData->bindParam(1,$id);
$searchResult = $querySearchData->execute();
while ($cek = $searchResult->fetchArray(SQLITE3_ASSOC)){ 
  $data = $cek["stok"];
}
echo $data;
?>