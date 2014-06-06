<?php

$addr = $_POST['url'];
$input = ['n1' => 2, 'n2' => 3];
//print $addr."\n";
$function = file_get_contents($addr);
//print $function."\n";
//$ex = exec("php -r '$function'");
eval($function);
//print $ex;
$result = main($input);
print $result;
$directory = "/var/www/html/functions";
$filelist = scandir($directory, $sorting_order = SCANDIR_SORT_ASCENDING);
$max_id_arr = explode(".", end($filelist));
$max_id = $max_id_arr[0];
$FileName = ((int) $max_id + 1) . ".txt";
$FileHandle = fopen($directory."/".$FileName, 'w') or die("can't open file");
$txt = $addr . "\n" . $result;
fwrite($FileHandle, $txt);
fclose($FileHandle);
?>
