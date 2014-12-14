<?php
include 'api.php';

set_nomeutente();

if(!get_esisteutente())
{
	crea_utente();
}

header("Location: http://".$_SERVER['HTTP_HOST']."/aule.php");
die("aiuto aiuto");echo "coviello cagna canshielloooo";
?>
