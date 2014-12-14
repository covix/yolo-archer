<?php
include 'api.php';

$stanze = get_stanze_adesso();

foreach ($stanze as &$s)
{
	echo $s->edificio." ".$s->nome." ".$s->idedificio.":<br />";
	foreach($s->commenti as &$c)
	{
		echo $c->email." ".$c->timestamp." ".$c->testo." ".$c->quante_persone." ".$c->likes." ".$c->dislike."<br />";
	}
}

?>
