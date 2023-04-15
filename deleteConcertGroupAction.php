<?php
require_once 'function/redirect.php';
require_once 'db/pdo.php';
require_once 'classes/ConcertGroupCrud.php';
require_once 'classes/CrudMessages.php';

if(empty($_GET) || !isset($_GET['id_event'])){
    redirect('admin.php');
}

$crud = new ConcertGroupCrud($pdo);


$id_event = intval($_GET['id_event']);

$crud->deleteAll($id_event);

redirect('listConcertGroup.php?msgCrud=' . CrudMessages::REMOVE_IS_VALID);