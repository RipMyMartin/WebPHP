
<div class="all">

</div>
<div class="main">
    <h2>Mõistatus</h2>

<?php
// 6 подсказок при помощи текстовых функчий
// ывод списков <ul> / <ol>

$tekst = 'Bosnia ja Hertsegoviina ';
$sona = str_word_count($tekst, 1);

echo '<ol>';
echo '<li>Esimene täht on - '.substr($tekst, 0, 1).'</li>';
echo '<li>Teine täht on - '.$tekst[1].'</li>';
echo '<li>Tähed 3-5 - '.substr($tekst, 2, 5).'</li>';
echo '<li>Teine sõna 2 täht lõpp - '.substr($tekst, 6, 4).'</li>';
echo '<li>Kolmas sõna on testpidi - ' . strrev('hertsegoviina') . '</li>';  //https://www.php.net/manual/ru/function.strrev.php
echo '<li>Teksti pikkus on - ' . strlen($tekst) . ' tähti</li>';

echo '</ol>';
?>
    <div class="oioi">
        <form method="post" action="">
            Sisestage riigi nimi

            <input type="text" placeholder="Sisestage siia" name="corInput">
            <input type="submit" value="oK">
        </form>

        <?php
        if (isset($_POST['corInput'])) {
            $userInput = $_POST['corInput'];
            if (empty($userInput)) {
                echo "<font color='red'>"."TI DAUN! Palun sisestage riigi nimi"."</font>";
            } else {
                if (strtolower($userInput) == 'bosnia ja hertsegoviina') {
                    echo "Õige! Bosnia ja Hertsegoviinasse";
                } else {
                    echo "Vale sisend! Proovige uuesti";
                }
            }
        }


        highlight_file(__FILE__);
        ?>
    </div>
</div>

<style>

    h2{
        text-align: center;
    }

    .oioi{
        padding: 1rem;
    }
.main{
    padding: 1rem;
    margin: auto;
    width: 30%;
    border: 3px solid green;
}
.all{
    padding-top: 3rem;
}

</style>



