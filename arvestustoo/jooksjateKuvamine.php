<?php
require ('../Database/conf.php');
require "user_handler/logout.inc.php";

//kustutamine
global $yhendus;

if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
if (isset($_REQUEST["kustuta"])) {
    $kask = $yhendus->prepare("DELETE FROM jooksjad WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustuta"]);
    $kask->execute();
}

if (isset($_REQUEST["algusaeg_kogu"])) {
    $kask = $yhendus->prepare("UPDATE jooksjad SET alustamisaeg = NOW() WHERE alustamisaeg IS NULL");
    $kask->execute();
}

if (isset($_REQUEST["algusaeg"])) {
    $kask = $yhendus->prepare("UPDATE jooksjad SET alustamisaeg = NOW() WHERE id = ?");
    $kask->bind_param("i", $_REQUEST["algusaeg"]);
    $kask->execute();
}

//tabeli andmete lisamine
if (isset($_REQUEST['uusJooksja']) && !empty($_REQUEST['eesnimi']) && !empty($_REQUEST['perenimi']) && !empty($_REQUEST['alustamisaeg']) && !empty($_REQUEST['lopetamisaeg'])) {
    global $yhendus;
    $paring = $yhendus->prepare("INSERT INTO jooksjad(eesnimi, perenimi, alustamisaeg, lopetamisaeg) VALUES (?, ?, ?, ?)");
    $paring->bind_param("ssss", $_REQUEST['eesnimi'], $_REQUEST['perenimi'], $_REQUEST['alustamisaeg'], $_REQUEST['lopetamisaeg']);
    $paring->execute();
}

$paring = $yhendus->prepare("SELECT id, eesnimi, perenimi, alustamisaeg, lopetamisaeg, vaheaeg FROM jooksjad");
$paring->bind_result($id, $eesnimi, $perenimi, $alustamisaeg, $lopetamisaeg, $vaheaeg);
$paring->execute();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>jooksjate vaheaeg</title>
</head>
<body>
<?php
include "JooksjadHeader.php";
include "jooksjateNav.php";
echo "
<div class='button-container'>
    <td><a class='button-link2' href='?algusaeg_kogu=$id'>All start</a></td>
</div>
"
?>

<table>
    <tr>
        <th>id</th>
        <th>Eesnimi</th>
        <th>Perenimi</th>
        <th>Algusaeg</th>
        <th>Kustuta</th>
    </tr>

    <?php
    while ($paring->fetch()) {

        if ($alustamisaeg !== null) {
            continue;
        }

        $startTime = strtotime($alustamisaeg);
        $endTime = strtotime($lopetamisaeg);
        $elapsedTime = $endTime - $startTime;

        echo "<tr>";
        echo "<td>".$id."</td>";
        echo "<td>".htmlspecialchars($eesnimi)."</td>";
        echo "<td>".htmlspecialchars($perenimi)."</td>";
        echo "<td>".htmlspecialchars($alustamisaeg)."</td>";
        echo "<td><a class='button-link' href='?kustuta=$id'>Delete</a></td>";
        echo "</tr>";
    }

    $paring->close();
    ?>

</table>
</body>
</html>

<?php
$yhendus->close();
?>

<style>
    h1{
        text-align: center;
    }
    .button-link {
        display: inline-block;
        padding: 5px 20px;
        background-color: #007BFF;
        color: white;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        width: 75%;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .button-link:hover {
        background-color: #0056b3;
    }

    .button-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .button-link2 {
        display: inline-block;
        padding: 5px 20px;
        background-color: #007BFF;
        color: white;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        width: 25%;
        height: 1rem;
        font-size: 16px;
        transition: background-color 0.3s ease;
        margin: auto;
    }

    .button-link2:hover {
        background-color: #0056b3;
    }

    body {
        font-family: Arial, sans-serif;
    }

    a {
        color: inherit;
        text-decoration: none;
    }

    table {
        border-collapse: collapse;
        width: 80%;
        margin: 20px auto;
    }

    th, td {
        text-align: left;
        padding: 16px;
        border: 1px solid #ddd;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>