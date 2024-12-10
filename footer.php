<div class="mainfooter">
    <div class="leftKvadrat">
        <img class="crablabIcons" src="icons/crablang.png" alt="Crablang icon">
    </div>
    <footer>

        <div class="footerColum">
            <a href="https://github.com/RipMyMartin"><img class="footerIcons" src="icons/github.png" alt="GitHub icon"></a>
            <a href="https://martinsild23.thkit.ee/wp/web-desing/"><img class="footerIcons" src="icons/wordpress.png" alt="THK icon"></a>
            <a href="https://github.com/RipMyLoven"><img class="footerIcons" src="icons/RYicon.jpg" alt="R.Y icon"></a>
        </div>

        <div class="phpMainDiv">
            <div class="phpDiv">
                <?php
                echo 'Martin Sild  &copy';
                echo date('Y');?>
            </div>
        </div>

    </footer>
    <div class="rightKvadrat">
        <img class="crablabIcons" src="icons/crablang.png" alt="Crablang icon">
    </div>
</div>

<style>
    .mainfooter {
        display: flex;
        justify-content: center;
        align-items: center;
        padding-bottom: 2rem;
        padding-top: 12px;
    }

    footer {
        width: 70%;
        border-right: dashed #F4F1CE;
        border-left: dashed #F4F1CE;
        border-top: solid #506485;
        border-bottom: solid #506485;
        border-left-width: 5px;
        border-right-width: 5px;
    }

    .leftKvadrat, .rightKvadrat {
        width: 5rem;
        height: 5rem;
        background-color: #181818;
    }


    .leftKvadrat {
        margin-right: 10px;
        border-left: solid #506485;
        border-bottom: solid #506485;
        border-bottom-width: 0.5rem;
        border-left-width: 0.5rem;
        border-bottom-left-radius: 0.5rem;
        border-top-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;

    }

    .rightKvadrat {
        margin-left: 10px;
        border-right: solid #506485;
        border-bottom: solid #506485;
        border-bottom-width: 0.5rem;
        border-right-width: 0.5rem;
        border-bottom-right-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
    }

    .crablabIcons{
        width: 72px;
        height: 72px;
    }

    .footerIcons{
        width: 40px;
        height: 40px;
    }
    .footerColum{
        margin: auto;
        text-align: center;
        width: 20%;
    }
    .phpDiv{
        font-family: monospace;
    }
    .phpMainDiv{
        text-align: center;
        text-decoration-line: overline;

    }


    .first-color {
    background: #ececec;
    }

    .second-color {
        background: #181818;
    }

    .third-color {
        background: #848884;
    }

    .fourth-color {
        background: #71797E;
    }

</style>