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
        <div class="container">
            <div id="header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">

                            <form class="form-inline signup" role="form" action="exec.php" method="POST">
                                <div class="form-group">
                                    <h2 >Select a name for the function: </h2>
                                    <input type="text" name="name" class="form-control"><br>
                                    <h2 >Insert function's gist url: </h2>
                                    <input type="text" name="url" class="form-control" ><br>
                                    <h2 >Or write the code here (no more than 1000 characters): </h2>
                                    <p><textarea rows="10" cols="200" name="code" id="codeTextArea"><?php echo "<?php\n\n?>"; ?></textarea></p>
                                    <script>
                                        var codeTextArea = document.getElementById("codeTextArea");
                                        var editor = CodeMirror.fromTextArea(codeTextArea, {
                                            lineNumbers: true,
                                            matchBrackets: true,
                                            mode: "application/x-httpd-php",
                                            indentUnit: 4,
                                            indentWithTabs: true
                                        });
                                    </script>
                                </div>
                                <br/><button type="submit" class="btn btn-theme" value="submit">Submit</button>          
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
                        </div>
                        <!--<div class="col-lg-4 col-lg-offset-2">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                </ol>					
                        <!-- slides -->
                        <!--<div class="carousel-inner">
                            <div class="item active">
                                <img src="assets/img/slide1.png" alt="">
                            </div>
                            <div class="item">
                                <img src="assets/img/slide2.png" alt="">
                            </div>
                            <div class="item">
                                <img src="assets/img/slide3.png" alt="">
                            </div>
                        </div>
                    </div>		
                </div>-->

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
