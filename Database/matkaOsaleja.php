<?php
require "conf.php";

global $yhendus;
if (isset($_REQUEST["kustuta"])) {
    $kask = $yhendus->prepare("DELETE FROM osaleja WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustuta"]);
    $kask->execute();
}
if (isset($_REQUEST['uusOsaleja']) && !empty($_REQUEST['nimi']) && !empty($_REQUEST['telefon']) && !empty($_REQUEST['pilt']) && !empty($_REQUEST['synniaeg'])) {
    global $yhendus;

    // Kontrollime, kas telefoninumber sisaldab ainult numbreid
    if (!ctype_digit($_REQUEST['telefon'])) {
        echo "Telefoninumber peab sisaldama ainult numbreid!";
    } else {
        // Kui kõik on korras, lisame andmed andmebaasi
        $paring = $yhendus->prepare("INSERT INTO osaleja(nimi, telefon, pilt, synniaeg) VALUES (?, ?, ?, ?)");
        $paring->bind_param("ssss", $_REQUEST['nimi'], $_REQUEST['telefon'], $_REQUEST['pilt'], $_REQUEST['synniaeg']);
        $paring->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Files in Project</title>
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
            echo "<br> Number: +372 ".$telefon;
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
            <input type="text" id="nimi" name="nimi" required>
            <br>
            <label for="telefon">Telefon</label>
            <input type="tel" id="telefon" name="telefon" pattern="[0-9]+" title="Telefoninumber peab sisaldama ainult numbreid" required>
            <br>
            <label for="pilt">Pilt</label>
            <input type="text" id="pilt" name="pilt" required>
            <br>
            <label for="synniaeg">Sünniaeg</label>
            <input type="date" id="synniaeg" name="synniaeg" required>
            <br>
            <input type="submit" value="OK">
        </form>

        <?php
    }
    ?>
</div>
</body>
</html>