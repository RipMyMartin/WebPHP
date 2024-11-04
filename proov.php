<?php
echo "Hello World!";
echo '<br>';
$muutuja='TEXT';
echo '<strong>';
echo $muutuja;

/*
Ebat ti musor
*/

//EBAT ti huesos
echo '</strong>';
echo '<h2> Tekstifunktsioon</h2>';

$text = 'Esmaspäev on 4.november';
echo $text;

//kõik tähed on suured
echo '<br>';
echo strtoupper($text);// не видет ÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄ
echo '<br>';
echo mb_strtoupper($text); //чтоб хуйни не было то пишем на англ
//kõik tahed on väikesed
echo '<br>';
echo strtolower($text);

//Iga sõna algab suure tähega
echo '<br>';
echo ucwords($text);

//teksti pikkus
echo '<br>';
echo 'Teksti pikkus - '.strlen($text);

//eraldame esimesed 5 tähte
echo '<br>';
echo 'Esimesed viis tähte - ' .substr($text, 0, 5);

// leitmine on positsiooni
echo '<br>';
$otsing = 'on';
echo 'on asukoht - ', strpos($text, $otsing);

//eralda esimene sõna kuni $otsing
echo '<br>';
echo substr($text,0,strpos($text, $otsing));

echo '<br>';
//erali peale esiest sõna
echo substr($text, strpos($text, $otsing));

echo '<h2> Kasutame veebis kasutuvaid näidised<h2>';
echo '<br>';

//Sõnade arv
echo 'Sõnade arv lauses - '.str_word_count($text);

echo '<h2> Teksti kärpimine </h2>';

$tekst = ' 	A woman should soften but not weaken a man   ';
echo "<pre>$tekst</pre>";
echo "<pre>".trim($tekst)."</pre>";
echo "<pre>".ltrim($tekst)."</pre>";
echo "<pre>".rtrim($tekst)."</pre>";

echo '<br>';

$tekst = 'A woman should soften but not weaken a man';
echo trim($tekst, "A, a, k..n, w");	//oman should soften but not weake

echo '<br>';

$tekst = '<b>Experience</b> <a href="#">is</a> the teacher <br>of fools';
echo strip_tags($tekst); 	//Experience is the teacher of fools

echo '<br>';

$tekst = '<b>Experience</b> <a href="#">is</a> the teacher <br>of fools';
echo strip_tags($tekst, '<b>, <br>'); 	//<b>Experience</b> is the teacher <br>of fools

echo '<h2> Teksti kui masiiv </h2>';

$tekst = 'All thinking men are atheists';
echo $tekst[0]; 				//A
echo '<br>';
echo $tekst[4]; 				//t

$tekst = 'All thinking men are atheists';
echo substr($tekst, 3, 5);		//thin
echo '<br>';
echo substr($tekst, 4, -13);	//thinking men
echo '<br>';
echo substr($tekst, -8, 7);		//atheist

echo '<br>';

$tekst = 'All thinking men are atheists';
print_r(str_word_count($tekst, 1));
//Array ( [0] => All [1] => thinking [2] => men [3] => are [4] => atheists )

echo '<br>';

$tekst = 'All thinking men are atheists';
$sona = str_word_count($tekst, 1);
echo $sona[2];//men

echo '<br>';

$tekst = 'All thinking men are atheists';
print_r(str_word_count($tekst, 2));
//Array ( [0] => All [4] => thinking [13] => men [17] => are [21] => atheists )
?>