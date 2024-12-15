<!DOCTYPE html>
<html lang="et">
<head>
    <title>TARpv23 jõulu konkursid</title>
    <link rel="stylesheet" href="konkurssStyle.css">
</head>
<body>
<h2>Login</h2>
<nav>
    <ul>
        <li><a href="konkursAdmin.php">Admin</a></li>
        <li><a href="konkursKasutaja.php">Kasutaja</a></li>
        <li><a href="konkursInfo.php">Info</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="signup.php">Registreerimine</a></li>
    </ul>
</nav>
<main>
    <div class="userLScontainer">
        <form action="user_handler/login.inc.php" method="post">
            <div class="con">
                <div class="field-set">
                    <span class="input-item"><i class="fa fa-user-circle"></i></span>
                    <input class="form-input" id="txt-input" type="text" name="uid" placeholder="Kasutaja nimi" required>
                </div>
                <div class="field-set">
                    <span class="input-item"><i class="fa fa-key"></i></span>
                    <input class="form-input" type="password" placeholder="Parool" id="pwd" name="pwd" required>
                </div>
                <div class="">
                    <button class="submit-btn" type="submit" name="submit">Logi sisse</button>
                </div>
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                        echo "<p class='error-message'>Täida kõik väljad</p>";
                    }
                    if ($_GET["error"] == "wronglogin") {
                        echo "<p class='error-message'>Valed andmed</p>";
                    }
                }
                ?>
            </div>
        </form>
    </div>
</main>
</body>
</html>
