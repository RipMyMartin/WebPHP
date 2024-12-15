<?php
session_start();
session_unset();
session_destroy();
header("location: ../konkursInfo.php");
exit();