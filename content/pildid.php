<h2>
    PHP – Töö pildifailidega
</h2>

<a href="https://www.metshein.com/unit/php-pildifailidega-ulesanne-14/">Töö pildifailidega</a>

<div class="toopildi">
    <form method="post" action="">
        <select name="pildid">
            <option value="">Vali pilt</option>
            <?php
            $kataloog = 'content/img';
            $asukoht=opendir($kataloog);
            while($rida = readdir($asukoht)){
                if($rida!='.' && $rida!='..'){
                    echo "<option value='$rida'>$rida</option>\n";
                }
            }
            ?>
        </select>
        <input type="submit" value="Vaata">
        <input type="submit" value="Rand">
    </form>
</div>
    <?php


    if(!empty($_POST['pildid'])){
        $pilt = $_POST['pildid'];
        $pildi_aadress = 'content/img/'.$pilt;
        $pildi_andmed = getimagesize($pildi_aadress);

        $laius = $pildi_andmed[0];
        $korgus = $pildi_andmed[1];
        $formaat = $pildi_andmed[2];
        $max_laius = 120;
        $max_korgus = 90;

        if($laius <= $max_korgus && $korgus<=$max_korgus){
            $ratio = 1;
        } elseif($laius>$korgus){
            $ratio = $max_laius/$laius;
        } else {
            $ratio = $max_korgus/$korgus;
        }

        $pisi_laius = round($laius*$ratio);
        $pisi_korgus = round($korgus*$ratio);

        echo '<h3>Originaal pildi andmed</h3>';
        echo "Laius: $laius<br>";
        echo "Kõrgus: $korgus<br>";
        echo "Formaat: $formaat<br>";

        echo '<h3>Uue pildi andmed</h3>';
        echo "Arvutamse suhe: $ratio <br>";
        echo "Laius: $pisi_laius<br>";
        echo "Kõrgus: $pisi_korgus<br>";
        echo "<img width='$pisi_laius' src='$pildi_aadress'><br>";
    }
    ?>

<h2>
    ÜL-1 Suvaline pilt – koosta kood, mis valib kataloogist suvalise pildid
</h2>
