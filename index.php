<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/global.css"
    <title>PHP tunnitööd</title>
</head>
<body>
<?php
//header - päis
include ('header.php');
?>

<?php
//navigeerimismenuu
include ('nav.php')

?>

<section>
    <?php
    if (isset($_GET['LEHT'])) {
        include('content/' . "$_GET[LEHT]");
    }else{
        include('content/' . "kodu.php");
    }
//git controll
    ?>
</section>

<?php
//Jalus
include ('footer.php')

//kontroll git
//git controll
?>

</body>
</html>
