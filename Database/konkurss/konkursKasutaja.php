<?php
require "../conf.php";
global $yhendus;
require "../konkurss/user_handler/logout.inc.php";

?>
<?php

if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'kasutaja') {
    header("Location: login.php");
    exit();
}
//table UPDATE +1 punktid
if (isset($_REQUEST["heaKonkurss_id"])) {
    $paring = $yhendus->prepare("UPDATE konkurss set punktid = punktid+1 WHERE id=?;");
    $paring -> bind_param("i", $_REQUEST["heaKonkurss_id"]);
    $paring -> execute();
}
?>

<?php
//tabeli UPDATE -1 punktid
if (isset($_REQUEST["halbKonkurss_id"])) {
    $paring = $yhendus->prepare("UPDATE konkurss set punktid = punktid -1 WHERE id=?;");
    $paring -> bind_param("i", $_REQUEST["halbKonkurss_id"]);
    $paring -> execute();
}
?>

<?php
//tabeli INSERT
if(!empty($_REQUEST["uusKonkurss"])){
    $paring = $yhendus -> prepare("INSERT INTO konkurss (konkursiNimi, lisamisaeg) values (?, NOW());");
    $paring -> bind_param("s", $_REQUEST["uusKonkurss"]);
    $paring -> execute();

}
?>
<?php
if (isset($_REQUEST["uusKomment"]) && !empty($_POST['komment'])) {
    $komentLisa = "\n" . trim($_POST["komment"]);
    $paring = $yhendus->prepare("UPDATE konkurss SET komentaarid = CONCAT(komentaarid, ?) WHERE id=?;");
    $paring->bind_param("si", $komentLisa, $_REQUEST["uusKomment"]);
    $paring->execute();
    header("Location: $_SERVER[PHP_SELF]");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TARpv23 jõulu konkursid</title>
</head>
<body>
<h2>Jõulu konkurss</h2>
<nav>
    <ul>
        <?php
        if (isset($_SESSION["useruid"])) {
            if ($_SESSION["role"] == "admin") {
                echo '<li><a href="konkursAdmin.php">Admin</a></li>';
            }
            if ($_SESSION["role"] == "kasutaja") {
                echo '<li><a href="konkursKasutaja.php">Kasutaja</a></li>';
                echo '<li><a href="konkursInfo.php">Info</a></li>';
            } else {
                echo '<li><a href="konkursInfo.php">Info</a></li>';
            }
            echo '
            <li>
                <form method="POST">
                    <input type="submit" class="submit-btn2" name="logout" value="Logout">
                </form>
            </li>';
        } else {
            echo '<li><a href="konkursInfo.php">Info</a></li>';
            echo '<li><a href="login.php">Login</a></li>';
            echo '<li><a href="signup.php">Registreeri</a></li>';
        }
        ?>
    </ul>
</nav>

<form action="?" method="post" class="styled-form">
    <label for="uusKonkurss">Lisa konkurssi nimi</label>
    <input type="text" id="uusKonkurss" name="uusKonkurss" class="form-input">
    <br>
    <input type="submit" value="OK" class="submit-btn">
</form>
<br>
<table>
    <tr>
        <th>Konkursi nimi</th>
        <th>Lisamis aeg</th>
        <th>Punktid</th>
        <th colspan="2">Komentaarid</th>
        <th colspan="2" style="text-align: center">Haldus</th>
    </tr>
    <?php
    //tabeli sisu kuvamine
    $paring = $yhendus ->prepare("SELECT id, konkursiNimi, lisamisaeg, punktid, komentaarid FROM konkurss where avalik = 1");
    $paring->bind_result($id, $konkursiNimi, $lisamisaeg, $punktid, $komentaarid);
    $paring-> execute();
    while ($paring->fetch()) {
        echo "<tr>";
        $konkursiNimi = htmlspecialchars($konkursiNimi);
        $komentaarid = nl2br(htmlspecialchars($komentaarid));
        echo "<td>" . $konkursiNimi . "</td>";
        echo "<td>" . $lisamisaeg . "</td>";
        echo "<td>" . $punktid . "</td>";
        echo "<td>" . $komentaarid . "</td>";
        ?>
        <td>
            <form action="?" method="post">
                <input type="hidden" name="uusKomment" value="<?= $id ?>">
                <input type="text" name="komment" id="komment" class="komentStyle">
                <input type="submit" value="Lisa" class="submit-btn">
            </form>
        </td>
        <?php

        echo "<td><a class='button-link' href='?heaKonkurss_id=$id'>+1 punkt</a></td>";
        echo "<td><a class='button-link' href='?halbKonkurss_id=$id'>-1 punkt</a></td>";
        echo "</tr>";
    }

    ?>
</table>

</body>
</html>
<?php $yhendus -> close();?>

<style>
    .komentStyle{

    }

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
    .submit-btn2{
        color: white;
        background-color: red;
        border: none;
        font-size: 16px;
        font-weight: bold;
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

    .button-link {
        display: inline-block;
        padding: 5px 20px;
        background-color: #007BFF;
        color: white;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .button-link:hover {
        background-color: #0056b3;
    }

    .styled-form {
        width: 300px;
        margin: 50px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }

    .styled-form label {
        display: block;
        font-size: 14px;
        margin-bottom: 8px;
        color: #333;
    }

    .form-input {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 20px;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }

    .form-input:focus {
        border-color: #007BFF;
        outline: none;
    }

    .submit-btn {
        width: 100%;
        padding: 12px;
        background-color: #007BFF;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #0056b3;
    }

    nav {
        background-color: #333;
        padding: 10px;
        border-radius: 5px;
        width: 25%;
        margin: 0 auto;
    }

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

</style>