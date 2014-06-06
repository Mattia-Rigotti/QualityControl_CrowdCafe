<?php

$addr = $_POST['url'];
$req_id = $_GET['id'];
$request = false;


if ($req_id != "") {
    $request = true;
    foreach ($_GET as $key => $value) {
        if (strstr($key, "input_")) {
            $input_names = explode("_", $key);
            $input[$input_names[1]] = $value;
        }
    }
} else {
    $input = ['n1' => 2, 'n2' => 3];
}
//print $addr."\n";
//print $function."\n";
//$ex = exec("php -r '$function'");
$directory = "/var/www/html/functions";
if ($request) {
    $FileName = $req_id . ".txt";
    $FileHandle = fopen($directory . "/" . $FileName, 'r') or die("can't open file");
    $addr = fgets($FileHandle);
}
$function = file_get_contents($addr);
eval($function);
//print $ex;
$result = main($input);
print $result;
if (!$request) {
    $filelist = scandir($directory, $sorting_order = SCANDIR_SORT_ASCENDING);
    $max_id_arr = explode(".", end($filelist));
    $max_id = $max_id_arr[0];
    $FileName = ((int) $max_id + 1) . ".txt";
    $FileHandle = fopen($directory . "/" . $FileName, 'w') or die("can't open file");
    $txt = $addr . "\n" . $result;
    fwrite($FileHandle, $txt);
    fclose($FileHandle);
}
?>
