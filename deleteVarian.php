<?php
$id = $_POST["delete"];
$db = new SQLite3('db/doraemon.db');
$queryDeleteVariant = $db->prepare("DELETE FROM dorayaki WHERE id = ?");
$queryDeleteRiwayatVariant = $db->prepare("DELETE FROM riwayat WHERE id_varian = ?");
$queryDeleteVariant->bindParam(1,$id);
$queryDeleteRiwayatVariant->bindParam(1,$id);
$deleteResult = $queryDeleteVariant->execute();
$deleteRiwayatResult = $queryDeleteRiwayatVariant->execute();
$db->close();
if ($deleteResult && $deleteRiwayatResult){
    header('Location: '. "index.php");
}
else{
    header('Location: '. "pembelianDorayaki.php?id=".$id."&err=2");
}
?>