<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Värske</title>
</head>
<body>

<div class="nav">
    <?php
    require ("p2is.php")
    ?>
</div>

<h2>Värske</h2>

<div class="teade">
    <?php
    require ("teade.txt")
    ?>
</div>

<div class="nav2">
    <p>&copy; Martin Sild 2024</p>
</div>

</body>
</html>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
        color: #333;
    }


    .teade {
        background-color: #ffffff;
        padding: 20px;
        margin: 20px auto;
        max-width: 800px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    footer {
        background-color: #2a3d66;
        color: white;
        padding: 10px;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    .tegija {
        font-size: 14px;
    }

    a {
        color: #2a3d66;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>