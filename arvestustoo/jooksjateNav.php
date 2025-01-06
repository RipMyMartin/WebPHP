<?php
require ('user_handler/logout.inc.php');


?>
<br>
<nav>
    <ul>
        <?php
        if (isset($_SESSION["useruid"])) {
            if ($_SESSION["role"] == "admin") {
                echo '<li><a href="jooksjateKuvamine.php">Stardi protokoll</a></li>';
                echo '<li><a href="jooksjateVaheaeg.php">vaheaja lisamine</a></li>';
                echo '<li><a href="jooksjateloppKontroll.php">Lõpp kontroll</a></li>';
                echo '<li><a href="jooksjaAustamine.php">Austamine</a></li>';
            }
            if ($_SESSION["role"] == "kasutaja") {
                echo '<li><a href="jooksjateLisamine.php">Lisamine</a></li>';
            }
            echo '
            <li>
                <form method="POST">
                    <input type="submit" class="submit-btn2" name="logout" value="Logout">
                </form>
            </li>';
        } else {
            echo '<li><a href="../arvestustoo/login.php">Login</a></li>';
            echo '<li><a href="../arvestustoo/signup.php">Sign up</a></li>';
        }
        ?>
    </ul>
</nav>
<br>
<style>
    nav {
        background-color: #333;
        padding: 10px;
        border-radius: 5px;
        width: 50%;
        margin: 0 auto;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: space-around;
    }

    nav ul li {
        margin: 0 10px;
    }

    nav ul li a {
        text-decoration: none;
        color: white;
        font-size: 16px;
        font-weight: bold;
        transition: color 0.3s;
    }

    nav ul li a:hover {
        color: #ff6347;
    }
</style>
