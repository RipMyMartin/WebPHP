<div id="main">
    <div id="content">
        <nav class="menu">
            <div class="menu-toggle">
                <img src="icons/hamburger-icon.png" alt="Menu" />
            </div>
            <ul class="menu-items">
                <li><a class="active" href="?LEHT=kodu.php">Home</a></li>
                <li><a href="?LEHT=projects.php">Projects</a></li>
                <li><a href="?LEHT=proov.php">Tekst func</a></li>
                <li><a href="?LEHT=moistatus.php">Mõistatus</a></li>
                <li><a href="?LEHT=ajaFunc.php">Ajafunktsioonid</a></li>
                <li><a href="?LEHT=pildid.php">Pildid</a></li>
                <li><a href="?LEHT=massivid.php">Massisvid</a></li>
                <li><a href="Database/matkaOsaleja.php">matkaOsaleja</a></li>
            </ul>
        </nav>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.querySelector(".menu-toggle");
        const menuItems = document.querySelector(".menu-items");

        toggle.addEventListener("click", () => {
            menuItems.classList.toggle("active");
        });
    });

</script>


<style>
    #main {
        margin: auto;
        width: 40%;
        padding: 10px;
    }

    a {
        text-decoration: none;
    }

    #content {
        margin: auto;
        width: auto;
    }

    .menu {
        position: relative;
        width: 100%;
        background: #fff;
        top: 10px;
    }

    .menu-toggle {
        display: none;
        cursor: pointer;
        padding: 10px;
    }

    .menu-toggle img {
        width: 30px;
        height: auto;
    }

    .menu-items {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: row;
    }

    .menu-items li {
        margin: 0;
        padding: 0;
    }

    .menu-items li a {
        display: block;
        padding: 16px;
        color: #000;
        text-align: center;
        font-size: 15px;
        font-weight: 300;
    }

    .menu-items li:hover > a {
        background: #555;
        color: #fff;
    }

    @media (max-width: 768px) {
        .menu-toggle {
            display: block;
        }


        .menu-items {
            flex-direction: column;
            display: none;
            background: #fff;
        }

        .menu-items.active {
            display: flex;
        }

        .menu-items li {
            width: 125%;
        }

        .menu-items li a {
            text-align: left;
            padding: 10px 15px;
        }
    }
</style>