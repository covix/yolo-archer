<?php
session_start();

class Prenotazione
{
	public $inizio = 0;
	public $fine =0;
	public $capienza = 0;
}

class Lezione
{
	public $inizio = 0;
	public $fine =0;
	public $capienza = 0;
}

class Stanza_prenotata
{
	public $nome = '';
	public $edificio = '';
	public $capienza = 0;
	public $prenotazioni_dalle_INIZIO_alle_7 = array();
	public $lezioni_dalle_INIZIO_alle_7 = array();
	public $json = '';
    public $inizio_Richiesta = 0;
    public $fine_Richiesta = 0;

}

function get_stanze_libere_adesso_ma_devo_aggiungere_le_prenotazioni_e_le_lezioni($edificio, $inizio, $fine)
{
	$stanze = array();

	$servername = "fdb13.atspace.me";
	$username = "1762595_maindb";
	$password = "Ciao1234";
	$dbname = "1762595_maindb";


	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

	$query =
	"
		SELECT STANZA.nome AS nome, EDIFICIO.nome_corto AS edificio, STANZA.capienza AS capienza
		FROM STANZA, EDIFICIO
		WHERE
			STANZA.id_edificio = EDIFICIO.id_edificio AND
			EDIFICIO.id_edificio = '$edificio'
	";

	$result = $conn->query($query);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$s = new Stanza_prenotata();
			$s->nome = $row["nome"];
			$s->edificio = $row["edificio"];
			$s->capienza = $row["capienza"];
			$stanze[] = $s;
		}
	}
	$conn->close();

	return $stanze;
}

function get_stanze_prenotazioni()
{
//	date_default_timezone_set('Europe/Rome');

	$inizio = strtotime($_POST['inizio_RICERCA']);

	$edif = $_POST["edificio"];
	$edificio = get_idedificio($edif);
	$fine = strtotime(date("Y-m-d", $inizio)) + 19 * 3600;

	$stanze = get_stanze_libere_adesso_ma_devo_aggiungere_le_prenotazioni_e_le_lezioni($edificio, $inizio, $fine);


	$servername = "fdb13.atspace.me";
	$username = "1762595_maindb";
	$password = "Ciao1234";
	$dbname = "1762595_maindb";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	//aggiungo le prenotazioni
	foreach ($stanze as &$s)
	{
        $s->inizio_Richiesta = $inizio;
        $s->fine_Richiesta = $fine;

		$nome = $s->nome;
		$query =
		"SELECT PRENOTAZIONE.inizio AS inizio, PRENOTAZIONE.fine AS fine, PRENOTAZIONE.persone AS quante_persone
		FROM PRENOTAZIONE, STANZA
		WHERE
			STANZA.nome = '$nome' AND
			STANZA.nome = PRENOTAZIONE.nome_stanza AND
			PRENOTAZIONE.fine > $inizio AND
			PRENOTAZIONE.inizio < $fine";

		$result = $conn->query($query);
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$c = new Prenotazione();
				$c->inizio = $row["inizio"];
				$c->fine = $row["fine"];
				$c->capienza = $row["quante_persone"];
				$s->prenotazioni_dalle_INIZIO_alle_7[] = $c;
			}
		}


		$query =
		"SELECT EVENTO.inizio AS inizio, EVENTO.fine AS fine, STANZA.capienza AS quante_persone
		FROM EVENTO, STANZA
		WHERE
			STANZA.nome = '$nome' AND
			STANZA.nome = EVENTO.nome_stanza AND
			EVENTO.fine > $inizio AND
			EVENTO.inizio < $fine";

		$result = $conn->query($query);
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$c = new Lezione();
				$c->inizio = $row["inizio"];
				$c->fine = $row["fine"];
				$c->capienza = $row["quante_persone"];
				$s->lezioni_dalle_INIZIO_alle_7[] = $c;
			}
		}

		$arr = array();
		$tempi = array();
		foreach($s->prenotazioni_dalle_INIZIO_alle_7 as &$p)
		{
			$arr[] = -(-$p->capienza);
			$tempi[] = $p->inizio;

			$arr[] = -$p->capienza;
			$tempi[] = $p->fine;
		}

		$s->points = array();
		for($i = 0; $i < count($tempi); $i++)
		{
			if ($tempi[$i] <= $fine && $tempi[$i] >= $inizio)
				if(isset($s->points[$tempi[$i]]))
				{
					$s->points[$tempi[$i]] += $arr[$i];
				}
				else
				{
					$s->points[$tempi[$i]] = $arr[$i];
				}
		}
		ksort($s->points);
	}
	$conn->close();


	return $stanze;
}



























//TESTATEEEEEEEE-----------------------------------------------------------------------------
//Si prenota in quella giornata
function prenota()
{
	$email = get_nomeutente();
	$persone = $_POST["persone"];
	$nome_stanza = $_POST["stanza"];
	$edificio = $_POST["edificio"];
	$id_edificio = get_idedificio($edificio);
	$inizio = $_POST["inizio"];
	$fine = $_POST["fine"];

	$query =  "INSERT INTO PRENOTAZIONE VALUES($id_edificio, '$nome_stanza', '$email', $inizio, $fine, $persone)";
	//echo $query;
	exec_non_query($query);
}



