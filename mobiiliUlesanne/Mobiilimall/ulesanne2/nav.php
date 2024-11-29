<?php require "../../../Database/conf.php"; ?>

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
        margin: 0;
        padding: 0;
    }

    .menu li {
    }

    .menu li:last-child {
        margin-right: 0;
    }

    .menu a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: inline-block;
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