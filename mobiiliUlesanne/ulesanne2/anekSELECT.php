<?php require("../../../Database/confZone.php") ?>
<?php require("header.php") ?>

<div>
    <div>
        <nav>
            <ul class="menu">
                <li><a href="indexUlesanne2.php">Pealeht</a></li>
                <?php
                global $yhendus;
                $paring = $yhendus->prepare("SELECT id, nimetus, kuupaev, kirjeldus FROM anekdoot");
                $paring->bind_result($id, $nimetus, $kuupaev, $kirjeldus);
                $paring->execute();

                while ($paring->fetch()) {
                    echo "<li><a href='anekSELECT.php?anekdoot_id=$id'>" . htmlspecialchars($nimetus) . "</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>
</div>

<div class="clickInfo">
    <?php
    if(isset($_REQUEST["anekdoot_id"])){
        global $yhendus;
        $anekdoot_id = $_GET["anekdoot_id"];
        $paring = $yhendus->prepare("SELECT id, nimetus, kuupaev, kirjeldus FROM anekdoot WHERE id = ?");
        $paring->bind_param("i", $anekdoot_id);
        $paring->bind_result($id, $nimetus, $kuupaev, $kirjeldus);
        $paring->execute();

        if($paring->fetch()){
            echo "<h2>" . htmlspecialchars($nimetus) . "</h2>";
            echo "<p><strong>Kuupäev:</strong> " . htmlspecialchars($kuupaev) . "</p>";
            echo "<div class='kirjeldusContainer'><p><strong>Kirjeldus:</strong> " . nl2br(htmlspecialchars($kirjeldus)) . "</p></div>";
        } else {
            echo "<p>Anekdoot ei leitud.</p>";
        }
    }
    ?>
</div>

<div class="nuppLisaAnek">
    <?php
    echo '<a href="?lisaAnek=jah">LISA...</a>';
    ?>
</div>

<div class="addButton">
    <?php
    if(isset($_GET["lisaAnek"]) && $_GET["lisaAnek"] == "jah") {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['uusAnek']) && $_POST['uusAnek'] == 'jah') {
            $nimetus = htmlspecialchars($_POST['nimetus']);
            $kuupaev = htmlspecialchars($_POST['kuupaev']);
            $kirjeldus = htmlspecialchars($_POST['kirjeldus']);

            $paring = $yhendus->prepare("INSERT INTO anekdoot (nimetus, kuupaev, kirjeldus) VALUES (?, ?, ?)");
            $paring->bind_param("sss", $nimetus, $kuupaev, $kirjeldus);

            if ($paring->execute()) {
                echo "<p>Anekdoot lisatud edukalt!</p>";
            } else {
                echo "<p>Tekkis viga andmete lisamisel.</p>";
            }
        }

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

<?php require("footer.php") ?>

<style>
    .menu {
        list-style: none;
        margin: auto;
        text-align: center;
        padding-right: 2rem;
        padding-left: 2rem;
    }

    .menu li {
        padding-top: 4px;
    }

    .menu li:last-child {
        margin-right: 0;
    }

    .menu a {
        text-decoration: none;
        color: white;
        text-color
        font-weight: bold;
        padding: 5px;
        padding-right: 1rem ;
        padding-left: 1rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: inline-block;
        background-color: #333333;
    }

    .nuppLisaAnek a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #333333;
        font-size: 16px;
        font-weight: bold;
        border-radius: 5px;
        text-decoration: none;
    }

    .kirjeldusContainer {
    }

    textarea {
        width: 80%;
        height: 150px;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        font-size: 16px;
        resize: none;
    }

</style>
