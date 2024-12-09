<?php
require '../Database/conf.php';
global $yhendus;
    function kysiKaupadeAndmed($sorttulp="nimetus", $otsisona=""){
        global $yhendus;
        $lubatudtulbad=array("nimetus", "grupinimi", "hind");
        if(!in_array($sorttulp, $lubatudtulbad)){
            return "lubamatu tulp";
        }
        $otsisona=addslashes(stripslashes($otsisona));
        $kask=$yhendus->prepare("SELECT kaubad.id, nimetus, grupinimi, kaubagrupi_id, hind  FROM kaubad, kaubagrupid WHERE kaubad.kaubagrupi_id=kaubagrupid.id  AND (nimetus LIKE '%$otsisona%' OR grupinimi LIKE '%$otsisona%')  ORDER BY $sorttulp");
        $kask->bind_result($id, $nimetus, $grupinimi, $kaubagrupi_id, $hind);  $kask->execute();
        $hoidla=array();
        while($kask->fetch()){
            $kaup=new stdClass();
            $kaup->id=$id;
            $kaup->nimetus=htmlspecialchars($nimetus);
            $kaup->grupinimi=htmlspecialchars($grupinimi);
            $kaup->kaubagrupi_id=$kaubagrupi_id;
            $kaup->hind=$hind;
            array_push($hoidla, $kaup);
        }
        return $hoidla;
    }

    function looRippMenyy($sqllause, $valikunimi, $valitudid="") {
        global $yhendus;
        $kask=$yhendus->prepare($sqllause);
        $kask->bind_result($id, $sisu);
        $kask->execute();
        $tulemus="<select name='$valikunimi'>";
        while($kask->fetch()){
            $lisand="";
            if($id==$valitudid){$lisand=" selected='selected'";}
            $tulemus.="<option value='$id' $lisand >$sisu</option>";
        }
        $tulemus.="</select>";
        return $tulemus;
    }

    function lisaGrupp($grupinimi) {
        if (empty($grupinimi)) {
            return;
        }

        global $yhendus;

        $kask = $yhendus->prepare("SELECT COUNT(*) FROM kaubagrupid WHERE grupinimi = ?");
        $kask->bind_param("s", $grupinimi);
        $kask->execute();
        $kask->bind_result($count);
        $kask->fetch();
        $kask->close();

        if ($count > 0) {
            return;
        }

        $kask = $yhendus->prepare("INSERT INTO kaubagrupid (grupinimi) VALUES (?)");
        $kask->bind_param("s", $grupinimi);
        $kask->execute();
        $kask -> close();
    }

    function lisaKaup($nimetus, $kaubagrupi_id, $hind) {
        if (empty($nimetus) || empty($kaubagrupi_id) || empty($hind)) {
            return;
        }

        global $yhendus;

        $kask = $yhendus->prepare("SELECT COUNT(*) FROM kaubad WHERE nimetus = ? AND kaubagrupi_id = ?");
        $kask->bind_param("si", $nimetus, $kaubagrupi_id);
        $kask->execute();
        $kask->bind_result($count);
        $kask->fetch();
        $kask->close();

        if ($count > 0) {
            return;
        }

        $kask = $yhendus->prepare("INSERT INTO kaubad (nimetus, kaubagrupi_id, hind) VALUES (?, ?, ?)");
        $kask->bind_param("sid", $nimetus, $kaubagrupi_id, $hind);
        $kask->execute();
        $kask->close();
    }


    function kustutaKaup($kauba_id){
        global $yhendus;
        $kask=$yhendus->prepare("DELETE FROM kaubad WHERE id=?");
        $kask->bind_param("i", $kauba_id);
        $kask->execute();
    }

    function muudaKaup($kauba_id, $nimetus, $kaubagrupi_id, $hind){
        global $yhendus;
        $kask=$yhendus->prepare("UPDATE kaubad SET nimetus=?, kaubagrupi_id=?, hind=?  WHERE id=?");
        $kask->bind_param("sidi", $nimetus, $kaubagrupi_id, $hind, $kauba_id);
        $kask->execute();
    }

    $sorttulp="nimetus";
    $otsisona="";
    if(isSet($_REQUEST["sort"])){
        $sorttulp=$_REQUEST["sort"];
    }
    if(isSet($_REQUEST["otsisona"])){
        $otsisona=$_REQUEST["otsisona"];
    }

    if(isSet($_REQUEST["grupilisamine"])){
        lisaGrupp($_REQUEST["uuegrupinimi"]);
        header("Location: index.php");
        exit();
    }
    if(isSet($_REQUEST["kaubalisamine"])){
        lisaKaup($_REQUEST["nimetus"], $_REQUEST["kaubagrupi_id"], $_REQUEST["hind"]);  header("Location: index.php");
        exit();
    }
    if(isSet($_REQUEST["kustutusid"])){
        kustutaKaup($_REQUEST["kustutusid"]);
    }
    if(isSet($_REQUEST["muutmine"])){
        muudaKaup($_REQUEST["muudetudid"], $_REQUEST["nimetus"],
            $_REQUEST["kaubagrupi_id"], $_REQUEST["hind"]);
    }

    if (isset($_REQUEST["grupilisamine"])) {
        if (!empty($_REQUEST["uuegrupinimi"])) {
            lisaGrupp($_REQUEST["uuegrupinimi"]);
            header("Location: index.php");
            exit();
        }
    }

    if (isset($_REQUEST["kaubalisamine"])) {
        if (!empty($_REQUEST["nimetus"]) && !empty($_REQUEST["kaubagrupi_id"]) && !empty($_REQUEST["hind"])) {
            lisaKaup($_REQUEST["nimetus"], $_REQUEST["kaubagrupi_id"], $_REQUEST["hind"]);
            header("Location: index.php");
            exit();
        }
    }

    $kaubad=kysiKaupadeAndmed($sorttulp, $otsisona);
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaupade leht</title>
    <link rel="stylesheet" href="indexCSS.css">
