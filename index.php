<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form action="exec.php" method="POST">
            Insert function gist url: <input type="text" name="url"><br>
            <input type="submit" value="Submit">           
        </form>
        <?php
        if (false) {
            print ("Hello ");
            $output = [];
            $ret = exec("php random.php"/* , $output */);
            //$ret = exec("whoami");

            /* for ($i = 0; $i < sizeof($output); $i++) {
              print ($output[$i]."\n");
              } */
            //print (sizeof($output));
            //print ($output[1]);
            print ($ret);
        }
        ?>
    </body>
</html>
