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

