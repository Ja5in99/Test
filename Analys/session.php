<?php
session_start();
if (isset($SESSION["username"]) && $_SESSION["username"]===true){
    header("location:welcome.php");
    exit;
}