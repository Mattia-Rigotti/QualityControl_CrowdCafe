<?php
include "db_connect.php";
$database = new DB_Connector();
if (!$database->connect()) {
    echo "DB connection error!";
}
$MAX_F_PER_PAGE = 5;
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
        <link rel="stylesheet" type="text/css" href="/css/jquery.multiscroll.css" />		
        <link rel="stylesheet" type="text/css" href="/css/examples.css" />	
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript" src="/js/jquery.easings.min.js"></script>
        <script type="text/javascript" src="/js/jquery.multiscroll.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#container').multiscroll({
                    sectionsColor: ['#272b30', '#272b30', '#272b30'],
                    //paddingTop: '150px'
                });
            });
        </script>
    </head>
    <body>
        <div id="header">
            <div class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand">CrowdCafe Quality Control</a>

                    </div>
                    <div class="navbar-collapse collapse navbar-responsive-collapse">
                        <!--role="form" action="index.php" method="POST"-->
                        <form class="navbar-form navbar-left">
                            <input type="text" class="form-control col-lg-8" placeholder="Search"></input>
                        </form>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="create_function.php">Add a new function</a>
                            </li>                        
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div class="container"> 

            <div class="bs-component">
                <div class="list-group">

                    <div class="ms-left">

                        <?php
                        $q = "SELECT id,url,name FROM Functions ORDER BY id DESC";
                        $res = $database->query($q);
                        $q = "SELECT COUNT(*) as n FROM Functions ORDER BY id DESC";
                        $res2 = $database->query($q);
                        $func_nbr = 0;
                        $pag_nbr = 1;
                        $column = 1;
                        $n_max = mysql_fetch_array($res2);
                        //echo $n_max["n"];
                        $n_max = (int) $n_max["n"];
                        $half = (int) ($n_max / 2);
                        while ($results = mysql_fetch_array($res)) {
                            /* echo "mid: " . $half;
                              echo " n: " . $func_nbr;
                              echo " pag: " . $pag_nbr;
                              echo " column: " . $column; */
                            if ($half == $func_nbr && $column < 2) {
                                $column++;
                                $pag_nbr = 1;

                                if (!$func_nbr % $MAX_F_PER_PAGE == 0) {
                                    ?>
                                </div>
                                <?php
                            }
                            $func_nbr = 0;
                            ?>
                        </div>
                        <div class="ms-right">
                            <div class="ms-section" id="right<?php echo $pag_nbr; ?>">
                                <?php
                                $pag_nbr++;
                            } else if ($func_nbr % $MAX_F_PER_PAGE == 0 || $func_nbr == 0) {
                                if ($column <= 1) {
                                    ?>
                                    <div class="ms-section" id="left<?php echo $pag_nbr; ?>">
                                        <?php
                                        $pag_nbr++;
                                    } else {
                                        ?>
                                        <div class="ms-section" id="right<?php echo $pag_nbr; ?>">
                                            <?php
                                            $pag_nbr++;
                                        }
                                    }
                                    //if (!($func_nbr < 0)) {
                                    ?>
                                    <a href="show_function.php?id=<?php echo $results["id"]; ?>" class="list-group-item">
                                        <h3><?php
                                print ( $results["id"] . " - " . $results["name"] . "<BR/>");
                                    ?>
                                        </h3>
                                    </a>
                                    <?php
                                    if (($func_nbr + 1) % $MAX_F_PER_PAGE == 0) {
                                        ?>
                                    </div>
                                    <?php
                                    // }
                                }
                                $func_nbr++;
                            }

                            if (!$func_nbr % $MAX_F_PER_PAGE == 0) {
                                ?>
                            </div>
                            <?php
                        }
                        ?>


                    </div>

                </div>
            </div>
    </body>
</html>
