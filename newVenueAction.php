<?php
require_once 'function/redirect.php';
require_once 'db/pdo.php';
require_once 'classes/VenueCrud.php';

if (empty($_POST) || !isset($_POST['nameVenue'])) {
    redirect('admin.php');
}


$crud = new VenueCrud($pdo);

$nameVenue = $_POST['nameVenue'];

$newVenue = $crud->new($nameVenue);

redirect('listVenue.php');

