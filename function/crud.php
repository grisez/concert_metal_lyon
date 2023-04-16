<?php

// for newConcertGroup

function searchIfSameEventDateAccordingMusicGroup(string $date_event, PDO $pdo)
{
    $query = "SELECT events.*, venue.*, musicgroup.id_musicGroup 
    FROM l_event_musicgroup 
    JOIN events ON events.id_event = l_event_musicgroup.id_event 
    JOIN venue ON events.id_venue = venue.id_venue 
    JOIN musicgroup ON musicgroup.id_musicGroup = l_event_musicgroup.id_musicGroup 
    WHERE events.date_event = :date_event;";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'date_event' => $date_event,
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchIfSameEventDateAccordingMusicGroupForUpdate(string $date_event, int $id_event, PDO $pdo)
{
    $query = "SELECT events.*, venue.*, musicgroup.id_musicGroup
    FROM l_event_musicgroup
    JOIN events ON events.id_event = l_event_musicgroup.id_event
    JOIN venue ON events.id_venue = venue.id_venue
    JOIN musicgroup ON musicgroup.id_musicGroup = l_event_musicgroup.id_musicGroup
    WHERE events.date_event = :date_event
    AND events.id_event <> :id_event;";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'date_event' => $date_event,
        'id_event' => $id_event
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getHeadlineGroup(PDO $pdo, int $id_event)
{
    $query = "SELECT musicgroup.name_musicGroup,l_event_musicgroup.id_musicGroup FROM l_event_musicgroup 
    JOIN musicgroup ON musicgroup.id_musicGroup = l_event_musicgroup.id_musicGroup 
    WHERE l_event_musicgroup.headline_event = 1 AND l_event_musicgroup.id_event = :id_event;";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'id_event' => $id_event
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getMusicGroupwithoutHeadlineGroup(PDO $pdo, int $id_event)
{
    $query = "SELECT musicgroup.name_musicGroup,l_event_musicgroup.id_musicGroup FROM l_event_musicgroup 
    JOIN musicgroup ON musicgroup.id_musicGroup = l_event_musicgroup.id_musicGroup 
    WHERE l_event_musicgroup.headline_event = 0 AND l_event_musicgroup.id_event = :id_event;";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'id_event' => $id_event
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countOfMusicGroup(PDO $pdo, int $id_event)
{
    $query = "SELECT count(musicgroup.name_musicGroup) AS 'number of music group' 
    FROM l_event_musicgroup JOIN musicgroup ON musicgroup.id_musicGroup = l_event_musicgroup.id_musicGroup 
    WHERE l_event_musicgroup.id_event = :id_event;";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'id_event' => $id_event
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function listMusicGroupAndStyleAccordingToIdEvent(PDO $pdo, int $id_event)
{
    $query = "SELECT musicgroup.name_musicGroup, style.name_style 
    FROM l_musicgroup_style 
    JOIN musicgroup ON l_musicgroup_style.id_musicGroup = musicgroup.id_musicGroup 
    JOIN style ON l_musicgroup_style.id_style = style.id_style 
    JOIN l_event_musicgroup ON l_musicgroup_style.id_musicGroup = l_event_musicgroup.id_musicGroup 
    WHERE l_event_musicgroup.id_event = :id_event;";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'id_event' => $id_event
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}






