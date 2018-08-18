<?php
include '../config.php';

if (strpos($rscript_exec, " ") !== 0) {
    $rscript_exec = '"' . $rscript_exec . '"';
}

header('Content-Type: application/json; charset=utf-8');
$callback = $_GET["callback"];
$d = $_GET["d"];

// 處理圖片的檔案
$plotname = tempnam(sys_get_temp_dir(), "rplot");

// 把$d寫入檔案
$filename = tempnam(sys_get_temp_dir(), "rscript");
file_put_contents($filename, $d);
exec($rscript_exec . " " . $filename . " " . $plotname , $output);

$pic=file_get_contents($plotname);//讀取圖片
$type=getimagesize($plotname);//取得圖片資訊
$file_content=base64_encode($pic);//base64編碼
switch($type[2]){//判斷圖片的類型
    case 1:$img_type="gif";break;  
    case 2:$img_type="jpg";break;  
    case 3:$img_type="png";break;  
}  
$img='data:image/'.$img_type.';base64,'.$file_content;//data url 格式

//$result = json_encode($d);
$result = $img;
$result = json_encode($result);

echo $callback.'(' . $result .');';
//echo $_GET["d"];
//echo 1;