<?php
if (isset($_GET['code'])) {die(highlight_file(__FILE__));}
?>

<?php
$ruhm = simplexml_load_file("ruhm.xml");


function koikotsing($paring)
{
    global $ruhm;
    $paringVastus = array();
    $paring = strtolower($paring);

    foreach ($ruhm->opilane as $nimi) {
        if (strpos(strtolower($nimi->nimi), $paring) !== false ||
            strpos(strtolower($nimi->perenimi), $paring) !== false ||
            strpos(strtolower($nimi->vanus), $paring) !== false ||
            strpos(strtolower($nimi->hobbi), $paring) !== false) {
            array_push($paringVastus, $nimi);
        }
    }
    return $paringVastus;
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ruhmaleht</title>
</head>
<body>
<h2>TARpv23 rühmaleht</h2>

<form action="?" method="post">
    <label for="otsing">Otsing</label>
    <input type="text" id="otsing" name="otsing" placeholder="nimi, perenimi, vanus, hobbi">
    <input type="submit" value="Otsi">
</form>

<?php
if (!empty($_POST["otsing"])) {
    $paringVastus = koikotsing($_POST["otsing"]);
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nimi</th>";
    echo "<th>Perenimi</th>";
    echo "<th>Vanus</th>";
    echo "<th>Hobbi</th>";
    echo "</tr>";

    $id = 1;
    foreach ($paringVastus as $r) {
        echo "<tr>";
        echo "<th>" . $id++ . "</th>";
        $nimi = isset($r->nimi['href']) ? "<a href='https://" . $r->nimi['href'] . "'>" . $r->nimi . "</a>" : $r->nimi;
        echo "<th>" . $nimi . "</th>";
        echo "<td>" . $r->perenimi . "</td>";
        echo "<td>" . $r->vanus . "</td>";
        echo "<td>" . $r->hobbi . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Nimi</th>
            <th>Perenimi</th>
            <th>Vanus</th>
            <th>Hobbi</th>
        </tr>
        <?php
        $id = 1;
        foreach ($ruhm->opilane as $r) {
            echo "<tr>";
            echo "<th>" . $id++ . "</th>";
            $nimi = isset($r->nimi['href']) ? "<a href='https://" . $r->nimi['href'] . "'>" . $r->nimi . "</a>" : $r->nimi;
            echo "<th>" . $nimi . "</th>";
            echo "<td>" . $r->perenimi . "</td>";
            echo "<td>" . $r->vanus . "</td>";
            echo "<td>" . $r->hobbi . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

<?php
}
?>

<form action="?code" method="post">
    <input type="submit" name="Click" value="Vaadata lehe koodi">
</form>



<h2>Andmete sisestamine</h2>
<form action="" method="post" name="vorm1">
    <table>
        <tr>
            <td><label for="nimi">Nimi:</label></td>
            <td><input type="text" name="nimi" id="nimi" autofocus required></td>
        </tr>
        <tr>
            <td><label for="nimi_href">Link:</label></td>
            <td><input type="text" name="nimi_href" id="nimi_href" required></td>
        </tr>
        <tr>
            <td><label for="perenimi">Perenimi:</label></td>
            <td><input type="text" name="perenimi" id="perenimi" required></td>
        </tr>
        <tr>
            <td><label for="vanus">Vanus</label></td>
            <td><input type="text" name="vanus" id="vanus" required></td>
        </tr>
        <tr>
            <td><label for="hobbi">Hobbi</label></td>
            <td><input type="text" name="hobbi" id="hobbi" required></td>
        </tr>
    </table>
    <table>
        <tr>
            <td><input type="submit" name="submit" id="submit" value="Sisesta"></td>
        </tr>
    </table>
</form>

<?php
if (isset($_POST['submit'])) {
    $xmlDoc = new DOMDocument("1.0", "UTF-8");
    $xmlDoc->preserveWhiteSpace = false; //https://stackoverflow.com/questions/4504811/how-can-i-display-xml-with-whitespace-formatting
    $xmlDoc->load('ruhm.xml');
    $xmlDoc->formatOutput = true; //automatically adds indents and new lines

    $xml_root = $xmlDoc->documentElement;

    $xml_toode = $xmlDoc->createElement("opilane");
    $xml_root->appendChild($xml_toode);
    foreach ($_POST as $voti => $vaartus) {
        if ($voti == 'nimi') {
            $nimi = $_POST['nimi'];
            $nimi_href = isset($_POST['nimi_href']) ? $_POST['nimi_href'] : '';
            $kirje = $xmlDoc->createElement($voti, $nimi);
            $kirje->setAttribute('href', $nimi_href);

        } else {
            $kirje = $xmlDoc->createElement($voti, $vaartus);
        }
        $xml_toode->appendChild($kirje);
    }
    $xmlDoc->save('ruhm.xml');
}
?>



</body>
</html>


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
    h2{
        text-align: center;
    }
</style>