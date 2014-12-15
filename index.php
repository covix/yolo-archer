<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <!-- Optional theme -->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">-->
    <link rel="stylesheet" href="./css/styles.css" </head>

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

            <div class="jumbotron">
                <h1>Aulapp</h1>
                <p class="lead">L'app che ti aiuta a studiare da solo o in compagnia</p>
                <div class="row">
                    <div class="col-lg-4 col-xs-4">
                        <a href=# class="" data-toggle="modal" data-target="#loginModal">
                            <img class="img-circle" src="./img/social-facebook.png" style="height: 140px;">
                        </a>
                    </div>
                    <!-- /.col-lg-4 -->
                    <div class="col-lg-4 col-xs-4">
                        <a href=# class="" data-toggle="modal" data-target="#loginModal">
                            <img class="img-circle" src="./img/social-twitter.png" style="height: 140px;">
                        </a>
                    </div>
                    <!-- /.col-lg-4 -->
                    <div class="col-lg-4 col-xs-4">
                        <a href=# class="" data-toggle="modal" data-target="#loginModal">

                            <img class="img-circle" src="./img/social-google.png" style="background-color: white; height: 140px;">
                        </a>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            </div>

            <div class="row marketing">
                <div class="col-lg-6">
                    <h4>Cerca l'aula giusta per te</h4>
                    <p>Ma nella vita nulla é gratis.</p>

                    <h4>Condividi lo stato delle aule</h4>
                    <p>Guadagna migliaia di punti suggerendo opportunità di studio.</p>
                </div>

                <div class="col-lg-6">
                    <h4>Avvisa il popolo di Aulapp</h4>
                    <p>Fai conoscere agli altri i tuoi prossimi movimenti.</p>

                    <h4>Calcola un integrale del grafico del tuo punteggio</h4>
                    <p>Vinci un dottorato in matematica!</p>
                </div>
            </div>

            <footer class="footer">
                <p>Brunella © Company 2014</p>
            </footer>

        </div>
        <!-- /.container -->


        <div class="modal fade" id="loginModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h2 class="modal-title">Login</h2>
                    </div>
                    <form role="form" method="post" action="./php/login.php">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Your email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-lg btn-primary">Demo Login</button>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </body>

</html>

