<div id="main">
    <div id="content">
        <nav class="menu">
            <ul>
                <li>
                    <a class="active" href="?LEHT=kodu.php">Home</a>
                </li>
                <li>
                    <a href="?LEHT=projects.php">Projects</a>
                </li>
                <li>
                    <a href="?LEHT=proov.php">Tekst func</a>
                </li>
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
            </ul>
        </nav>
    </div>
</div>


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

.menu,
.menu ul {
    line-height: 1;
    margin: 0;
    padding: 0;
    list-style-type: none;
}

.menu {
    display: block;
    position: relative;
    height: 47px;
    width: 100%;
    background: #fff;
    top: 10px;
}

.menu ul > li {
    display: block;
    position: relative;
    float: left;
}

.menu li > a {
    display: block;
    color: #000;
    padding: 16px;
    width: 130px;
    text-align: center;
    font-size: 15px;
    font-weight: 300;
    transition: all 0.5s ease;
}

.menu li:hover > a {
    background: #555;
    color: #fff;
}

.dropdown {
    display: none; 
    position: absolute;
    background: #ccc;
    transition: all 0.3s ease;
    opacity: 0;
    z-index: 1;
    min-width: 150px;
}

.menu li:hover > .dropdown {
    display: block; 
    top: 47px;
    left: 0;
    opacity: 1;
}

.dropdown li {
    display: block;
    margin: 0;
    padding: 0;
    text-align: left;
}

.dropdown li > a {
    padding: 10px 15px;
    color: #000;
    font-size: 14px;
    font-weight: 300;
}

.dropdown li:hover > a {
    background: #888;
    color: #fff;
}
</style>