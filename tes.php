<?php 
//Create the client object
$soapclient = new SoapClient('http://localhost:8080/webservice/apelmanggakucing?wsdl');

// $response = $soapclient->getAllRecipe();
// String ip, String endpoint, int id_recipe, int count_request
$params = array('arg0' => '127.0.0.1:4040', 'arg1' => 'http://localhost:8080/webservice/apelmanggakucing', 'arg2'=>1, 'arg3'=>69);
$response = $soapclient->addRequest($params);
var_dump($response);


?>