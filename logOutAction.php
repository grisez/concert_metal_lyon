<?php
require_once 'function/redirect.php';
require_once 'classes/ConnexionMessage.php';

session_start();
$_SESSION=[];
session_destroy();
redirect('index.php?msg=' . ConnexionMessages::DECONNEXION);