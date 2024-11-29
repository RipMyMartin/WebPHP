
<div id="main">
    <div id="content">
        <nav class="menu">
            <ul>
                <li>
                    <a class="active" href="?LEHT=kodu.php">Home</a>
                </li>
                <li>
                    <a href="?LEHT=proov.php">Tekst func</a>
                <li>
                    <a href="?LEHT=moistatus.php">Mõistatus</a>
                </li>
                <li>
                    <a href="?LEHT=ajaFunc.php">Ajafunktsioonid</a>
                </li>
                <li>
                    <a href="?LEHT=pildid.php">Pildid</a>
                </li>
                <li>
                    <a href="?LEHT=massivid.php">Massisvid</a>
                </li>
                <li>
                    <a href="Xml/autodXmlFailist.php" target="_blank">XML failid</a>
                </li>
                <li>
                    <a href="Xml/ruhmaLeht.php" target="_blank">XML failid</a>
                </li>
                <li>
                    <a href="Database/andmeTabeliSisu.php" target="_blank">AndmedTabeliSisu</a>
                </li>
                <li>
                    <a href="mobiiliUlesanne/Mobiilimall/blankett.html" target="_blank">osalejaTabel</a>
                </li>
                <li>
                    <a href="Database/matkaOsaleja.php" target="_blank">MatkaOsaleja</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<style>

    #main{
        margin: auto;
        width: 50%;
        padding: 10px;
    }

    a{ text-decoration: none; }

    #content{
        margin: auto;
        width: auto;
    }
    .menu, .menu ul{
        line-height: 1;
        margin: 0;
        padding: 0;
        list-style-type: none;
    }

    .menu{
        display: block;
        position: relative;
        height: 47px;
        width: 100%;
        background: #fff;
        top: 10px;
    }

    .menu ul>li {
        display: block;
        position: relative;
        float: left;
    }

    .dropdown{
        display: none;
    }

    .menu li>a{
        display: block;
        color: #000;
        padding: 16px;
        width: 130px;
        text-align: center;
        font-size: 15px;
        font-weight: 300;

        transition: all 0.5s ease;
    }

    .menu li:hover>a{
        background: #555;
        color: #fff;
    }

    .dropdown{
        /*  display: none;*/
        display: block;
        position: absolute;
        opacity: 0;
        background: #ccc;

        transition: all 0.3s ease;
    }

    .menu li:hover>ul{
        top: 47px;
        left: 0;
        opacity: 1;
    }
</style>