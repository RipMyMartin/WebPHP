<div class="folder-structure">
    <div class="folder">
        <div class="folder-name">Database</div>
        <div class="files">
            <div class="file-item"><a href="Database/konkurss/signup.php">KonkurssKasutaja</a></div>
            <div class="file-item"><a href="Database/loomadYheKaupa.php">LoomadYheKaupa</a></div>
            <div class="file-item"><a href="Database/matkaOsaleja.php">MatkaOsaleja</a></div>
        </div>
    </div>
    <div class="folder">
        <div class="folder-name">MobiilUlesanded</div>
        <div class="files">
            <div class="file-item"><a href="mobiiliUlesanne/Mobiilimall/ulesanne1/indexUlesanne.php">Ulesanne1</a></div>
            <div class="file-item"><a href="mobiiliUlesanne/Mobiilimall/ulesanne2/indexUlesanne2.php">Ulesanne2</a></div>
        </div>
    </div>
    <div class="folder">
        <div class="folder-name">Arvestustöö</div>
        <div class="files">
            <div class="file-item"><a href="arvestustoo/signup.php">Jooksuvõistlus</a></div>
        </div>
    </div>
    <div class="folder">
        <div class="folder-name">Loov ülesanne JS</div>
        <div class="files">
            <div class="file-item"><a href="loovUlesanneJS/coolors-clone/index.html">coolors-clone</a></div>
            <div class="file-item"><a href="loovUlesanneJS/TicTacTocGame/index.html">TicTacTocGame</a></div>
        </div>
    </div>
</div>

<style>
    .folder-structure {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: flex-start;
        margin: 20px;
    }

    .folder {
        width: 250px;
        background-color: #506485;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }


    .folder-name {
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        color: #333;
        margin-bottom: 15px;
        background-color: #f0f0f0;
        padding: 10px;
        border-radius: 5px;
    }

    .files {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .file-item {
        background-color: #f9f9f9;
        padding: 10px;
        text-align: center;
        border-radius: 6px;
        font-size: 16px;
        color: #333;
        border: 1px solid #ddd;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .file-item a {
        background-color: transparent;
        text-decoration: none;
        color: inherit;
    }


    .file-item + .file-item {
        margin-top: 5px;
    }
</style>
