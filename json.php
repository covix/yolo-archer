<?php
$jsondata = file_get_contents("bla.json");
//echo $jsondata;


$json = json_decode($jsondata, true);

foreach ($json as $item)
{
    foreach ($item['assets']['RAM'] as $asset)
    {
        echo $asset['model'].'<br />';
    }
}
?>