<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AulApp</title>
    <!--    <link rel="stylesheet" href="style.css" type="text/css">-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <center>
        <header>
            <h1>A<span>ul</span>A<span>pp</span></h1>
        </header>
        <div id="divimg">
            <img src="images/logo.png" />
        </div>

        <?php echo print_r($_COOKIE); ?>

        <div id="divtesto">
            <p>Scopri un mondo di stanze
                <br/>fatte su misura per te!
                <br/>
                <br/><span>#divertimentoportamivia!!</span>
            </p>
        </div>

        <div id="divdwnl">
            <div class="separatore"></div>
            <form action="php/login.php" method="POST">
                <br>
                <input type="text" name="username" value="" placeholder="Username">
                <br>
                <input type="submit" value="login">
            </form>
        </div>

        <footer>&copy; 2014 <b>Brunella</b> All rights reserved.</footer>
    </center>
</body>

</html>
