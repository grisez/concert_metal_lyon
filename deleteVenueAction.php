<?php
require_once 'function/redirect.php';
require_once 'db/pdo.php';
require_once 'classes/VenueCrud.php';

if(empty($_GET) || !isset($_GET['id_venue'])){
    redirect('admin.php');
}



$crud = new VenueCrud($pdo);

$selectIdVenue = intval($_GET['id_venue']);

$crud->delete($selectIdVenue);

redirect('listMusicGroup.php?msgCrud=' . CrudMessages::ADD_IS_VALID);