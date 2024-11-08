<?php
echo '<h2>Ajafunktsioonid</h2>';
echo '<div id="kuupaev"> ';
echo 'Täna on '.date('d.m.Y').'<br>';
date_default_timezone_set('Europe/Tallinn'); //mm.dd.yyyy h:mm
echo "<strong>";
echo 'Tänane Tallinna kuupäev ja kellaaeg on ',
    date('d.m.Y G:i', time()).'<br>';
echo "</strong>";
echo "date('d.m.Y G:i', time())";
echo "<br>";
echo "d - kuupäev 1-31";
echo "<br>";
echo "m - kuu 1-12";
echo "<br>";
echo "Y - aasta neljakohane";
echo "<br>";
echo "G - tunniformaat 0-23";
echo "<br>";
echo "i - minutid 0-59";

echo '</div>';

?>
<div id="hooaeg">
    <h2> Väljasta vastavalt hooajake pilt (Kevad, sugis, talv, suvi)</h2>

    <?php
    $today = new DateTime();
    echo "Tänane on ".$today->format('m-d-Y')." <br>";
    //hooaja punktid
    $spring = new DateTime('March 20');
    $summer = new DateTime('June 21');
    $fall = new DateTime('September 22');
    $winter = new DateTime('December 22');

    switch (true){
        case ($today>=$spring && $today<=$summer):
            echo "Kevad";
            $pildiAadress = 'content/img/kevad.jpg';
            break;

        case ($today>=$summer && $today<=$fall):
            echo "Suvi";
            $pildiAadress = 'content/img/suvi.jpg';
            break;

        case ($today>=$fall && $today<=$winter):
            echo "Sügis";
            $pildiAadress = 'content/img/sugis.jpg';
            break;
        case ($today>=$winter && $today<=$fall):
            echo "Talv";
            $pildiAadress = 'content/img/talv.webp';
            break;
        default:
            echo "ТЫ ДАЙН";
            break;
    }
    ?>


        <img src="<?=$pildiAadress?>" alt='hooaja pilt'>

</div>

<style>
    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }

</style>