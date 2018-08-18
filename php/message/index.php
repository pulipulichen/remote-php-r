<?php
include '../config.php';

if (strpos($rscript_exec, " ") !== 0) {
    $rscript_exec = '"' . $rscript_exec . '"';
}

header('Content-Type: application/json; charset=utf-8');
$callback = $_GET["callback"];
$d = $_GET["d"];

// 把$d寫入檔案
$filename = tempnam(sys_get_temp_dir(), "rscript");
file_put_contents($filename, $d);
exec($rscript_exec . " " . $filename, $output);

//$result = json_encode($d);
$result = $output;
$result = json_encode($result);

echo $callback.'(' . $result .');';
//echo $_GET["d"];
//echo 1;