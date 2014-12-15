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
    <title>Aule | AulAPP</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <!-- Optional theme -->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">-->
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>
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
                        foreach ($arrrgh as &$value)
                        {
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
                <button type="submit" class="btn btn-default" id="btnsearch">
                    <span class="glyphicon glyphicon-search"></span> Search
                </button>
            </div>
        </form>
        <?php
            if( isset($_POST['edificio']) )
            {
                $arrrgh = get_stanze_adesso();
                $s = "";
                foreach ($arrrgh as &$value)
                {
                    $testo = "Non ci sono commenti disponibili";
                    $like = 0;
                    $dislike = 0;
                    $quantepersone = 0;
                    $time = "N/A";

                    if (sizeof($value->commenti) > 0)
                    {
                        $testo = $value->commenti[0]->testo;
                        $like = $value->commenti[0]->likes;
                        $dislike = $value->commenti[0]->dislike;
                        $quantepersone = $value->commenti[0]->quante_persone;
                        $time = date("H:i", $value->commenti[0]->timestamp);
                    }
                    $s = $s."<div class='clearfix'>
                                <hr>
                                <h2>$value->nome <small>Ultimo commento alle $time</small></h2>
                                <div class='col-sm-4'>
                                    <p>$quantepersone / $value->capienza <span class='glyphicon glyphicon-user' aria-hidden='true'></span>
                                    </p>
                                </div>
                                <div class=col-sm-4>
                                    <cite>$testo</cite>
                                </div>
                                <div class=col-sm-4>
                                    <p>$like <span class='glyphicon glyphicon-thumbs-up' aria-hidden='true'></span>
                                        $dislike <span class='glyphicon glyphicon-thumbs-down' aria-hidden='true'></span>
                                    </p>
                                </div>
                            </div>";
                }
                echo $s;
            }

        ?>

        <footer class="footer">
            <p>Brunella © Company 2014</p>
        </footer>

    </div>


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
                pickDate: false,
            });

            $(".html5Form").bootstrapValidator();
            $(".help-block").remove();
        });
    </script>
</body>

</html>

