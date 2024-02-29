<?php

session_start();
session_destroy();
$_COOKIE['login'] = false;
header("location:index.php");

?>