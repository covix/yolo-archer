<?php include 'php/api.php';echo "ciao ".get_nomeutente();?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AulApp</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <center>
        <header>
            <h1>A<span>ul</span>e</h1>
        </header>

        <div id="divtesto">
            <p>

            </p>
        </div>

        <div id="divdwnl">
            <div class="separatore"></div>
			<p>INSERISCI COMMENTO</p>
            <form action="php/insert_commento.php" method="POST">
                <br>
                <input type="text" name="testo"    value="Ciao sono un commento">
				<br>
                <input type="text" name="email"    value="pipino@gmail.com">
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
			<p>INSERISCI UTENTE</p>
            <form action="php/insert_utente.php" method="POST">
                <br>
                <input type="text" name="email"    value="pipinoilbreve@gmail.com">
                <br>
				<input type="text" name="password"  value="ciao_come_sono_breve">
                <br>
                <input type="submit" value="login">
            </form>

			<div class="separatore"></div>
			<p>LIKE</p>
            <form action="php/like.php" method="POST">
                <br>
                <input type="text" name="email_commento"    value="pipino@gmail.com">
                <br>
				<input type="text" name="email_votante"  value="pipinoilbreve@gmail.com">
                <br>
				<input type="text" name="stanza"   value="A103">
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
				<input type="text" name="email_votante"  value="pipinoilbreve@gmail.com">
                <br>
				<input type="text" name="stanza"   value="A103">
                <br>
				<input type="text" name="edificio" value="Povo">
				<br>
				<input type="text" name="timestamp" value="1418489885">
                <br>
                <input type="submit" value="login">
            </form>

			<div class="separatore"></div>
			<p>AULE_ADESSO</p>
            <form action="php/get_stanze_adesso.php" method="POST">
                <br>
				<input type="text" name="edificio" value="Povo">
				<br>
                <input type="submit" value="login">
            </form>

			<div class="separatore"></div>
			<p>PRENOTA</p>
            <form action="php/insert_prenotazione.php" method="POST">
                <br>
				<input type="text" name="inizio" value="1418489885">
				<br>
				<input type="text" name="fine" value="1418489895">
				<br>
                <input type="text" name="email"    value="pipino@gmail.com">
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
			<p>AULE_BOH</p>
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

        <footer>&copy; 2014 <b>Brunella</b> All rights reserved.</footer>
    </center>
</body>

</html>
