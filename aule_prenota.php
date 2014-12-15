<?php include "php/api.php"; logged_or_die();  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prenota</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <!-- Optional theme -->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">-->
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/bootstrapValidator.min.css">
    <link rel="stylesheet" href="./css/bootstrap-datetimepicker.min.css">
    <style type="text/css">
    </style>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 class="text-muted brand" style="text-align: center">AulAPP</h2>

            <nav class="padLeft">
                <button type="button" class="btn btn-default btnLeft visible-xs pull-left"><a href="home.php"><span class="glyphicon bianco glyphicon-home"></a>
                </button>
                <button type="button" class="btn btn-default btnLeft visible-xs pull-right"><a href="index.php"><span class="glyphicon bianco glyphicon-log-out"></a>
                </button>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="hidden-xs"><a href="home.php"><span class="glyphicon bianco glyphicon-home"></span>
                    <p class="bianco">Home</p>
                    </a>
                    </li>
                    <li role="presentation" class="hidden-xs"><a href="index.php"><span class="glyphicon bianco glyphicon-log-out"></span><p class="bianco"> Logout</p> </a>
                    </li>
                </ul>
            </nav>
        </div>

        <form class="form-inline" method="post" action="">
            <div class="form-group">
               <select class="form-control" name="edificio">
                    <?php
                        $arrrgh = get_edifici();
                        $s = "";
                        foreach ($arrrgh as &$value) {
                            $s = $s."<option value='$value'>$value</option>";
                        }
                        echo $s;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name="inizio" data-date-format="" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default" id="btnsearch">
                    <span class="glyphicon glyphicon-search"></span> Search
                </button>
            </div>
        </form>



            <?php

            if( isset($_POST['edificio']) )
            {
                $stanze = get_stanze_prenotazioni();
                $i = 0;
                foreach($stanze as &$s)
                {
                    ?>
                        <div class="room">
                            <hr>
                            <h2><?php echo $s->nome ?> <small>Data e ora de che?</small></h2>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#prenotaModal">Prenota</button>
                            <br>
                            <?php
                            if (true) // (strlen($s->jsona) > 20)
                            {
                                $i++;
                            ?>
                                <script type="text/javascript">
                                    google.load("visualization", "1", {packages:["corechart"]});
                                    google.setOnLoadCallback(drawChart);
                                    function drawChart() {
                                    var data = google.visualization.arrayToDataTable(<?php echo $s->json ?>);

                                    var options = {
                                    title: 'Company Performance',
                                    hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
                                    vAxis: {minValue: 0}
                                    };

                                    var chart = new google.visualization.AreaChart(document.getElementById('chart_div_<?php echo $i ?>'));
                                    chart.draw(data, options);
                                    }
                                </script>
                                <div id='chart_div_<?php echo $i ?>' style="width:300px; height:250px;"></div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                }
            }

            ?>

            <!--
            <p>Hanno già detto che ci saranno: 15
    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
</p>
-->
        <footer class="footer ">
            <p>Brunella © Company 2014</p>
        </footer>
    </div>


    <div class="modal fade" id="prenotaModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h2 class="modal-title">Ci saranno anche i tuoi amici?</h2>
                </div>
                <form class="html5Form form-inline" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" role="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="inputContainer" style="display:inline-block">
                                <input class="form-control" name="number" type="number" placeholder="Quanti sarete?" min="1" data-bv-integer-message="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' class="form-control" name="inizio" data-date-format="" />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-lg btn-success">Prenota</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js "></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js "></script>
    <script src="js/bootstrapValidator.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="js/bootstrap-datetimepicker.min.js "></script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                useMinutes: false,
                useCurrent: true,
                pickDate: true,
            });

            $(".html5Form").bootstrapValidator();
            $(".help-block").remove();
        });
    </script>
</body>

</html>

