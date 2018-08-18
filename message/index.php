<?php
include '../config.php';

$callback = NULL;

if (isset($_POST["d"])) {
    $d = $_POST["d"];
}
else {
    if (isset($_GET["callback"])) {
    $callback= $_GET["callback"];
    }
    $d = $_GET["d"];
}

if (strpos($rscript_exec, " ") !== 0) {
    $rscript_exec = '"' . $rscript_exec . '"';
}


// 把$d寫入檔案
$filename = tempnam(sys_get_temp_dir(), "rscript");
file_put_contents($filename, $d);
exec($rscript_exec . " " . $filename, $output);

//$result = json_encode($d);
$result = $output;


if (is_null($callback)) {
    header('Content-Type: text/plain; charset=utf-8');
    echo implode("\n", $result);
    
    //echo $d;
}
else {
    $result = json_encode($result);
    header('Content-Type: application/json; charset=utf-8');
    echo $callback.'(' . $result .');';
}