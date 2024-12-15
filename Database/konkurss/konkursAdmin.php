<?php require "../conf.php"; global $yhendus; ?>

<?php
//laua peidmine
if (isset($_REQUEST["peitmine_id"])){
    $paring = $yhendus-> prepare("UPDATE konkurss set avalik=0 where id =?;");
    $paring->bind_param('i', $_REQUEST["peitmine_id"]);
    $paring->execute();
}
?>

<?php
//laua kuvamine/näitamine
if (isset($_REQUEST["naitmine_id"])){
    $paring = $yhendus -> prepare("UPDATE konkurss set avalik=1 where id =?;");
    $paring->bind_param('i', $_REQUEST["naitmine_id"]);
    $paring->execute();
}
?>

<?php
//table UPDATE +1 punktid
if (isset($_REQUEST["heaKonkurss_id"])) {
    $paring = $yhendus->prepare("UPDATE konkurss set punktid = 0 WHERE id=?;");
    $paring -> bind_param("i", $_REQUEST["heaKonkurss_id"]);
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
//komment DELETE
if (isset($_REQUEST["delKomment"])) {
    $paring = $yhendus -> prepare("UPDATE konkurss SET komentaarid = ' ' WHERE id = ?;");
    $paring -> bind_param("s", $_REQUEST["delKomment"]);
    $paring -> execute();
}
?>

<?php
//tabeli DELETE
if (isset($_REQUEST["delKonkurss"])) {
    $paring = $yhendus->prepare("DELETE FROM konkurss WHERE id=?");
    $paring -> bind_param("i",$_REQUEST["delKonkurss"]);
    $paring -> execute();
}
?>

<?php
//Komment INSERT
if (isset($_REQUEST["uusKomment"])){
    $paring = $yhendus ->prepare("UPDATE konkurss SET komentaarid = CONCAT(komentaarid,?) WHERE id=?; ");
    $komentLisa = "\n".$_REQUEST["komment"];
    $paring -> bind_param("si", $komentLisa, $_REQUEST["uusKomment"]);
    $paring -> execute();
    header("Location:$_SERVER[PHP_SELF]");
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
        <li><a href="konkursAdmin.php">Admin</a></li>
        <li><a href="konkursKasutaja.php">Kasutaja</a></li>
        <li><a href="konkursInfo.php">Info</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="signup.php">Registreerimine</a></li>
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
        <th colspan="3">Näita konkurs</th>
    </tr>
    <?php
    //tabeli sisu kuvamine
    $paring = $yhendus ->prepare("SELECT id, konkursiNimi, lisamisaeg, punktid, komentaarid, avalik FROM konkurss");
    $paring->bind_result($id, $konkursiNimi, $lisamisaeg, $punktid, $komentaarid, $avalik);
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
                <input type="hidden" name="delKomment" value=<?="$id"?>>
                <input type="submit" value="DELETE" class="submit-btn">
            </form>
        </td>
        <?php
        echo "<td><a class='button-link' href='?heaKonkurss_id=$id'>SET punkt 0</a></td>";
        echo "<td><a class='button-link' href='?delKonkurss=$id'>❌</a></td>";
        $avamisetekst='Ava';
        $avamisparam='naitmine_id';
        $avamisseisund='Peidetud';
        if($avalik == 1){
            $avamisetekst = 'Peida';
            $avamisparam = 'peitmine_id';
            $avamisseisund = 'Näidetud';
        }
        echo "<td><a class='button-link' href='?$avamisparam=$id'>$avamisetekst</a>";
        echo "<td>$avamisseisund</td>";
    }

    ?>
</table>

</body>
</html>
<?php $yhendus -> close();?>

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