<?php
  $db = new SQLite3('db/doraemon.db');
  if (isset($_POST['page'])){
    $halaman = $_POST['page'];
  } else {
    $halaman = 1;
  }  
  if (isset($_POST['query'])){
    $querySearchData = $db->prepare("select * from dorayaki where nama LIKE ? LIMIT 8 OFFSET ?");
    $query = '%'.$_POST['query'].'%';
    $querySearchData->bindParam(1,$query);
    $offset = ($halaman-1)*8;
    $querySearchData->bindParam(2,$offset);
    $searchResult = $querySearchData->execute();
    
    $queryJumlahData = $db->prepare("select COUNT(*) from dorayaki where nama LIKE ?");
    $queryJumlahData->bindParam(1,$query);
    $jumlahData = $queryJumlahData->execute();
    $jumlahData = $jumlahData->fetchArray(SQLITE3_NUM);
    $jumlahData = $jumlahData[0];

  }else{
    $querySearchData = $db->prepare("select * from dorayaki LIMIT 8 OFFSET ?");
    $offset = ($halaman-1)*8;
    $querySearchData->bindParam(1,$offset);
    $searchResult = $querySearchData->execute();
    
    $queryJumlahData = $db->prepare("select COUNT(*) from dorayaki");
    $jumlahData = $queryJumlahData->execute();
    $jumlahData = $jumlahData->fetchArray(SQLITE3_NUM);
    $jumlahData = $jumlahData[0];    
  }

  // PAGINATION
  $total_page = ceil($jumlahData/8);
	$previous_link = '';
	$next_link = '';
	$page_link = '';

  // $page_link += '<div class="pagination justify-content-center">';
  $previous_id = $halaman - 1;
  if ($previous_id > 0){
    $page_link .= '<div class="option"><a href="javascript:load_data('.$previous_id.')">Previous</a></div>';
  } else{
    $page_link .= '<div class="option disabled"><a href="">Previous</a></div>';
  }
  if ($total_page <= 3){
    $number = 1;
  }else{
    if ($halaman % 3 == 1){
      $number = $halaman;
    } else if ($halaman % 3 == 2){
      $number = $halaman -1;
    }else{
      $number = $halaman -2;
    }
  }
  for($x=$number; $x <= $total_page && $x-$number < 3;$x++){
    if ($x == $halaman){
      $page_link .= '<div class="option active"><a href="javascript:load_data('.$x.')">'.$x.'</a></div>';
    } else {
      $page_link .= '<div class="option"><a href="javascript:load_data('.$x.')">'.$x.'</a></div>';
    }
  }
  $next_id = $halaman + 1;
  if ($next_id == $total_page + 1){
    $page_link .= '<div class="option disabled"><a href="">Next</a></div>';
  } else{
    $page_link .= '<div class="option"><a href="javascript:load_data('.$next_id.')">Next</a></div>';
  }
  // $page_link += '</div>';





  $data = [];
  while ($cek = $searchResult->fetchArray(SQLITE3_ASSOC)){ 
    array_push($data,$cek);
  }
  $output = array(
    'data' => $data,
    'pagination' => $page_link,
    'debug' => $jumlahData
  );
  echo json_encode($output)

?>