<?php require "../conf.php"; global $yhendus; ?>

<?php
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
    </ul>
</nav>
<br>
<div class="joulukuusk" onclick="changeImage()">
    <img id="image" src="https://hortes.ee/wp-content/uploads/2022/11/686423686139.jpg" alt="joulukuusk">
</div>
<table>
    <tr>
        <th>Konkursi nimi</th>
    </tr>
    <?php
    $paring = $yhendus->prepare("SELECT id, konkursiNimi, lisamisaeg, punktid, komentaarid FROM konkurss WHERE avalik = 1");
    $paring->bind_result($id, $konkursiNimi, $lisamisaeg, $punktid, $komentaarid);
    $paring->execute();

    while ($paring->fetch()) {
        echo "<tr>";
        $konkursiNimi = htmlspecialchars($konkursiNimi);
        $komentaarid = nl2br(htmlspecialchars($komentaarid));

        echo "<td><a href='?konkurss_id=" . $id . "'>" . $konkursiNimi . "</a></td>";
        echo "</tr>";
    }
    ?>
</table>
    <?php
    if (isset($_REQUEST["konkurss_id"])) {
        $paring = $yhendus->prepare("SELECT id, konkursiNimi, lisamisaeg, punktid, komentaarid FROM konkurss WHERE id = ?");
        $paring->bind_result($id, $konkursiNimi, $lisamisaeg, $punktid, $komentaarid);
        $paring->bind_param("i", $_REQUEST["konkurss_id"]);
        $paring->execute();

        if ($paring->fetch()) {
            echo "<div id='sisu' style='border: solid #71797E; padding: 10px;'>";
            echo "<h3></h3>";
            echo "<p><strong>Konkursi nimi: </strong> " . htmlspecialchars($konkursiNimi) . "</p>";
            echo "<p><strong>Lisamis aeg: </strong> " . $lisamisaeg . "</p>";
            echo "<p><strong>Punktid: </strong> " . $punktid . "</p>";
            echo "<p><strong>Komentaarid: </strong><br>" . nl2br(htmlspecialchars($komentaarid)) . "</p>";
            ?>
                <form action="?" method="post">
                    <input type="hidden" name="uusKomment" value=<?="$id"?>>
                    <input type="text" name="komment" id="komment" class="komentStyle">
                    <input type="submit" value="Lisa" class="">
                </form>
    <?php
            echo "<p><a class='button-link' href='?heaKonkurss_id=$id'>+1 punkt</a></p>";
            echo "<p><a class='button-link' href='?halbKonkurss_id=$id'>-1 punkt</a></p>";
            echo "</div>";
        } else {
            echo "<p></p>";
        }
    }
    ?>

</body> 
</html>
<?php $yhendus -> close();?>

<script>
    function changeImage() {
        var image = document.getElementById('image');
        image.src = 'https://i.pinimg.com/originals/5e/16/a0/5e16a022d3d594fae2d4ad61d244cfb9.gif';
    }
</script>
<style>
    .joulukuusk {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px;
    }

    .joulukuusk img {
        width: 100%;
        max-width: 250px;
        height: auto;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }


    #sisu {
        width: 30%;
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
        width: 30%;
        height: 50%;
        border: 1px solid #ddd;
        column-count: 2;
        column-gap: 20px;
        margin: auto;
    }

    th, td {
        padding: 16px;
        border: solid #DCDCDC;
        text-align: center;
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