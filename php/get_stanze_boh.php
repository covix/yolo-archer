<?php
include 'api.php';

$stanze = get_stanze_prenotabili();

foreach ($stanze as &$s)
{
	echo $s->edificio." ".$s->nome." ".$s->capienza." ".$s->persone.":<br />";
}

?>
