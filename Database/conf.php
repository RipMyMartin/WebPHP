<?php
$kasutaja = "martin";
$parool = "1234";
$andmebaas = "martin";
$servername = "localhost";

$yhendus = new mysqli($servername, $kasutaja, $parool, $andmebaas);
$yhendus->set_charset("utf8");
