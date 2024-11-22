<?php
require ('conf.php');

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
        <th>id</th>
        <th>loomaNimi</th>
        <th>omanik</th>
        <th>värv</th>
        <th>loomapilt</th>
    </tr>


<?php

while($paring->fetch()){
    echo "<tr>";
    echo "<td>".$id."</td>";
    echo "<td>".htmlspecialchars($loomaNimi)."</td>";
    echo "<td>".htmlspecialchars($omanik)."</td>";
    echo "<td bgcolor='$varv'>".htmlspecialchars($varv)."</td>";
    echo "<td><img src='$pilt' alt='looma pilt' width='60px'></td>";
    echo "</tr>";
}
?>

</table>
</body>
</html>

<?php
$yhendus->close();
?>

<style>
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