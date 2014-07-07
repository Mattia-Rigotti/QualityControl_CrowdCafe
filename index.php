<?php
include "db_connect.php";
$database = new DB_Connector();
if (!$database->connect()) {
    echo "DB connection error!";
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
                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="create_function.php">Add a new function</a>
                        </li>                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <h2>Function List:</h2><BR/>

            <?php
            $q = "SELECT id,url,name FROM Functions ORDER BY id DESC LIMIT 10";
            $res = $database->query($q);
            while ($results = mysql_fetch_array($res)) {
                ?>
                <a href="show_function.php?id=<?php echo $results["id"]; ?>" class="list-group-item">
                    <h3><?php
            print ($results["id"] . " - " . $results["name"] . "<BR/>");
                ?>
                    </h3>
                </a>
                <?php
            }
            ?>


        </div>



</body>
</html>
