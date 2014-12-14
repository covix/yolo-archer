<?php

include 'api.php';

set_nomeutente();

if(!get_esisteutente())
{
    crea_utente();
}
header("Location: /home.php");

die( "aiuto aiuto");
echo "coviello cagna canshielloooo";

?>