</head>
<body>

<form action="?" method="post">
    <h2>Kauba lisamine</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <div style="flex: 1 1 calc(50% - 10px);">
            <input type="text" name="nimetus" placeholder="Sisesta kauba nimi"/>
        </div>

        <div style="flex: 1 1 calc(50% - 10px);">
            <?php
            echo looRippMenyy("SELECT id, grupinimi FROM kaubagrupid", "kaubagrupi_id");
            ?>
        </div>
    </div>

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <div style="flex: 1 1 calc(50% - 10px);">
            <input type="text" name="hind" placeholder="Sisesta hind"/>
        </div>
    </div>

    <input type="submit" name="kaubalisamine" value="Lisa kaup" />

    <h2>Grupi lisamine</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <div style="flex: 1 1 100%;">
            <input type="text" name="uuegrupinimi" placeholder="Sisesta uue grupi nimi"/>
        </div>
    </div>
    <input type="submit" name="grupilisamine" value="Lisa grupp" />
</form>

<form action="?" method="get">
    <h2>Kaupade loetelu</h2>
    Otsi:
    <input type="text" name="otsisona" value="<?= isset($_REQUEST['otsisona']) ? htmlspecialchars($_REQUEST['otsisona']) : '' ?>" />

    <table>
        <tr>
            <th>Haldus</th>
            <th><a href="?sort=nimetus">Nimetus</a></th>
            <th><a href="?sort=grupinimi">Kaubagrupp</a></th>
            <th><a href="?sort=hind">Hind</a></th>
        </tr>
        <?php foreach($kaubad as $kaup): ?>
            <tr>
                <?php if(isset($_REQUEST["muutmisid"]) && intval($_REQUEST["muutmisid"]) == $kaup->id): ?>
                    <td>
                        <input type="submit" name="muutmine" value="Muuda" />
                        <input type="submit" name="katkestus" value="Katkesta" />
                        <input type="hidden" name="muudetudid" value="<?=$kaup->id ?>" />
                    </td>
                    <td>
                        <input type="text" name="nimetus" value="<?=$kaup->nimetus ?>" />
                    </td>
                    <td>
                        <?php echo looRippMenyy("SELECT id, grupinimi FROM kaubagrupid", "kaubagrupi_id", $kaup->kaubagrupi_id); ?>
                    </td>
                    <td>
                        <input type="text" name="hind" value="<?=$kaup->hind ?>" />
                    </td>
                <?php else: ?>
                    <td>
                        <a href="?kustutusid=<?=$kaup->id ?>" onclick="return confirm('Kas ikka soovid kustutada?')">x</a>
                        <a href="?muutmisid=<?=$kaup->id ?>">m</a>
                    </td>
                    <td><?=$kaup->nimetus ?></td>
                    <td><?=$kaup->grupinimi ?></td>
                    <td><?=$kaup->hind ?></td>
                <?php endif ?>
            </tr>
        <?php endforeach; ?>
    </table>
</form>

</body>
</html>

