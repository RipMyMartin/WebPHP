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

$paring_top = $yhendus->prepare("SELECT id, eesnimi, perenimi, alustamisaeg, lopetamisaeg, vaheaeg FROM jooksjad WHERE vaheaeg >= 2 ORDER BY vaheaeg ASC LIMIT 3");
$paring_top->bind_result($id_top, $eesnimi_top, $perenimi_top, $alustamisaeg_top, $lopetamisaeg_top, $vaheaeg_top);
$paring_top->execute();

$top_runners = [];
while ($paring_top->fetch()) {
    $top_runners[] = [
        'id' => $id_top,
        'eesnimi' => $eesnimi_top,
        'perenimi' => $perenimi_top,
        'alustamisaeg' => $alustamisaeg_top,
        'lopetamisaeg' => $lopetamisaeg_top,
        'vaheaeg' => $vaheaeg_top
    ];
}
$paring_top->close();

$paring_rest = $yhendus->prepare("
    SELECT j.id, j.eesnimi, j.perenimi, j.alustamisaeg, j.lopetamisaeg, j.vaheaeg
    FROM jooksjad j
    LEFT JOIN (
        SELECT id
        FROM jooksjad
        WHERE vaheaeg >= 2
        ORDER BY vaheaeg ASC
        LIMIT 3
    ) AS top3 ON j.id = top3.id
    WHERE j.vaheaeg >= 2 AND top3.id IS NULL
    ORDER BY j.vaheaeg ASC
");

$paring_rest->bind_result($id_rest, $eesnimi_rest, $perenimi_rest, $alustamisaeg_rest, $lopetamisaeg_rest, $vaheaeg_rest);
$paring_rest->execute();

$rest_runners = [];
while ($paring_rest->fetch()) {
    $rest_runners[] = [
        'id' => $id_rest,
        'eesnimi' => $eesnimi_rest,
        'perenimi' => $perenimi_rest,
        'alustamisaeg' => $alustamisaeg_rest,
        'lopetamisaeg' => $lopetamisaeg_rest,
        'vaheaeg' => $vaheaeg_rest
    ];
}
$paring_rest->close();
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
include "jooksjateNav.php";
?>

<h2>Top 3 Best Times</h2>
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
    foreach ($top_runners as $runner) {
        echo "<tr>";
        echo "<td>".$runner['id']."</td>";
        echo "<td>".htmlspecialchars($runner['eesnimi'])."</td>";
        echo "<td>".htmlspecialchars($runner['perenimi'])."</td>";
        echo "<td>".htmlspecialchars($runner['alustamisaeg'])."</td>";

        $lopetamisaeg_display_top = $runner['lopetamisaeg'] ? htmlspecialchars($runner['lopetamisaeg']) : "ei loppenud";
        echo "<td>".$lopetamisaeg_display_top."</td>";

        echo "<td>".htmlspecialchars($runner['vaheaeg'])."</td>";
        echo "<td><a class='button-link' href='?loppaeg=".$runner['id']."'>Lõpp</a></td>";
        echo "</tr>";
    }
    ?>

</table>

<h2>Remaining Runners</h2>
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
    foreach ($rest_runners as $runner) {
        echo "<tr>";
        echo "<td>".$runner['id']."</td>";
        echo "<td>".htmlspecialchars($runner['eesnimi'])."</td>";
        echo "<td>".htmlspecialchars($runner['perenimi'])."</td>";
        echo "<td>".htmlspecialchars($runner['alustamisaeg'])."</td>";

        $lopetamisaeg_display_rest = $runner['lopetamisaeg'] ? htmlspecialchars($runner['lopetamisaeg']) : "ei loppenud";
        echo "<td>".$lopetamisaeg_display_rest."</td>";

        echo "<td>".htmlspecialchars($runner['vaheaeg'])."</td>";
        echo "<td><a class='button-link' href='?loppaeg=".$runner['id']."'>Lõpp</a></td>";
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
