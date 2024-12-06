<?php require "../../../Database/confZone.php"; ?>

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
                    echo "<li><a href='anekSELECT.php?anekdoot_id=$id'>$nimetus</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>
</div>


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

</style>