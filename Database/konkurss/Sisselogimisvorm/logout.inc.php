<?php
session_start();
session_unset();
session_destroy();
header("location: ../Database/konkurss/konkurss/Sisselogimisvorm/login.php");
exit();