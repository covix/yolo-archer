<?php
include "php/api.php";
logged_or_die();

if ( isset($_POST['inizio']))
{
    $_POST['inizio'] = strtotime($_POST['inizio']);
    $_POST['fine'] = strtotime($_POST['fine']);
    prenota();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prenota | AulAPP</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <!-- Optional theme -->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">-->
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/bootstrapValidator.min.css">
    <link rel="stylesheet" href="./css/bootstrap-datetimepicker.min.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 class="text-muted brand" style="text-align: center">AulAPP</h2>
            <nav class="padLeft">
                <button type="button" class="btn btn-default btnLeft visible-xs pull-left"><a href="home.php"><span class="glyphicon bianco glyphicon-home"></a>
                </button>
                <button type="button" class="btn btn-default btnLeft visible-xs pull-right"><a href="php/logout.php"><span class="glyphicon bianco glyphicon-log-out"></a>
                </button>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="hidden-xs"><a href="home.php"><span class="glyphicon bianco glyphicon-home"></span>
                    <p class="bianco">Home</p>
                    </a>
                    </li>
                    <li role="presentation" class="hidden-xs"><a href="php/logout.php"><span class="glyphicon bianco glyphicon-log-out"></span><p class="bianco"> Logout</p> </a>
                    </li>
                </ul>
            </nav>
        </div>

        <?php
            if (!isset ($_POST['edificio']))
            {
            ?>
            <div class="row-marketing">
                <div class="alert alert-info" role="alert">
                    <strong>Start</strong> you research, by <strong>pressing</strong>... mmm... <strong>search!</strong>
                </div>
            </div>
            <?php
            }
        ?>
        <form class="form-inline" method="post" action="">
            <div class="form-group">
               <select class="form-control" name="edificio">
                    <?php
                        $arrrgh = get_edifici();
                        $s = "";
                        foreach ($arrrgh as &$value) {
                            $selected = "";
                            if ( $_POST['edificio'] == $value)
                            {
                                $selected = "selected";
                            }
                            $s = $s."<option value='$value' $selected>$value</option>";
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
                            <h2><?php echo $s->nome ?></h2>
                            <button type="button" class="btn btn-warning btn-prenota" data-toggle="modal" data-target="#prenotaModal">Prenota</button>
                            <br>
                            <?php
                            if (true) // (strlen($s->jsona) > 20)
                            {
                                $i++;
                            ?>
                                <script type="text/javascript">
                                    google.load("visualization", "1", {packages:["corechart"]});
                                    google.setOnLoadCallback(drawChart);
                                    function drawChart()
                                    {
                                        var data = new google.visualization.DataTable();
                                        data.addColumn('date','Data');
                                        data.addColumn('number','Persone');
                                        data.addColumn('number','Lezioni');


                                        data.addRows([[new Date(<?php echo $s->inizio_Richiesta ?>000), 0, 0]]);

                                        <?php
                                            if (is_array($s->points))
                                            {
                                                $integrale = 0;
                                                foreach($s->points as $key => $val) {
                                        ?>
                                                data.addRows([[new Date(<?php echo ($key-1) ?>000), <?php echo $integrale ?>, 0]]);
                                                data.addRows([[new Date(<?php echo $key ?>000), <?php echo ($integrale += $val) ?>, 0]]);
                                        <?php   }
                                             } ?>



                                        <?php
                                            foreach($s->lezioni_dalle_INIZIO_alle_7 as &$p)
                                            {
                                        ?>
                                                data.addRows([[new Date(<?php echo ($p->inizio-1) ?>000), 0, 0]]);
                                                data.addRows([[new Date(<?php echo $p->inizio ?>000), 0, <?php echo $p->capienza ?>]]);
                                                data.addRows([[new Date(<?php echo $p->fine ?>000), 0, <?php echo $p->capienza ?>]]);
                                                data.addRows([[new Date(<?php echo ($p->fine+1) ?>000), 0, 0]]);

                                        <?php
                                            }
                                        ?>

                                        data.addRows([[new Date(<?php echo $s->fine_Richiesta ?>000), 0, 0]]);



                                    var options = {
                                    title: 'Aula ',
                                    vAxis: {minValue: 0, maxValue : <?php echo $s->capienza ?>},

                                    hAxis: {title: '{Ore}',  titleTextStyle: {color: '#333'},format:'H:m MMM d, y', showTextEvery :true},
                                        series: {
                                            0: { color: '#0050ee' },
                                            1: { color: '#e2431e' }
                                          },

                                            displayAnnotations: true
                                    };




                                    var chart = new google.visualization.AreaChart(document.getElementById('chart_div_<?php echo $i ?>'));
                                    chart.draw(data, options);


                                    }
                                </script>
                                <div id='chart_div_<?php echo $i ?>' style="width:600px; height:250px;"></div>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h2 class="modal-title">Ci saranno anche i tuoi amici?</h2>
                </div>
                <form method="post" action="" class="html5Form form-inline" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" role="form">
                    <input type="hidden" name="stanza" />
                    <input type="hidden" name="edificio" />
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="inputContainer" style="display:inline-block">
                                <input class="form-control" name="persone" type="number" placeholder="Quanti sarete?" min="1" data-bv-integer-message="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker2'>
                                <input type='text' class="form-control" name="inizio" data-date-format="" placeholder="Da.." />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker3'>
                                <input type='text' class="form-control" name="fine" data-date-format="" placeholder="A.." />
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

            $('#datetimepicker2').datetimepicker({
                useMinutes: true,
                useCurrent: true,
                pickDate: true,
                minuteStepping: 30,
            });

            $('#datetimepicker3').datetimepicker({
                useMinutes: true,
                useCurrent: true,
                pickDate: true,
                minuteStepping: 30,
            });

            $(".html5Form").bootstrapValidator();
            $(".help-block").remove();

            $(".btn-prenota").click(function (e) {
                $(".modal input[name=edificio]").attr('value', $('select[name=edificio]').val());
                $(".modal input[name=stanza]").attr('value', $($(this)[0].parentElement).children('h2')[0].textContent);
            });
        });
    </script>
</body>

</html>

