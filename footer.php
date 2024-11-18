<div class="mainfooter">
    <div class="leftKvadrat"></div>
    <footer>
        <?php
        echo 'Martin Sild  &copy';
        echo date('Y');

        ?>
    </footer>
    <div class="rightKvadrat"></div>
</div>

<style>
    .mainfooter{
        padding-bottom: 2rem;
        padding-top: 12px;
    }

    footer{
        text-align: center;
        width: 70%;
        margin: auto;
        border-right: dashed #F4F1CE;
        border-left: dashed #F4F1CE;
        border-top:solid #506485;
        border-bottom: solid #506485;
        border-left-width: 5px;
        border-right-width: 5px;

    }

    .leftKvadrat, .rightKvadrat{
        padding: 5px;
        background-color: red;
        position: absolute;
    }
</style>