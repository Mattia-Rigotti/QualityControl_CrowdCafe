<?php

include "db_connect.php";

$addr = $_POST['url'];
$name = $_POST['name'];
$code_tmp = $_POST['code'];
$code = substr($code_tmp, 5, $code_tmp . length - 2);
$req_id = $_GET['id'];
$request = false;


if ($req_id != "") {
    $request = true;
    /* foreach ($_GET as $key => $value) {
      if (strstr($key, "input_")) {
      $input_names = explode("_", $key);
      $input[$input_names[1]] = $value;
      }
      } */
}

$database = new DB_Connector();
if (!$database->connect()) {
    echo "DB connection error!";
}
/* $directory = "/var/www/html/functions";
  if ($request) {
  $FileName = $req_id . ".txt";
  $FileHandle = fopen($directory . "/" . $FileName, 'r') or die("can't open file");
  $addr = fgets($FileHandle);
  } */

if ($request) {
    $q = "SELECT url FROM Functions WHERE id=$req_id";
    $res = $database->query($q);
    //$res = mysql_query($q);
    $addr = mysql_fetch_assoc($res)["url"];

    $foo = file_get_contents("php://input");
    $input = json_decode($foo, true);
    if ($addr != NULL) {
        $function = file_get_contents($addr);
    } else {
        $q = "SELECT code FROM Functions WHERE id=$req_id";
        $res = $database->query($q);
        $function = mysql_fetch_assoc($res)["code"];
    }

    function main($input, $function) {
        eval($function);
    }

    $result = main($input, $function);
    print $result;
} else {

    //echo "prova";
    $q = "SELECT MAX(id) FROM Functions";
    $res = $database->query($q);
    //$res = mysql_query($q);
    $max_id = mysql_fetch_assoc($res)["MAX(id)"];
    print "Function id: " . $max_id;

    /* $filelist = scandir($directory, $sorting_order = SCANDIR_SORT_ASCENDING);
      $max_id_arr = explode(".", end($filelist));
      $max_id = $max_id_arr[0];
      $FileName = ((int) $max_id + 1) . ".txt";
      $FileHandle = fopen($directory . "/" . $FileName, 'w') or die("can't open file");
      $txt = $addr . "\n" . $result;
      fwrite($FileHandle, $txt);
      fclose($FileHandle); */
    if ($addr != "") {
        $q = "INSERT INTO Functions(url,name) VALUES ('$addr','$name')";
        //mysql_query($q);
        $database->query($q);
    } else {
        $code = addslashes($code);
        $q = "INSERT INTO Functions(name,code) VALUES ('$name','$code')";
        //mysql_query($q);
        $database->query($q);
    }
    header("Location: index.php");
}

$database->disconnect();
//print $addr."\n";
//print $function."\n";
//$ex = exec("php -r '$function'");
?>
