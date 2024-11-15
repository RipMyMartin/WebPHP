<?php
$autod = simplexml_load_file("autod.xml");

function otsingNumbriAutonumbriJargi($paring)
{
    global $autod;
    $paringVastus = array();
    foreach ($autod-> auto as $auto) {
        if (substr(strtolower($auto->autonumber), 0, strlen($paring)) == strtolower($paring))
        {
            array_push($paringVastus, $auto);
        }
    }
    return $paringVastus;
}
?>

<!doctype html>
<html lang="et">
<head>
    <title>Document</title>
</head>
<body>
<h2>Autode andmed XML failist</h2>


<div>
    <p>Esimene auto andmed</p>
    <?php
    echo $autod->auto[0]->mark;
    echo ", ";
    echo $autod->auto[0]->autonumber;
    echo ", ";
    echo $autod->auto[0]->omanik;
    echo ", ";
    echo $autod->auto[0]->v_aasta;
    ?>

</div>
<br>

<form action="?" method="post">
    <label for="otsing">Otsing</label>
    <input type="text" id="otsing" name="otsing" placeholder="autonumber">
    <input type="submit" value="oK">
</form>
<br>

<?php
if (!empty($_POST['otsing'])) {
    $paringVastus = otsingNumbriAutonumbriJargi($_POST['otsing']);
    echo "<table>";
    echo "<tr>";
        echo "<th>Otsing</th>";
        echo "<th>Autonumber</th>";
        echo "<th>Omni</th>";
        echo "<th>Väljastamise aasta</th>";
    echo "</tr>";

    foreach ($paringVastus as $auto) {
        echo "<tr>";
        echo "<td>".$auto->mark."</td>";
        echo "<td>".$auto->autonumber."</td>";
        echo "<td>".$auto->omanik."</td>";
        echo "<td>".$auto->v_aasta."</td>";
        echo "</tr>";
    }
    echo "</table>";
}else{



?>

<table>
    <tr>
        <th>Mark</th>
        <th>Autonumber</th>
        <th>Omanik</th>
        <th>Väljastamise aasta</th>
    </tr>
    <?php
    foreach ($autod as $auto) {
        echo "<tr>";
        echo "<td>".$auto->mark."</td>";
        echo "<td>".$auto->autonumber."</td>";
        echo "<td>".$auto->omanik."</td>";
        echo "<td>".$auto->v_aasta."</td>";
        echo "</tr>";

    }

    ?>
</table>

<?php
}


?>
</body>
</html>

<style>

    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 40%;
        border: 1px solid #ddd;
    }

    th, td {
        text-align: left;
        padding: 16px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