function get_esisteutente()
{
	$email = get_nomeutente();

	$servername = "fdb13.atspace.me";
	$username = "1762595_maindb";
	$password = "Ciao1234";
	$dbname = "1762595_maindb";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	$query = "SELECT * FROM UTENTE WHERE UTENTE.email = '$email'";
	$result = $conn->query($query);
	$esiste = false;
	if ($result->num_rows > 0)
	{
		$esiste = true;
	}
	$conn->close();
	return $esiste;
}

function get_punti_utente()
{
	$email = get_nomeutente();

	$servername = "fdb13.atspace.me";
	$username = "1762595_maindb";
	$password = "Ciao1234";
	$dbname = "1762595_maindb";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	$query = "SELECT punti FROM UTENTE WHERE UTENTE.email = '$email'";
	$result = $conn->query($query);
	$punti = '';
	if ($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$punti = $row["punti"];
	}
	$conn->close();
	return $punti;
}


function perdi_tot_punti($tot)
{
	$punti = get_punti_utente() + $tot;
	$email = get_nomeutente();

	exec_non_query
	("
		UPDATE UTENTE
		SET punti = $punti
		WHERE email = '$email'
	");
}


function get_edifici()
{
	$servername = "fdb13.atspace.me";
	$username = "1762595_maindb";
	$password = "Ciao1234";
	$dbname = "1762595_maindb";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	$query = "SELECT nome_corto FROM EDIFICIO";
	$edifici = array();
	$result = $conn->query($query);
	$esiste = false;
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$edifici[] = $row["nome_corto"];
		}
	}
	$conn->close();
	return $edifici;
}

function get_stanze_all()
{
    $servername = "fdb13.atspace.me";
	$username = "1762595_maindb";
	$password = "Ciao1234";
	$dbname = "1762595_maindb";

    $edificio = $_POST['edificio'];

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	$query =   "SELECT STANZA.nome FROM STANZA, EDIFICIO
                WHERE  STANZA.id_edificio = EDIFICIO.id_edificio
                    AND EDIFICIO.nome_corto = '$edificio'";
	$aule = array();
	$result = $conn->query($query);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$aule[] = $row["nome"];
		}
	}
	$conn->close();
	return $aule;
}


//TESTATEEEEEEEE-----------------------------------------------------------------------------

function set_nomeutente()
{
	$_SESSION["email"] = $_POST['email'];
}
function get_nomeutente()
{
	return $_SESSION["email"];
}
function is_logged()
{
    return isset($_SESSION["email"]);
}
function logged_or_die()
{
    if (!is_logged())
    {
        header("Location: /index.php");
        die ("702 Not logged");
    }
}
function go_home_your_logged()
{
    if (is_logged())
    {
        header("Location: /home.php");
        die ("883 U Logged Bro");
    }
}


function exec_non_query($query)
{
	$servername = "fdb13.atspace.me";
	$username = "1762595_maindb";
	$password = "Ciao1234";
	$dbname = "1762595_maindb";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	if(!$conn->query($query))
		echo "";
	$conn->close();
}
function get_idedificio($nome_corto_edificio)
{
	$servername = "fdb13.atspace.me";
	$username = "1762595_maindb";
	$password = "Ciao1234";
	$dbname = "1762595_maindb";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	$query = "SELECT id_edificio FROM EDIFICIO WHERE EDIFICIO.nome_corto = '$nome_corto_edificio'";
	$result = $conn->query($query);
	$idedificio = '';
	if ($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$idedificio = $row["id_edificio"];
	}
	$conn->close();
	return $idedificio;
}

function fai_commento()
{
	$testo = $_POST["testo"];
	$email = get_nomeutente();
	$persone = $_POST["persone"];
	$nome_stanza = $_POST["stanza"];
	$edificio = $_POST["edificio"];
	$id_edificio = get_idedificio($edificio);
	$timestamp = time();
    $_POST["timestamp"] = $timestamp;

	$query =  "INSERT INTO COMMENTO VALUES($id_edificio, '$nome_stanza', '$email', $timestamp, '$testo', $persone)";
    Im_neutral_and_i_know_it();
	exec_non_query($query);
}
function crea_utente()
{
	$email = get_nomeutente();
	$password = $_POST["password"];

	$query =  "INSERT INTO UTENTE VALUES('$email', '$password', 25)";
	//echo $query;
	exec_non_query($query);
}
function Im_like_and_i_know_it()
{
	$edificio = $_POST["edificio"];
	$id_edificio = get_idedificio($edificio);
	$email = get_nomeutente();
	$email_commento = $_POST["email_commento"];
	$nomestanza = $_POST["stanza"];
	$timestamp = $_POST["timestamp"];

	$query =  "INSERT INTO VOTO VALUES($id_edificio, '$nomestanza', '$email_commento', $timestamp, '$email', 1)";
	//echo $query;
	exec_non_query($query);
}
function Im_neutral_and_i_know_it()
{
	$edificio = $_POST["edificio"];
	$id_edificio = get_idedificio($edificio);
	$email = get_nomeutente();
	$email_commento = get_nomeutente();
	$nomestanza = $_POST["stanza"];
	$timestamp = $_POST["timestamp"];

	$query =  "INSERT INTO VOTO VALUES($id_edificio, '$nomestanza', '$email_commento', $timestamp, '$email', 0)";
	//echo $query;
	exec_non_query($query);
}
function Im_dislike_and_i_know_it()
{
	$edificio = $_POST["edificio"];
	$id_edificio = get_idedificio($edificio);
	$email = get_nomeutente();
	$email_commento = $_POST["email_commento"];
	$nomestanza = $_POST["stanza"];
	$timestamp = $_POST["timestamp"];

	$query =  "INSERT INTO VOTO VALUES($id_edificio, '$nomestanza', '$email_commento', $timestamp, '$email', -1)";
	//echo $query;
	exec_non_query($query);
}

