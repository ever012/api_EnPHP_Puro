<?php
//post
$url = "https://nodejs-mysql-restapi-test-production-ee31.up.railway.app/api/employees";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url . "/".$_GET['id']);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');//metod patch
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //le digo que voy a enviar un json
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

if(curl_errno($curl))
{
    echo curl_error($curl);
}else
{
    $encoded = json_decode($response, true);
}

echo $encoded;

curl_close($curl);
$host  = "http://".$_SERVER['HTTP_HOST']."/apiEnPHPPuro";
header("Location: $host/index.php", TRUE, 301);
exit();
?>