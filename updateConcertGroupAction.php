<?php

var_dump($_POST);
require_once 'function/redirect.php';
require_once 'function/crud.php';
require_once 'db/pdo.php';
require_once 'classes/ConcertGroupCrud.php';
require_once 'classes/CrudMessages.php';

if (empty($_POST)) {
    redirect('listConcertGroup.php');
}

$name_event = $_POST['name_event'];
$date_event = $_POST['date_event'];
$img_event = $_POST['img_event'];
$price_event = floatval($_POST['price_event']);
$id_venue = intval($_POST['id_venue']);
$id_event = intval($_POST['id_event']);
$id_headlining = [];
$id_headlining[] = intval($_POST['id_headlining']);
$total_headline_event[] = 1;

$crud = new ConcertGroupCrud($pdo);


if (empty($_POST['date_event'])) {
    redirect('updateConcertGroup.php?id_event=' . $_POST['id_event'] . '&msgCrud=' . CrudMessages::INVALID_FORM_DATE);
}

if (isset($_POST['name_event']) && $_POST['name_event'] !== '') {
    $name_event = $_POST['name_event'];
} else {
    $name_event = null;
}

if (isset($_POST['img_event']) && $_POST['img_event'] !== '') {
    $img_event = $_POST['img_event'];
} else {
    $img_event = null;
}

if (isset($_POST['price_event']) && $_POST['price_event'] !== '') {
    $price_event = $_POST['price_event'];
} else {
    $price_event = null;
}



$musicGroupsAccordingToEventDate = searchIfSameEventDateAccordingMusicGroupForUpdate($date_event, $id_event, $pdo);

if (!empty($musicGroupsAccordingToEventDate)) {
    foreach ($musicGroupsAccordingToEventDate as $rowmusicGroupAccordingToEventDate) {
        $idMusicGroupsAccordingToEventDate[] = $rowmusicGroupAccordingToEventDate['id_musicGroup'];
    }

    $resultIfSameValueHeadlining = array_intersect($id_headlining, $idMusicGroupsAccordingToEventDate);

    if (!empty($resultIfSameValueHeadlining)) {
        redirect('updateConcertGroup.php?id_event=' . $_POST['id_event'] . '&msgCrud=' . CrudMessages::INVALID_GROUP);
    }
}


$id_musicGroups = [];
if (!empty($_POST['id_musicGroup'])) {

    foreach ($_POST['id_musicGroup'] as $row_id_musicGroup) {
        $id_musicGroups[] = intval($row_id_musicGroup);
    }

    $resultIfSameValue = array_intersect($id_headlining, $id_musicGroups);
    
    if (!empty($resultIfSameValue)) {
        redirect('updateConcertGroup.php?id_event=' . $_POST['id_event'] . '&msgCrud=' . CrudMessages::INVALID_DUPLICATE);
    }
    
    $total_id_musicGroups = array_merge($id_headlining, $id_musicGroups);

    if (!empty($musicGroupsAccordingToEventDate)) {
        $resultIfSameValueMusicGroup = array_intersect($total_id_musicGroups, $idMusicGroupsAccordingToEventDate);

    if (!empty($resultIfSameValueMusicGroup)) {
        redirect('updateConcertGroup.php?id_event=' . $_POST['id_event'] . '&msgCrud=' . CrudMessages::INVALID_GROUP);
    }
}
    $nbZeros = (count($total_id_musicGroups) - 1);

    for ($i = 0; $i < $nbZeros; $i++) {
        $total_headline_event[] = 0;
    }

    $totalMusicGroups = [];
    for ($i = 0; $i < count($total_id_musicGroups); $i++) {
        $totalMusicGroups[] = array(
            'id_musicGroup' => intval($total_id_musicGroups[$i]),
            'headline_event' => $total_headline_event[$i]
        );
    }
} else {

    $totalMusicGroups = [];
    for ($i = 0; $i < count($id_headlining); $i++) {
        $totalMusicGroups[] = array(
            'id_musicGroup' => $id_headlining[$i],
            'headline_event' => $total_headline_event[$i]
        );
    }
}

$delete = $crud->delete($id_event);
$newEvent = $crud->newEvent($name_event,$date_event,$img_event,$price_event,$id_venue);
$newLEventMusicgroups = $crud->newLEventMusicgroups($totalMusicGroups);

redirect('listConcertGroup.php?msgCrud=' . CrudMessages::MODIFY_IS_VALID);