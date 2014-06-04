<?php

$addr = $_POST['url'];
$input = ['n1'=>2,'n2'=>3];
//print $addr."\n";
$function = file_get_contents($addr);
//print $function."\n";
//$ex = exec("php -r '$function'");
eval($function);
//print $ex;
print main($input);
?>
