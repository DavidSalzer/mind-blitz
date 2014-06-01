<?php
$data=json_decode(file_get_contents('php://input'));
$url='img/'. sha1( microtime()).'.png';
file_put_contents($url, base64_decode($data->imgBase64));

echo '{"url":"'.$url.'"}';