<?php

if (isset($_SESSION['userid']) &&  $_SESSION['userid']>= 0 && !isset($_GET['successful'])) {
    header("Location: {$_SERVER['REQUEST_URI']}?successful=1");
    exit();
} else{
    header("Location: ./view/Home.php");
    exit();
}

