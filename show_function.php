<?php
include "db_connect.php";
$database = new DB_Connector();
if (!$database->connect()) {
    echo "DB connection error!";
}
$gist = false;
$id = $_GET['id'];

$q = "SELECT * FROM Functions WHERE id=$id";
$res = $database->query($q);
$data = mysql_fetch_assoc($res);
$function_addr = $data["url"];
$function_name = $data["name"];
$function_call = "http://80.240.134.86/exec.php?id=$id";
if ($function_addr != "") {
    $function_code = file_get_contents($function_addr);
    $gist = true;
} else {
    $function_code = $data["code"];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>CrowdCafe Quality Control</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/desktop/bootstrap.css" media="screen">
        <link rel="stylesheet" href="css/desktop/bootswatch.min.css">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
          <script src="../bower_components/respond/dest/respond.min.js"></script>
        <![endif]-->
        <!-- Create a simple CodeMirror instance -->
        <link rel="stylesheet" href="lib/codemirror/lib/codemirror.css">
        <script src="lib/codemirror/lib/codemirror.js"></script>
        <script src="lib/codemirror/mode/php/php.js"></script>
        <script src="lib/codemirror/mode/htmlmixed/htmlmixed.js"></script>
        <script src="lib/codemirror/mode/xml/xml.js"></script>
        <script src="lib/codemirror/mode/javascript/javascript.js"></script>
        <script src="lib/codemirror/mode/css/css.js"></script>
        <script src="lib/codemirror/mode/clike/clike.js"></script>

    </head>
    <body>
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="../" class="navbar-brand">CrowdCafe Quality Control</a>
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="bs-docs-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <h2 id="nav-tabs"><?php echo $function_name; ?></h2>
                        <div class="bs-component">
                            <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                                <li class="active" id="li_info"><a href="#info" data-toggle="tab">Info</a></li>
                                <li id="li_code"><a href="#code" data-toggle="tab" >Code</a></li>
                                <li id="li_url"><a href="#url" data-toggle="tab">CrowdCafe URL</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade active in" id="info">
                                    <p>ID: <?php echo $id; ?>
                                        <BR/> Gist URL: <?php if ($gist) echo $function_addr; else echo "Nope!"; ?></p>
                                </div>
                                <div class="tab-pane fade" id="code">
                                    CODE:<BR/>
                                    <p><textarea rows="10" cols="200" id="codeTextArea"><?php echo "<?php\n" . $function_code . "\n?>"; ?></textarea></p>
                                    <script>
                                        var codeTextArea = document.getElementById("codeTextArea");
                                        var editor = CodeMirror.fromTextArea(codeTextArea, {
                                            lineNumbers: true,
                                            matchBrackets: true,
                                            mode: "application/x-httpd-php",
                                            indentUnit: 4,
                                            readOnly: true,
                                            indentWithTabs: true
                                        });
                                    </script>
                                </div>
                                <div class="tab-pane fade" id="url">
                                    <p><?php echo $function_call; ?></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <?php
        ?>    





        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootswatch.js"></script>
    </body>
</html>