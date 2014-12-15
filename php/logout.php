<?php

include 'api.php';

if (isset($_SESSION['email']))
{
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
}
header("Location: /index.php");

die( "aiuto aiuto");
echo "coviello cagna canshielloooo";

?>
