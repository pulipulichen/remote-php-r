<?php

$rscript = file_get_contents("demo.R");

$remote_api_url = "http://localhost/remote-php-r/message/?";

//$remote_api_url = "index.php?";

//$rscript = urlencode($rscript);
//echo $remote_api_url."?d=".$rscript;
//echo function_exists("curl_init");


$ch = curl_init($remote_api_url);

curl_setopt($ch, CURLOPT_POST, 1);
 //http_build_query( array( "a"=>"123", "b"=>"321") 
$params = array(
    //"d" => $rscript
    "d" => $rscript
);
//print_r($params);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
//echo http_build_query($params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result = trim($result);
curl_close($ch);
//echo "aaaa";

//echo $rscript;

echo $result;
echo " ";