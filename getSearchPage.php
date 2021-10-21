<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  if ($_POST["query"]){
    header('Location: '. "search.php?q=".$_POST["query"]);
  } else {
    header('Location: '. "search.php");
  }
}
?>