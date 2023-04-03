<?php
require_once 'function/redirect.php';
require_once 'classes/ConnexionMessages.php';

session_start();
$_SESSION=[];
session_destroy();
redirect('index.php?msgLogin=' . ConnexionMessages::DECONNEXION);