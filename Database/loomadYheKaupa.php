

<?php
require ("conf.php");

//kustutamine
global $yhendus;
if (isset($_REQUEST["kustuta"])){
    $kask = $yhendus->prepare("DELETE FROM loomad WHERE id=?");
    $kask->bind_param("i",$_REQUEST["kustuta"]);
    $kask->execute();
}

//tabeli andmete lisamine
if (isset($_REQUEST['uusLoom']) && !empty($_REQUEST['loomaNimi']) && !empty($_REQUEST['omanik']) &&!empty($_REQUEST['varv']) && !empty($_REQUEST['pilt'])
) {
    global $yhendus;
    $paring = $yhendus->prepare("INSERT INTO loomad(loomaNimi, omanik, varv, pilt) VALUES (?, ?, ?, ?)");
    $paring -> bind_param("ssss", $_REQUEST['loomaNimi'], $_REQUEST['omanik'], $_REQUEST['varv'], $_REQUEST['pilt']);
    $paring -> execute();
}
/*
//tabeli sisu kuvamine
global $yhendus;
$paring=$yhendus->prepare("SELECT id, loomaNimi, omanik, varv, pilt FROM loomad");
$paring->bind_result($id, $loomaNimi, $omanik, $varv, $pilt);
$paring->execute();*/
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Looma 1 kaupa</title>
</head>
<body>
<div id="menu">

<h1>Looma 1 kaupa</h1>
<ul>
    <?php

    //loomade nimed andmebaasist
    global $yhendus;
    $paring=$yhendus->prepare("SELECT id, loomaNimi, omanik, varv, pilt FROM loomad");
    $paring->bind_result($id, $loomaNimi, $omanik, $varv, $pilt);
    $paring->execute();

    while($paring->fetch()){
        echo "<li><a href='?looma_id=$id'>".$loomaNimi."</a></li>";
    }
    ?>

</ul>
    <?php
    echo '<a href="?lisamine=jah">LISA...</a>';

    ?>
</div>

<div id="sisu">
    <?php
    // kui klcik looma nimele, siis näitame looma info

    if(isset($_REQUEST["looma_id"])){
        $paring=$yhendus->prepare("SELECT id, loomaNimi, omanik,varv, pilt FROM loomad WHERE id=?");
        $paring->bind_result($id, $loomaNimi, $omanik, $varv, $pilt);
        $paring->bind_param("i", $_REQUEST["looma_id"]);
        $paring->execute();

        //näitame ühe kaupa
        if($paring->fetch()){
            echo "<div style='border: solid #71797E'> LoomaNimi:".$loomaNimi;
            echo "<br> Tõug: ".$varv;
            echo "<br><img src='$pilt' alt='looma pilt' width='100px'>";
            echo "<br>Omanik: ".$omanik;
            echo "<br><a href='?kustuta=$id'>X</a></br>";
            echo "</div>";
        }
    }
    ?>


</div>
<?php
//lisamis vorm mis avatakse kui vajutatud lisa...
if(isset($_REQUEST["lisamine"])){
?>
    <form action="?" method="post">
        <input type="hidden" value="jah" name="uusLoom">
        <label for="loomaNimi">LoomaNimi</label>
        <input type="text" id="loomaNimi" name="loomaNimi">
        <br>
        <label for="omanik">omanik</label>
        <input type="text" id="omanik" name="omanik">
        <br>
        <label for="varv">Värv</label>
        <input type="color" id="varv" name="varv">
        <br>
        <label for="pilt">pilt</label>
        <input type="text" id="pilt" name="pilt">
        <br>
        <input type="submit" value="oK">
    </form>
<?php
}
?>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    #menu {
        background-color: #333;
        color: white;
        padding: 15px;
        text-align: center;
    }

    #menu h1 {
        margin: 0;
    }

    #menu ul {
        list-style-type: none;
        padding: 0;
    }

    #menu li {
        display: inline-block;
        margin: 10px;
    }

    #menu a {
        color: white;
        text-decoration: none;
        padding: 5px 10px;
        background-color: #5c6bc0;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    #menu a:hover {
        background-color: #3f51b5;
    }

    #menu a:active {
        background-color: #303f9f;
    }

    #sisu {
        width: 60%;
        margin: 20px auto;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    #sisu div {
        padding: 15px;
        border: 1px solid #ddd;
        margin-bottom: 15px;
        background-color: #fafafa;
        border-radius: 8px;
    }

    #sisu img {
        display: block;
        margin-top: 10px;
        border-radius: 8px;
    }

    form input[type="text"],
    form input[type="color"],
    form input[type="submit"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
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

    form input[type="submit"]:active {
        background-color: #303f9f;
    }

    form label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    #menu a[href*="lisamine=jah"] {
        display: inline-block;
        margin-top: 15px;
        background-color: #5c6bc0;
        color: white;
        padding: 8px 15px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    #menu a[href*="lisamine=jah"]:hover {
        background-color: #3f51b5;
    }
</style>

