<?php
require_once 'function/redirect.php';


if (empty($_POST)){
    redirect('admin.php');
}

require_once 'db/pdo.php';
require_once 'classes/VenueCrud.php';

$crud = new VenueCrud($pdo);

$name_musicGroup = $_POST['name_musicGroup'];
$name_country = $_POST['name_country'];
$name_style = $_POST['name_style'];
$id_musicGroup = intval($_POST['id_musicGroup']);

var_dump($name_musicGroup,$name_country,$name_style,$id_musicGroup);

// $crud->update($id_musicGroup, $name_musicGroup, $name_country, $name_style);
    

// redirect('listMusicGroup.php');
