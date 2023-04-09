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

$crud = new ConcertGroupCrud($pdo);

if (empty($_POST['date_event'])) {
    redirect('newConcertGroup.php?msgCrud=' . CrudMessages::INVALID_FORM_DATE);
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

$id_headlining = [];
$id_headlining[] = intval($_POST['id_headlining']);
$total_headline_event[] = 1;
// var_dump($id_headlining);

$musicGroupsAccordingToEventDate = searchIfSameEventDateAccordingMusicGroup($date_event, $pdo);
// var_dump($musicGroupsAccordingToEventDate);

if (!empty($musicGroupsAccordingToEventDate)) {
    foreach ($musicGroupsAccordingToEventDate as $rowmusicGroupAccordingToEventDate) {
        $idMusicGroupsAccordingToEventDate[] = $rowmusicGroupAccordingToEventDate['id_musicGroup'];
        // var_dump($idMusicGroupAccordingToEventDate);
    }

    $resultIfSameValueHeadlining = array_intersect($id_headlining, $idMusicGroupsAccordingToEventDate);
    // var_dump($resultIfSameValueHeadlining);

    if (!empty($resultIfSameValueHeadlining)) {
        redirect('newConcertGroup.php?msgCrud=' . CrudMessages::INVALID_GROUP);
    }
}


$id_musicGroups = [];
if (!empty($_POST['id_musicGroup'])) {

    foreach ($_POST['id_musicGroup'] as $row_id_musicGroup) {
        $id_musicGroups[] = intval($row_id_musicGroup);
    // var_dump($id_musicGroups);
    }

    $resultIfSameValue = array_intersect($id_headlining, $id_musicGroups);
    
    if (!empty($resultIfSameValue)) {
        redirect('newConcertGroup.php?msgCrud=' . CrudMessages::INVALID_DUPLICATE);
        // var_dump($resultIfSameValue);
    }
    
    $total_id_musicGroups = array_merge($id_headlining, $id_musicGroups);
    // var_dump($total_id_musicGroups);

    if (!empty($musicGroupsAccordingToEventDate)) {
        $resultIfSameValueMusicGroup = array_intersect($total_id_musicGroups, $idMusicGroupsAccordingToEventDate);

    if (!empty($resultIfSameValueMusicGroup)) {
        redirect('newConcertGroup.php?msgCrud=' . CrudMessages::INVALID_GROUP);
    }
}
    $nbZeros = (count($total_id_musicGroups) - 1);

    for ($i = 0; $i < $nbZeros; $i++) {
        $total_headline_event[] = 0;

        // var_dump($total_headline_event);
    }

    $totalMusicGroups = [];
    for ($i = 0; $i < count($total_id_musicGroups); $i++) {
        $totalMusicGroups[] = array(
            'id_musicGroup' => intval($total_id_musicGroups[$i]),
            'headline_event' => $total_headline_event[$i]
        );
    }
    var_dump($totalMusicGroups);
} else {

    $totalMusicGroups = [];
    for ($i = 0; $i < count($id_headlining); $i++) {
        $totalMusicGroups[] = array(
            'id_musicGroup' => $id_headlining[$i],
            'headline_event' => $total_headline_event[$i]
        );
    }
    var_dump($totalMusicGroups);
}

// var_dump($price_event);
$newConcertGroup = $crud->newEvent($name_event, $date_event, $img_event, $price_event, $id_venue);

$newConcertGroup = $crud->newLEventMusicgroups($totalMusicGroups);
// var_dump($musicGroups);

redirect('listConcertGroup.php?msgCrud=' . CrudMessages::ADD_IS_VALID);