<?php 
require_once "layout/header.php";

$title="Mon profil";

session_start();
if (!isset($_SESSION['isConnected'])){
    $_SESSION['isConnected']=true;
}






