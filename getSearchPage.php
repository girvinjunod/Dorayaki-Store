<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
  if ($_GET["query"]){
    header('Location: '. "search.php?q=".$_GET["query"]);
  } else {
    header('Location: '. "search.php");
  }
}
?>