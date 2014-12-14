<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aule</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <!-- Optional theme -->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">-->
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
<<<<<<< HEAD
    <center>
        <header>
            <h1>A<span>ul</span>e</h1>
        </header>

        <div id="divdwnl">
            <div class="separatore"></div>
			<p>INSERISCI COMMENTO</p>
            <form action="php/insert_commento.php" method="POST">
                <br>
                <input type="text" name="testo"    value="Ciao sono un commento">
				<br>
                <input type="text" name="persone"  value="50">
                <br>
				<input type="text" name="stanza"   value="A103">
                <br>
				<input type="text" name="edificio" value="Povo">
                <br>
                <input type="submit" value="login">
            </form>

			<div class="separatore"></div>
			<p>LIKE</p>
            <form action="php/like.php" method="POST">
                <br>
                <input type="text" name="email_commento" value="pipino@gmail.com">
                <br>
				<input type="text" name="stanza" value="A103">
                <br>
				<input type="text" name="edificio" value="Povo">
				<br>
				<input type="text" name="timestamp" value="1418489885">
                <br>
                <input type="submit" value="login">
            </form>

			<div class="separatore"></div>
			<p>DISLIKE</p>
            <form action="php/dislike.php" method="POST">
                <br>
                <input type="text" name="email_commento"    value="pipino@gmail.com">
                <br>
				<input type="text" name="stanza"   value="A103">
                <br>
				<input type="text" name="edificio" value="Povo">
				<br>
				<input type="text" name="timestamp" value="1418489885">
                <br>
                <input type="submit" value="login">
            </form>
=======
    <div class="container">
        <div class="header">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="active hidden-xs"><a href="#">Add</a>
                    </li>
                    <li role="presentation" class="hidden-xs"><a href="#">Profile</a>
                    </li>
                </ul>

                <h3 class="text-muted brand" style="text-align: center">Aulapp</h3>
            </nav>
        </div>


        <form class="form-inline">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Povo">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-default" id="btnsearch">
                    <span class="glyphicon glyphicon-search"></span> Search
                </button>
            </div>
        </form>
        <div class="clearfix">
            <hr>
            <h2>A201 <small>Fino alle 12:30</small></h2>
            <div class="col-sm-4">
                <p>15 <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                </p>
            </div>
            <div class="col-sm-4">
                <cite>Someone very important said</cite>
            </div>
            <div class="col-sm-4">
                <p>20 <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                    15 <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
                </p>
            </div>
        </div>
        <div class="clearfix">
            <hr>
            <h2>A201 <small>Fino alle 12:30</small></h2>
            <div class="col-sm-4">
                <p>15 <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                </p>
            </div>
            <div class="col-sm-4">
                <cite>Someone very important said</cite>
            </div>
            <div class="col-sm-4">
                <p>20 <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                    15 <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
                </p>
            </div>
        </div>
        <div class="clearfix">
            <hr>
            <h2>A201 <small>Fino alle 12:30</small></h2>
            <div class="col-sm-4">
                <p>15 <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                </p>
            </div>
            <div class="col-sm-4">
                <cite>Someone very important said</cite>
            </div>
            <div class="col-sm-4">
                <p>20 <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                    15 <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
                </p>
            </div>
        </div>

        <footer class="footer">
            <p>Brunella © Company 2014</p>
        </footer>
>>>>>>> origin/master

    </div>

<<<<<<< HEAD
			<div class="separatore"></div>
			<p>PRENOTA</p>
            <form action="php/insert_prenotazione.php" method="POST">
                <br>
				<input type="text" name="inizio" value="1418489885">
				<br>
				<input type="text" name="fine" value="1418489895">
				<br>
				<input type="text" name="persone"  value="50">
                <br>
				<input type="text" name="stanza"   value="A103">
                <br>
				<input type="text" name="edificio" value="Povo">
                <br>
                <input type="submit" value="login">
            </form>

			<div class="separatore"></div>
			<p>AULE_PRENOTAZIONE</p>
            <form action="php/get_stanze_boh.php" method="POST">
				<br>
				<input type="text" name="inizio" value="1418489890">
				<br>
				<input type="text" name="fine" value="1418489892">
                <br>
				<input type="text" name="edificio" value="Povo">
				<br>
                <input type="submit" value="login">
            </form>
        </div>
=======
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
>>>>>>> origin/master

            $(".html5Form").bootstrapValidator();
            $(".help-block").remove();
        });
    </script>
</body>

</html>

