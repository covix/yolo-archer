<?php

function get_username()
{
    echo "get ";
    print_r($_COOKIE);
    return $_COOKIE['name'];
}

?>
