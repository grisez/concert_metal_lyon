<?php
var_dump($_POST);
require_once 'function/redirect.php';
require_once 'db/pdo.php';
require_once 'classes/MusicGroupCrud.php';
require_once 'classes/CrudMessages.php';


if (empty($_POST) || !isset($_POST['name_musicGroup']) || !isset($_POST['id_country'])|| !isset($_POST['id_style'])) {
redirect('listMusicGroup.php');
}


if (empty($_POST['name_musicGroup'])) {
    redirect('newMusicGroup.php?msgCrud=' . CrudMessages::INVALID_FORM);
}

$crud = new MusicGroupCrud($pdo);

$name_musicGroup = $_POST['name_musicGroup'];
$id_country = intval($_POST['id_country']);
$id_style = intval($_POST['id_style']);

$newMusicGroup = $crud->new($name_musicGroup, $id_country, $id_style);

redirect('listMusicGroup.php?msgCrud=' . CrudMessages::ADD_IS_VALID);