<?php
require_once 'function/redirect.php';

if(empty($_GET) || !isset($_GET['id_musicGroup'])){
    redirect('admin.php');
}

require_once 'db/pdo.php';
require_once 'classes/MusicGroupCrud.php';


$crud = new MusicGroupCrud($pdo);


$id_musicGroup = intval($_GET['id_musicGroup']);

var_dump($_GET['id_musicGroup']);

$crud->delete($id_musicGroup);

redirect('listMusicGroup.php');

