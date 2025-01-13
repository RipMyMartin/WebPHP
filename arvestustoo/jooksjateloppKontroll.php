<?php
require ('../Database/conf.php');
require "user_handler/logout.inc.php";

global $yhendus;

if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
if (isset($_REQUEST["loppaeg"])) {
    $kask = $yhendus->prepare("UPDATE jooksjad SET lopetamisaeg = NOW() WHERE id = ?");
    $kask->bind_param("i", $_REQUEST["loppaeg"]);
    $kask->execute();
}
if (isset($_REQUEST["loppaeg"])) {
    $kask = $yhendus->prepare("UPDATE jooksjad SET vaheaeg = 0 WHERE id = ?");
    $kask->bind_param("i", $_REQUEST["loppaeg"]);
    $kask->execute();
}

$paring = $yhendus->prepare("SELECT id, eesnimi, perenimi, alustamisaeg, lopetamisaeg, vaheaeg FROM jooksjad WHERE vaheaeg >= 2");
$paring->bind_result($id, $eesnimi, $perenimi, $alustamisaeg, $lopetamisaeg, $vaheaeg);
$paring->execute();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jooksjate Vaheaeg</title>
</head>
<body>
<?php
include "JooksjadHeader.php";
include "jooksjateNav.php";
?>

<table>
    <tr>
        <th>id</th>
        <th>Eesnimi</th>
        <th>Perenimi</th>
        <th>Algusaeg</th>
        <th>Lõppaeg</th>
        <th>Vaheaeg</th>
        <th>Lõppaeg nupp</th>
    </tr>

    <?php
    while ($paring->fetch()) {

        if ($lopetamisaeg !== null) {
            continue;
        }
        echo "<tr>";
        echo "<td>".$id."</td>";
        echo "<td>".htmlspecialchars($eesnimi)."</td>";
        echo "<td>".htmlspecialchars($perenimi)."</td>";
        echo "<td>".htmlspecialchars($alustamisaeg)."</td>";

        $lopetamisaeg_display = $lopetamisaeg ? htmlspecialchars($lopetamisaeg) : "ei loppenud";
        echo "<td>".$lopetamisaeg_display."</td>";

        echo "<td>".htmlspecialchars($vaheaeg)."</td>";
        echo "<td><a class='button-link' href='?loppaeg=$id'>Lõpp</a></td>";
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
