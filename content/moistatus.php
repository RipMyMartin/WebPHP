<?php
echo '<h2>Mõistatus</h2>';

// 6 подсказок при помощи текстовых функчий
// ывод списков <ul> / <ol>





$tekst = 'Bosnia ja Hertsegoviina ';
$sona = str_word_count($tekst, 1);

//Esmaspäev on 4.november
echo '<ol>';
echo '<li>Esimene täht on - '.substr($tekst, 0, 1).'</li>';
echo '<li>Teine täht on - '.$tekst[1];
echo '<li>Tähed 3-5 - '.substr($tekst, 2, 5).'</li>';
echo '<li> Teine sõna 2 täht lõpp - '.substr($tekst, 6, 4).'</li>';
echo '<li> Kolmas sõna on testpidi - ' . strrev('Hertsegoviina') . '</li>';  //https://www.php.net/manual/ru/function.strrev.php

echo '</ol>';



