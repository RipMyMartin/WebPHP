<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP tunnitööd</title>
</head>
<body>
<header>
    <h1>PHP tunnitööd</h1>
</header>

<?php
//navigeerimismenuu
include ('nav.php')

?>

<section>
    <?php
    if (isset($_GET['LEHT']))
    include('content/'."$_GET[LEHT]");



    ?>
</section>
<footer>
    <?php
    echo 'Martin Sild  &copy';
    echo date('Y');

    ?>
</footer>

</body>
</html>
