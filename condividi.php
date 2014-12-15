<?php
    include "php/api.php";
    logged_or_die();

    if ( isset ($_POST['persone']))
    {
        fai_commento();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Condividi | AulAPP</title>

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
        <div>
            <form class="form-horizontal" method="post" action="">
                <div class=form-group>
                    <label class="col-sm-2 control-label">Edificio</label>
                    <div class="col-sm-5 col-md-8">
                        <select name="edificio" class="form-control" onchange="this.form.submit()">
                            <option value="" selected disabled>Please select an option...</option>
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
                </div>
            </form>
            <form method="post" action="" id="numericinput" class="form-horizontal" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                <?php
                    if (isset ($_POST['edificio']))
                    {
                    ?>
                        <input type='hidden' value='<?php echo $_POST['edificio']; ?>' name='edificio' />
                    <?php
                    }
                ?>
                <div class=form-group>
                    <label class="col-sm-2 control-label">Aula</label>
                    <div class="col-sm-5 col-md-8">
                        <select class="form-control" name=stanza>
                            <?php
                                if (isset ($_POST['edificio']))
                                {
                                    $arrrgh = get_stanze_all();
                                    $edificio = $_POST['edificio'];
                                    $s = "";
                                    foreach ($arrrgh as &$value) {
                                        $s = $s."<option value='$value'>$value</option>";
                                    }
                                    echo $s;
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Number of</label>
                    <div class="col-sm-5 col-md-8 inputContainer">
                        <input class="form-control" name="persone" type="number" min="0" placeholder="People in the room" data-bv-integer-message="The value is not an integer" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Notes</label>
                    <div class="col-sm-5 col-md-8">
                        <textarea class="form-control" name=testo rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Share</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </div>
            </form>
        </div>

        <footer class="footer">
            <p>Brunella © Company 2014</p>
        </footer>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="js/bootstrapValidator.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#numericinput').bootstrapValidator();

        });
    </script>
</body>

</html>

