<?php
require_once 'function/redirect.php';
require_once 'db/pdo.php';
require_once 'classes/MusicGroupCrud.php';
require_once 'classes/CrudMessages.php';

if (empty($_POST) || !isset($_POST['name_musicGroup']) || !isset($_POST['id_country'])|| !isset($_POST['id_style'])) {
    redirect('listMusicGroup.php');
    }
//var_dump($_POST);

$crud = new MusicGroupCrud($pdo);

$id_musicGroup = intval($_POST['id_musicGroup']);
$name_musicGroup = $_POST['name_musicGroup'];
$id_country = intval($_POST['id_country']);
$id_style = intval($_POST['id_style']);

var_dump($id_musicGroup,$name_musicGroup,$id_country,$id_style);

$crud->update($id_musicGroup, $name_musicGroup, $id_country, $id_style);

redirect('listMusicGroup.php?msgCrud=' . CrudMessages::MODIFY_IS_VALID);