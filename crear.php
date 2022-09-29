<?php
//post
$url = "https://nodejs-mysql-restapi-test-production-ee31.up.railway.app/api/employees";

$curl = curl_init();

$array = json_encode(["name" => $_POST['nombre'],"salary" => $_POST['salario']]);
//$data = http_build_query($array); //ESTO SOLO FUNCIONA CON ARREGLOS PEOR NO CON JSON'S, va a transformar como si fuera parte de una peticion http los datos
//var_dump($array);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);//metod post
curl_setopt($curl, CURLOPT_POSTFIELDS, $array); //enviar datos
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

foreach ($encoded as $indice => $valor) {
    echo "$indice: $valor <br>";
}

curl_close($curl);

header("Location: index.php", TRUE, 301);
exit();
?>