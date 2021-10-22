<?php
$id = $_POST["delete"];
$db = new SQLite3('db/doraemon.db');
$queryDeleteVariant = $db->prepare("DELETE FROM dorayaki WHERE id = ?");
$queryDeleteVariant->bindParam(1,$id);
$deleteResult = $queryDeleteVariant->execute();
$db->close();
if ($deleteResult){
    header('Location: '. "index.php");
}
else{
    header('Location: '. "pembelianDorayaki.php?id=".$id."&err=2");
}
?>