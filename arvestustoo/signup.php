<?php
ob_start();
if(isset($_GET['code'])){die(highlight_file(__FILE__, 1));}
require "../Database/konkurss/user_handler/functions.inc.php";
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <title>TARpv23 jõulu konkursid</title>
    <link rel="stylesheet" href="konkurssStyle.css">
</head>
<body>
<h2>Registreerimine</h2>
<?php
include "jooksjateNav.php";
?>
<div class="userLScontainer">
        <form action="user_handler/signup.inc.php" method="post">
            <div class="signUpInput">
                <span class="input-item"><i class="fa fa-user-circle"></i></span>
                <input class="form-input" type="text" name="name" placeholder="Nimi" required>
            </div>
            <div class="signUpInput">
                <span class="input-item"><i class="fa fa-envelope"></i></span>
                <input class="form-input" type="email" name="email" placeholder="E-Post" required>
            </div>
            <div class="signUpInput">
                <span class="input-item"><i class="fa fa-user"></i></span>
                <input class="form-input" type="text" name="uid" placeholder="Kasutaja nimi" required>
            </div>
            <div class="signUpInput">
                <span class="input-item"><i class="fa fa-key"></i></span>
                <input class="form-input" type="password" name="pwd" placeholder="Parool" required>
            </div>
            <div class="signUpInput">
                <span class="input-item"><i class="fa fa-key"></i></span>
                <input class="form-input" type="password" name="pwdrepeat" placeholder="Korda parool" required>
            </div>
            <div class="">
                <button class="submit-btn" type="submit" name="submit">Registreeri</button>
            </div>
            <input type="hidden" name="role" value="kasutaja">
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p>Väljad on tyhi</p>";
                }
                if ($_GET["error"] == "invalidusername") {
                    echo "<p>Kasutajanimi sisaldab kehtetuid märke</p>";
                }
                if ($_GET["error"] == "invalidemail") {
                    echo "<p>Invalid email</p>";
                }
                if ($_GET["error"] == "passwordmismatch") {
                    echo "<p>Sisestatud kaks erinevad parooli</p>";
                }
                if ($_GET["error"] == "usernametaken") {
                    echo "<p>Kasutajanimi juba on kasutusel</p>";
                }
                if ($_GET["error"] == "stmtfailed") {
                    echo "<p>Midagi läks valesti, proovige hiljem uuesti</p>";
                }
                if ($_GET["error"] == "emailregistered") {
                    echo "<p>E-post on juba kasutusel</p>";
                }
                if ($_GET["error"] == "none") {
                    echo "<p>Olete registreerinud</p>";
                }
            }
            ?>
        </form>
    </div>
</body>
</html>

<style>
    .submit-btn2{
        color: white;
        background-color: red;
        border: none;
        font-size: 16px;
        font-weight: bold;
    }
</style>
