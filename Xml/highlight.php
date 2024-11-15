<?php
$fileToHighlight = 'ruhmaLeht.php';

if (isset($_POST['Click'])) {
    if (file_exists($fileToHighlight)) {
        highlight_file($fileToHighlight);
    } else {
        echo "Faili pole";
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<br>

<a href="ruhmaLeht.php">Tagasi ruhmaleht</a>

</body>
</html>