class Stanza
{
	public $nome = '';
	public $edificio = '';
	public $capienza = 0;
	public $commenti = array();
}
class Commento
{
	public $email = '';
	public $timestamp = 0;
	public $testo = '';
	public $likes = 0;
	public $dislike = 0;
	public $quante_persone = 0;
}
function get_stanze_libere_adesso_ma_devo_aggiungere_i_likes($edificio, $adesso)
{
	$stanze = array();

	$servername = "fdb13.atspace.me";
	$username = "1762595_maindb";
	$password = "Ciao1234";
	$dbname = "1762595_maindb";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

	$query =
	"
		SELECT STANZA.nome AS nome, EDIFICIO.nome_corto AS edificio, STANZA.capienza AS capienza
		FROM EVENTO,EDIFICIO,STANZA
		WHERE
			EDIFICIO.id_edificio = EVENTO.id_edificio AND
			STANZA.id_edificio = EVENTO.id_edificio AND
			STANZA.nome = EVENTO.nome_stanza AND
			(EVENTO.inizio > $adesso OR EVENTO.fine < $adesso) AND
			EDIFICIO.nome_corto LIKE '$edificio' AND
			STANZA.nome NOT IN
			(
				SELECT STANZA.nome AS nome
				FROM EVENTO,EDIFICIO,STANZA
				WHERE
					EDIFICIO.id_edificio = EVENTO.id_edificio AND
					STANZA.id_edificio = EVENTO.id_edificio AND
					STANZA.nome = EVENTO.nome_stanza AND
					(inizio <= $adesso AND fine >= $adesso) AND
					EDIFICIO.nome_corto LIKE '$edificio'
				GROUP BY STANZA.nome
			)
		GROUP BY STANZA.nome, EDIFICIO.nome_corto, STANZA.capienza, EDIFICIO.id_edificio
	";

	$result = $conn->query($query);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$s = new Stanza();
			$s->nome = $row["nome"];
			$s->edificio = $row["edificio"];
			$s->capienza = $row["capienza"];
			$stanze[] = $s;
		}
	}
	$conn->close();
	return $stanze;
}
function get_stanze_adesso()
{
	date_default_timezone_set('Europe/Rome');
	$edificio = $_POST["edificio"];
	$adesso = time();

	$stanze = get_stanze_libere_adesso_ma_devo_aggiungere_i_likes($edificio, $adesso);


	$servername = "fdb13.atspace.me";
	$username = "1762595_maindb";
	$password = "Ciao1234";
	$dbname = "1762595_maindb";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	//aggiungo i commenti
	foreach ($stanze as &$s)
	{


		$edif = get_idedificio($s->edificio);

		$nomes = $s->nome;
		$query =
		"SELECT email_utente AS email, VOTO.time_unix AS tempo, testo AS commento, persone AS quante_persone, SUM(CASE WHEN valore = 1 THEN 1 ELSE 0 END) AS likes, SUM(CASE WHEN valore = -1 THEN 1 ELSE 0 END) AS dislikes
		FROM COMMENTO, VOTO
		WHERE
			COMMENTO.id_edificio = $edif AND
			COMMENTO.nome_stanza = '$nomes' AND
			VOTO.id_edificio    = COMMENTO.id_edificio AND
			VOTO.nome_stanza    = COMMENTO.nome_stanza AND
			VOTO.email_commento = COMMENTO.email_utente AND
			VOTO.time_unix      = COMMENTO.time_unix
		GROUP BY email_utente, VOTO.time_unix, testo, persone
        ORDER BY COMMENTO.time_unix DESC";

		//echo $query."<br />";

		$result = $conn->query($query);
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$c = new Commento();
				$c->email = $row["email"];
				$c->timestamp = $row["tempo"];
				$c->testo = $row["commento"];
				$c->likes = $row["likes"];
				$c->dislike = $row["dislikes"];
				$c->quante_persone = $row["quante_persone"];

				$s->commenti[] = $c;
			}
		}
	}
	$conn->close();


	return $stanze;
}



?>
