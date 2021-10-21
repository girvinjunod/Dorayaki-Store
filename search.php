<?php
if(!isset($_COOKIE['username'])) {
  header('Location: '. "login.php");
}
else{
  $db = new SQLite3('db/doraemon.db');
  $prep = $db->prepare('SELECT * from login where token=:token ORDER BY id_login desc LIMIT 1');
  $token = $_COOKIE['username'];
  $prep->bindParam(':token', $token);
  $rescookie = $prep->execute();
  $valid = 0;
  while($rowcookie = $rescookie->fetchArray(SQLITE3_ASSOC)) {
      $valid = 1;
      if (time() - $rowcookie['time'] > 300){
          $valid = 0;
      }
  }
  if (!$valid){
      setcookie("username", "", time() - 3600);
      header('Location: '. "login.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/style.css">
  <!-- <link rel="stylesheet" href="assets/global.css"> -->
  <link rel="stylesheet" href="assets/itemlist.css">
  <link rel="stylesheet" href="assets/search.css">
  <title>Search Result</title>
</head>
<body>
<script>
      function load_data(page_number){
        var form_data = new FormData();
        query = '<?php 
        if(isset($_GET['q'])){
          echo $_GET['q'] ;
        }
        ?>';
        if (query){
          form_data.append('query', query);
        }
        form_data.append('page', page_number);
        var req = new XMLHttpRequest();
        req.open('POST','getSearchData.php');
        req.send(form_data);
        req.onload = function(){
          
          var data = JSON.parse(this.responseText);
          console.log(data.debug);
          const dataItem = data.data
          var input = '';
          for(var count = 0; count < dataItem.length; count++)
            {
              input += '<div class="card">';
              input += '<img src="'+ dataItem[count]["gambar"]+'">';
              input += '<div class="card-content">';
              input += '<div class="title"><h6>'+(dataItem[count]["nama"].slice(0,15) + (dataItem[count]["nama"].length > 15 ? "..." : ""))+'</h6></div>';
              input += '<div class="subtitle"><h6>Rp. '+dataItem[count]["harga"]+'</h6></div>';
              input += '<div class="content"><h6>'+(dataItem[count]["deskripsi"].slice(0,100) + (dataItem[count]["deskripsi"].length > 100 ? "..." : ""))+'</h6></div>';
              input += '<a href="detailDorayaki.php?id='+dataItem[count]["id"]+'"><button class="primary-button">BUY</button></a>'
              input += '</div>';
              input += '</div>';
            }
          if (input == ''){
            input = "<div class='no-result'>"
            input += "<img src='assets/img/doraemon-err.png' alt='doraemon nangis'>"
            input += "<h1 class='not-found'>Product not Found</h1>"
            input += "</div>"
          }
          document.getElementById('itemData').innerHTML = input;
          document.getElementById('paginationData').innerHTML = data.pagination;
        }
      }
    </script>  
  <script>
    load_data(1)
  </script>
<?php
include "component/header.php";
?>
<div class="card-container">
      <h1 class="search-result">Search Result</h1>
        <div class="card-list" id="itemData">

        </div>
      <div class="pagination justify-content-center" id="paginationData">

      </div>        
</div>

</body>
</html>

