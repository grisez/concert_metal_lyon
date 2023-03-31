<?php 
$title="Mon profil";

session_start();
if (!isset($_SESSION['isConnected'])){
    $_SESSION['isConnected']=true;
}

require_once "layout/header.php";





