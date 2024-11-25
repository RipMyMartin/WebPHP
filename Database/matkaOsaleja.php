<?php
require "conf.php";

//kustutamine
global $yhendus;
if (isset($_REQUEST["kustuta"])){
    $kask = $yhendus->prepare("DELETE FROM osaleja WHERE id=?");
    $kask->bind_param("i",$_REQUEST["kustuta"]);
    $kask->execute();
}

//tabeli andmete lisamine
if (isset($_REQUEST['uusOsaleja']) && !empty($_REQUEST['nimi']) && !empty($_REQUEST['telefon']) && !empty($_REQUEST['pilt']) && !empty($_REQUEST['synniaeg'])) {
    global $yhendus;
    $paring = $yhendus->prepare("INSERT INTO osaleja(nimi, telefon, pilt, synniaeg) VALUES (?, ?, ?, ?)");
    $paring->bind_param("ssss", $_REQUEST['nimi'], $_REQUEST['telefon'], $_REQUEST['pilt'], $_REQUEST['synniaeg']);
    $paring->execute();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Matka osalejad</title>
</head>
<body>
<h1>Matka osalejad</h1>
<div class="nuppLisa">
    <?php
    echo '<a href="?lisamine=jah">LISA...</a>';

    ?>
</div>
<div class="main">
    <table>
        <tr>
            <th></th>
            <th></th>
        </tr><?php
        global $yhendus;
        $paring = $yhendus->prepare("SELECT id, nimi, telefon, pilt, synniaeg FROM osaleja");
        $paring->bind_result($id, $nimi, $telefon, $pilt, $synniaeg);
        $paring->execute();
        $counter = 0;

        echo "<table>";
        while ($paring->fetch()) {
            if ($counter % 2 == 0) {
                echo "<tr>";
            }
            echo "<td><a href='?osaleja_id=$id'> <img src='$pilt' alt='MatkaOsalejad' width='100' height='100'></a> </td>";

            if ($counter % 2 == 1) {
                echo "</tr>";
            }
            $counter++;
        }
        if ($counter % 2 == 1) {
            echo "</tr>";
        }
        echo "</table>";
        ?>

    </table>
</div>

<div class="clickInfo">
    <?php
    // kui klcik looma nimele, siis näitame looma info

    if(isset($_REQUEST["osaleja_id"])){
        $paring=$yhendus->prepare("SELECT id, nimi, telefon,pilt, synniaeg FROM osaleja WHERE id=?");
        $paring->bind_result($id, $nimi, $telefon, $pilt, $synniaeg);
        $paring->bind_param("i", $_REQUEST["osaleja_id"]);
        $paring->execute();

        //näitame ühe kaupa
        if($paring->fetch()){
            $vanus = date_diff(date_create($synniaeg), date_create('today'))->y;
            echo "<div class='selectDiv'> Nimi: ".$nimi;
            echo "<br> Number: ".$telefon;
            echo "<br><img src='$pilt' alt='osaleja pilt' width='100px'>";
            echo "<br>Vanus: ".$vanus;
            echo "<br><a href='?kustuta=$id'>X</a></br>";
            echo "</div>";
        }
    }
    ?>
</div>

<div class="lisaDiv">
    <?php
    //lisamis vorm mis avatakse kui vajutatud lisa...
    if(isset($_REQUEST["lisamine"])){
        ?>
        <form action="?" method="post">
            <input type="hidden" value="jah" name="uusOsaleja">
            <label for="nimi">Nimi</label>
            <input type="text" id="nimi" name="nimi">
            <br>
            <label for="telefon">telefon</label>
            <input type="text" id="telefon" name="telefon">
            <br>
            <label for="pilt">pilt</label>
            <input type="text" id="pilt" name="pilt">
            <br>
            <label for="synniaeg">sünniaeg</label>
            <input type="date" id="synniaeg" name="synniaeg">
            <br>
            <input type="submit" value="oK">
        </form>
        <?php
    }
    ?>
</div>

</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 0;
        width: 100%;
        max-width: 1000px;
        margin: auto;
    }

    .selectDiv{
        border: #181818 solid;
        width: 60%;
        margin: auto;
    }

    h1 {
        text-align: center;
        color: #5c6bc0;
    }

    .main {
        background-color: #333;
        padding: 15px;
        color: white;
        text-align: center;
        margin-bottom: 20px;
    }
    .nuppLisa a{
        text-align: center;
    }
    .nuppLisa {
        text-align: center;
        margin-top: 20px;
    }

    #menu a, .nuppLisa a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #5c6bc0;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        width: 200px;
        text-align: center;
    }

    #menu a:hover, .nuppLisa a:hover {
        background-color: #3f51b5;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: auto;
        table-layout: fixed;
    }

    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
        background-color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    td img {
        border: #181818 solid 1px;
        width: 100px;
        height: 100px;
    }

    .clickInfo, .lisaDiv, .nuppLisa {
        margin: 20px;
    }

    .clickInfo div {
        border: solid 1px #71797E;
        padding: 20px;
        background-color: #fafafa;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .clickInfo a {
        text-decoration: none;
        color: red;
    }

    form {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: auto;
    }

    form input[type="text"],
    form input[type="color"],
    form input[type="date"],
    form input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    form input[type="submit"] {
        background-color: #5c6bc0;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form input[type="submit"]:hover {
        background-color: #3f51b5;
    }

    form label {
        font-weight: bold;
        display: block;
        margin-bottom: 8px;
    }

    .main a {
        color: white;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

</style>
