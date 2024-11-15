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

<form action="highlight.php" method="post">
    <input type="submit" name="Click" value="Vaadata lehe koodi">
</form>



<h2>Toote sisestamine</h2>
<form action="" method="post" name="vorm1">
    <table>
        <tr>
            <td><label for="nimi">nimi:</label></td>
            <td><input type="text" name="nimi" id="nimi" autofocus required></td>
        </tr>
        <tr>
            <td><label for="nimi_href">Link:</label></td>
            <td><input type="text" name="nimi_href" id="nimi_href" required></td>
        </tr>
        <tr>
            <td><label for="perenimi">perenimi:</label></td>
            <td><input type="text" name="perenimi" id="perenimi" required></td>
        </tr>
        <tr>
            <td><label for="vanus">vanus</label></td>
            <td><input type="text" name="vanus" id="vanus" required></td>
        </tr>
        <tr>
            <td><label for="hobbi">hobbi</label></td>
            <td><input type="text" name="hobbi" id="hobbi" required></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" id="submit" value="Sisesta"></td>
            <td></td>
        </tr>
    </table>
</form>


<?php
if(isset($_POST['submit'])){
    $nimi = $_POST['nimi'];
    $nimi_href = $_POST['nimi_href'];
    $perenimi = $_POST['perenimi'];
    $vanus = $_POST['vanus'];
    $hobbi = $_POST['hobbi'];

    $xmlFile = 'ruhm.xml';
    $xmlDoc = new DOMDocument("1.0", "UTF-8");

    if (file_exists($xmlFile)) {
        $xmlDoc->load($xmlFile);
    } else {
        $root = $xmlDoc->createElement("opilased");
        $xmlDoc->appendChild($root);
    }

    $xmlRoot = $xmlDoc->documentElement;
    $existing = false;

    foreach ($xmlRoot->getElementsByTagName("opilane") as $opilane) {
        if ($opilane->getElementsByTagName("nimi")->item(0)->nodeValue === $nimi) {
            $existing = true;
            $opilane->getElementsByTagName("perenimi")->item(0)->nodeValue = $perenimi;
            $opilane->getElementsByTagName("vanus")->item(0)->nodeValue = $vanus;
            $opilane->getElementsByTagName("hobbi")->item(0)->nodeValue = $hobbi;
            $opilane->getElementsByTagName("nimi")->item(0)->setAttribute("href", $nimi_href);
            break;
        }
    }

    if (!$existing) {
        $opilane = $xmlDoc->createElement("opilane");

        $nimiElement = $xmlDoc->createElement("nimi", $nimi);
        $nimiElement->setAttribute("href", $nimi_href);
        $opilane->appendChild($nimiElement);
        $opilane->appendChild($xmlDoc->createElement("perenimi", $perenimi));
        $opilane->appendChild($xmlDoc->createElement("vanus", $vanus));
        $opilane->appendChild($xmlDoc->createElement("hobbi", $hobbi));

        $xmlRoot->appendChild($opilane);
    }

    $xmlDoc->save($xmlFile);
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