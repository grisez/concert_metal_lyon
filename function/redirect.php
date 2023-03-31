<?php
require_once 'classes/ConnexionMessage.php';
function redirect($url){
    header("Location:$url");
    die();
}