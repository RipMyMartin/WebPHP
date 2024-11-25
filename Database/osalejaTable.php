<?php
require "conf.php";
//require "confZone.php";

//kustutamine
if (isset($_REQUEST["kustuta"])){
    global $yhendus;
    $kask = $yhendus->prepare("DELETE FROM osaleja WHERE id=?");
    $kask ->bind_param("i",$_REQUEST["kustuta"]);
    $kask ->execute();
}

//lisamine
if (isset($_REQUEST['nimi'])
    && !empty($_REQUEST['nimi'])
    && !empty($_REQUEST['telefon'])
    && !empty($_REQUEST['pilt'])
    && !empty($_REQUEST['synniaeg'])) {
    global $yhendus;
    $paring = $yhendus ->prepare("INSERT INTO osaleja(nimi,telefon,pilt,synniaeg) VALUES(?,?,?,?)");
    $paring -> bind_param("siss" ,$_REQUEST['nimi'], $_REQUEST['telefon'], $_REQUEST['pilt'], $_REQUEST['synniaeg']);
    $paring -> execute();
}

//tabeli sisu
global $yhendus;
$paring = $yhendus->prepare("SELECT id, nimi, telefon, pilt, synniaeg FROM osaleja");
$paring->bind_result($id, $nimi, $telefon, $pilt, $synniaeg);
$paring->execute();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Osaleja database</title>
</head>
<body>
<h1>Osaleja database</h1>

<!--väljastame nimet-->
<table>
    <tr>
        <th></th>
        <th>id</th>
        <th>nimi</th>
        <th>telefon</th>
        <th>pilt</th>
        <th>Vanus</th>
    </tr>
    <?php
    //väljastame andmed on andmebaasis
    while ($paring->fetch()) {
        //arvutame datetime'ist vanuse
        $vanus = date_diff(date_create($synniaeg), date_create('today'))->y;
        echo "<tr>";
        echo "<td><a href='?kustuta=$id'>X</a> </td>";
        echo "<td>" . $id . "</td>";
        echo "<td>" . htmlspecialchars($nimi) . "</td>";
        echo "<td>" . htmlspecialchars($telefon) . "</td>";
        echo "<td> <img src='$pilt' alt='osaleja_pilt' width='60px'> </td>";
        echo "<td> $vanus </td>";
        echo "</tr>";
    }
    ?>
</table>
<!--osalejate sisestamine-->
<h1>Osalejate lisamine</h1>
<form action="?" method="post">
    <label for="nimi">Nimi</label>
    <input type="text" id="nimi" name="nimi">
    <br>
    <label for="telefon">Telefon</label>
    <input type="text" id="telefon" name="telefon">
    <br>
    <label for="pilt">Pilt</label>
    <input type="text" id="pilt" name="pilt">
    <br>
    <label for="synniaeg">Synniaeg</label>
    <input type="date" id="synniaeg" name="synniaeg">
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
