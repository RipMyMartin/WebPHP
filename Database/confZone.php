<?php
//Zone.ee kasutaja jaoks
$servername = "d132042.mysql.zonevs.eu";
$kasutaja = "d132042_sildmartindb";
$parool = "*********";
$andmebaas = "d132042_webphp";

$yhendus = new mysqli($servername, $kasutaja, $parool, $andmebaas);
$yhendus->set_charset("utf8");
?>
