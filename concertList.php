<?php 
$title="Concert";

session_start();
if (!isset($_SESSION['isConnected'])){
    $_SESSION['isConnected']=false;
};
require_once 'layout/header.php';











 require_once 'layout/footer.php'; ?>