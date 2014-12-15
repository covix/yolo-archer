<?php
    include "php/api.php";
    logged_or_die();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aulapp - Profilo</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <!-- Optional theme -->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">-->
    <link rel="stylesheet" href="./styles/styles.css" </head>

    <body>
        <div class="container">
            <div class="header">

                <h2 class="text-muted brand" style="text-align: center">Aulapp</h2>

                <nav class="padLeft">
                    <button type="button" class="btn btn-default btnLeft visible-xs pull-left"><span class="glyphicon bianco glyphicon-arrow-left"></button>
                    <button type="button" class="btn btn-default btnLeft visible-xs pull-right"><span class="glyphicon bianco glyphicon-log-out"></button>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="hidden-xs"><a href="#"><span class="glyphicon bianco glyphicon-arrow-left"></span>
                        <p class="bianco">Indietro</p>
                        </a>
                        </li>

                        <li role="presentation" class="hidden-xs"><a href="#"><span class="glyphicon bianco glyphicon-log-out"></span><p class="bianco"> Logout</p> </a>
                        </li>
                        </ul>

                </nav>
            </div>
            <div class="center-profile">
                <div class="row">

                    <img class="img-circle" src="./img/ricalco-circle.png" style="height: 140px;">

                </div>

                <div class="row-marketing">
                    <h3>Brunella Lorenz</h3>
                </div>
                <hr>
                <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                    <script type="text/javascript">
                      google.load("visualization", "1", {packages:["corechart"]});
                      google.setOnLoadCallback(drawChart);
                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([["Data", "Punti"]<?php
                            $m = 0;
                            $p = 5;
                            $t = rand(3, 5) * rand(3, 5);
                            for ($i = 0; $i < $t; $i++) {
                                $m -= rand(500, 36000);
                                $p += rand(-1, 1);
                                if ($p < 0)
                                    $p = -$p;
                                echo ", [new Date(".(time() - $m)."000), ".$p."]";
                            }

                        ?>]);

                        var options = {
                          title: 'Punteggio',
                          hAxis: {title: 'Punti',  titleTextStyle: {color: '#333'}},
                          vAxis: {minValue: 0}
                        };

                        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                        chart.draw(data, options);
                      }
                    </script>
                <div class="row-marketing">
                    <label class="lblPunti">Punti <?php echo $p ?></label>
                </div>

                <div class="row-marketing">
                    <center><div id="chart_div" style="width: 100%"></div></center>
                </div>

                <div class="row-marketing">
                    <table align="center" class="tblLikes">
                        <tr>
                            <th class="leftTh"><span class="glyphicon glyphicon-thumbs-up"></span><?php echo $t ?></th>
                            <th class="rightTh"><span class="glyphicon glyphicon-thumbs-down"></span><?php echo $t-$p ?></th>
                        </tr>
                    </table>

                </div>

                <footer class="footer">
                    <p>Brunella © Company 2014</p>
                </footer>
            </div>
        </div>
        <!-- /.container -->

        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </body>

</html>
