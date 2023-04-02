<?php
require_once 'function/redirect.php';

if (empty($_POST) || !isset($_POST['name_country']) || !isset($_POST['name_style'])) {
    redirect('admin.php');
}

require_once 'db/pdo.php';
require_once 'classes/MusicGroupCrud.php';

$crud = new MusicGroupCrud($pdo);


$name_musicGroup = $_POST['name_musicGroup'];
$name_country = $_POST['name_country'];
$name_style = $_POST['name_style'];

$newMusicGroup = $crud->new($name_musicGroup,$name_country,$name_style);

redirect('listMusicGroup.php');