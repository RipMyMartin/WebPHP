<?php
require ('conf.php');
//require ('confZone.php');
//kustutamine
global $yhendus;
if (isset($_REQUEST["kustuta"])){
    $kask = $yhendus->prepare("DELETE FROM loomad WHERE id=?");
    $kask->bind_param("i",$_REQUEST["kustuta"]);
    $kask->execute();
}
//tabeli andmete lisamine
if (isset($_REQUEST['loomaNimi']) && !empty($_REQUEST['loomaNimi']) && !empty($_REQUEST['omanik']) &&!empty($_REQUEST['varv']) && !empty($_REQUEST['pilt'])
) {
    global $yhendus;
    $paring = $yhendus->prepare("INSERT INTO loomad(loomaNimi, omanik, varv, pilt) VALUES (?, ?, ?, ?)");
    $paring -> bind_param("ssss", $_REQUEST['loomaNimi'], $_REQUEST['omanik'], $_REQUEST['varv'], $_REQUEST['pilt']);
    $paring -> execute();
}
//tabeli sisu kuvamine
global $yhendus;
$paring=$yhendus->prepare("SELECT id, loomaNimi, omanik, varv, pilt FROM loomad");
$paring->bind_result($id, $loomaNimi, $omanik, $varv, $pilt);
$paring->execute();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabeli sisu mida võetakse db seest</title>
</head>
<body>
<h1>Loomad andmebaasist</h1>

<table>
    <tr>
        <th></th>
        <th>id</th>
        <th>loomaNimi</th>
        <th>omanik</th>
        <th>värv</th>
        <th>loomapilt</th>
    </tr>


<?php

while($paring->fetch()){
    echo "<tr>";
    echo "<td><a href='?kustuta=$id'>X</a></td>";
    echo "<td>".$id."</td>";
    echo "<td>".htmlspecialchars($loomaNimi)."</td>";
    echo "<td>".htmlspecialchars($omanik)."</td>";
    echo "<td bgcolor='$varv'>".htmlspecialchars($varv)."</td>";
    echo "<td><img src='$pilt' alt='looma pilt' width='60px'></td>";
    echo "</tr>";
}
?>
</table>
<h1>Uue looma lisamine</h1>
<form action="?" method="post">
    <label for="loomaNimi">LoomaNimi</label>
    <input type="text" id="loomaNimi" name="loomaNimi">
    <br>
    <label for="omanik">omanik</label>
    <input type="text" id="omanik" name="omanik">
    <br>
    <label for="varv">Värv</label>
    <input type="color" id="varv" name="varv">
    <br>
    <label for="pilt">pilt</label>
    <input type="text" id="pilt" name="pilt">
    <br>
    <input type="submit" value="oK">
</form>
</body>
</html>

<?php
$yhendus->close();
?>

<style>
    form{
        background-color: #71797E;
        margin: auto;
    }

    body{
        font-family: Arial, sans-serif;
    }
    a{
        color: inherit;
        text-decoration: none;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 50%;
        height: 50%;
        border: 1px solid #ddd;
        column-count: 2;
        column-gap: 20px;
        margin: auto;
    }

    th, td {
        text-align: left;
        padding: 16px;
        border: solid #DCDCDC;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    h1{
        text-align: center;
    }
</style>