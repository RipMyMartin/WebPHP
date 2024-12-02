<?php
include '../../../Database/confZone.php';
include 'header.php';
include 'nav.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['uusAnek']) && $_POST['uusAnek'] == 'jah') {
    $nimetus = htmlspecialchars($_POST['nimetus']);
    $kuupaev = htmlspecialchars($_POST['kuupaev']);
    $kirjeldus = htmlspecialchars($_POST['kirjeldus']);

    if (!empty($nimetus) && !empty($kuupaev) && !empty($kirjeldus)) {
        global $yhendus;
        $paring = $yhendus->prepare("INSERT INTO anekdoot (nimetus, kuupaev, kirjeldus) VALUES (?, ?, ?)");
        $paring->bind_param("sss", $nimetus, $kuupaev, $kirjeldus);

        if ($paring->execute()) {
            $message = "Anekdoot lisatud edukalt!";
        } else {
            $message = "Tekkis viga andmete lisamisel.";
        }
    } else {
        $message = "Palun täitke kõik väljad.";
    }
}
?>

<main>
    <div class="h2class">
        <h2>Pealeht</h2>
    </div>
    <div class="concon">
        <div class="tekscontainer">
            <p>
                Tere tulemast Anekdootide lehele! Siit leiate lõbusaid nalju ja huvitavaid lugusid.
            </p>
        </div>
    </div>
</main>

<div class="nuppLisaAnek">
    <a href="?lisaAnek=jah">LISA...</a>
</div>

<div class="addButton">
    <?php
    if (isset($_GET["lisaAnek"]) && $_GET["lisaAnek"] == "jah") {
        ?>
        <form action="" method="POST">
            <input type="hidden" name="uusAnek" value="jah">

            <label for="nimetus">Nimetus</label>
            <input type="text" id="nimetus" name="nimetus" required>
            <br>
            <label for="kuupaev">Kuupäev</label>
            <input type="date" id="kuupaev" name="kuupaev" required>
            <br>
            <p style="font-weight: bold">Kirjeldus</p>
            <label for="kirjeldus"></label>
            <textarea id="kirjeldus" name="kirjeldus" required></textarea>
            <br>
            <input type="submit" value="OK">
        </form>

        <?php
    }
    ?>
</div>

<?php include 'footer.php'; ?>

<style>
    .h2class {
        padding-bottom: 5px;
        padding-top: 5px;
    }

    .concon {
        padding: 5px;
    }

    .tekscontainer {
        padding: 1rem;
        border: solid #333333;
        border-radius: 1rem;
    }


</style>
