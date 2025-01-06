<?php
require ('../Database/conf.php');
require "user_handler/logout.inc.php";

//kustutamine
global $yhendus;
if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'kasutaja') {
    header("Location: login.php");
    exit();
}
if (isset($_REQUEST["kustuta"])) {
    $kask = $yhendus->prepare("DELETE FROM jooksjad WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustuta"]);
    $kask->execute();
}

//tabeli andmete lisamine
if (isset($_REQUEST['eesnimi']) && !empty($_REQUEST['perenimi'])) {
    global $yhendus;

    $paring = $yhendus->prepare("INSERT INTO jooksjad(eesnimi, perenimi) VALUES (?, ?)");
    $paring->bind_param("ss", $_REQUEST['eesnimi'], $_REQUEST['perenimi']);
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
    <title>Jooksjad 1 kaupa</title>
</head>
<body>
<?php
include ('jooksjateNav.php')
?>
<div id="menu">

    <h1>Jooksjad lisamine</h1>
    <?php
    echo '<a href="?lisamine=jah">LISA...</a>';
    ?>
</div>


<?php
//lisamisvorm, mis avatakse, kui vajutatakse lisa
if (isset($_REQUEST["lisamine"])) {
    ?>
    <form action="?" method="post">
        <input type="hidden" value="jah" name="uusJooksja">
        <label for="eesnimi">Eesnimi</label>
        <input type="text" id="eesnimi" name="eesnimi">
        <br>
        <label for="perenimi">Perenimi</label>
        <input type="text" id="perenimi" name="perenimi">
        <br>
        <input type="submit" value="OK">
    </form>
    <?php
}
?>
</body>
</html>

<style>


    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: space-around;
    }

    nav ul li {
        margin: 0 10px;
    }

    nav ul li a {
        text-decoration: none;
        color: white;
        font-size: 16px;
        font-weight: bold;
        transition: color 0.3s;
    }

    nav ul li a:hover {
        color: #ff6347;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: auto;
        padding: 0;
        width: 50%;
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

    form input[type="text"],
    form input[type="datetime-local"],
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
