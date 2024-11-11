<div class="mainAja">

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
<div id="koolivaheaeg">
    <h2>Mitu päeva on koolivaheajani 23.12.2024</h2>
    <?php
    $kdate=date_create_from_format('d.m.Y', '23.12.2024');
    $date = date_create();

    $diff = date_diff($kdate, $date);
    echo "Jääb ".$diff->format("%a")."päeva";
echo "<br>";
    echo "Jääb ".$diff->days."päeva";
    ?>
</div>

<div id="mSunnipaev">
    <h2>Mitu päeva jääb minu sünnipäevani 09.08.2025</h2>
    <?php
    $sdate = date_create_from_format('d.m.Y', '09.08.2025');
    $date = date_create();
    $diff = date_diff($sdate, $date);

    echo "Jääb veel ".$diff->days." päevi"


    ?>
</div>

<div id="vanus">
    <h2>Kasutaja vanuse leidmine</h2>

    <form method="post" action="">
        Sisesta oma sünnikuupäeva
        <input type="date" name="synd" placeholder="dd.mm.yyyy">
        <input type="submit" value="oK">
    </form>

    <?php
    if(isset($_POST["synd"])){
        if(empty($_POST["synd"])){
            echo "Sisesta on sünnikuupäeva<br>";
        }
        else{
            $vdate = date_create($_POST["synd"]);
            $date = date_create();
            $diff = date_diff($vdate, $date);
             echo "Sa oled " . $diff->format("%y") . " aastad vana";
        }
    }
    ?>

</div>

<div id="">
    <h2>Massivi abil näidata kuu nimega tänases kuupäevas.</h2>

    <?php
    $kuud = array (1=>'Jaanuar', "Veebruar", "Märts", "Aprill", "Mai", "Juuni", "Juuli","August"," September","Oktober", "November", "December" );
    $paev = date('d');
    $year = date('Y');
    $kuu = $kuud[date('n')];

    echo 'BLA BLA TÄNA ON '.$paev.'.'.$kuu.'.'.$year;




    ?>

</div>
</div>

<style>
    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 25%;
    }

    .mainAja{
        text-align: center;
        margin-top: 3rem;
    }

</style>