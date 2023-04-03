<?php
require_once 'function/redirect.php';


if (empty($_POST)){
    redirect('admin.php');
}
//var_dump($_POST);

require_once 'db/pdo.php';
require_once 'classes/MusicGroupCrud.php';

$crud = new MusicGroupCrud($pdo);

$id_musicGroup = intval($_POST['id_musicGroup']);
$name_musicGroup = $_POST['name_musicGroup'];
$id_country = intval($_POST['id_country']);
$id_style = intval($_POST['id_style']);

var_dump($id_musicGroup,$name_musicGroup,$id_country,$id_style);

$crud->update($id_musicGroup, $name_musicGroup, $id_country, $id_style);


redirect('listMusicGroup.php');
