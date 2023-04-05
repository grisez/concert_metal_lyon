<?php

class ConcertGroupCrud
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function list()
    { 
    $query = "SELECT events.*, venue.*, GROUP_CONCAT(musicgroup.name_musicGroup SEPARATOR ', ')
    as musicGroups FROM l_event_musicgroup 
    JOIN events ON events.id_event = l_event_musicgroup.id_event 
    JOIN venue ON events.id_venue = venue.id_venue 
    JOIN musicgroup ON musicgroup.id_musicGroup = l_event_musicgroup.id_musicGroup 
    GROUP BY events.id_event ORDER BY events.date_event ASC;";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowEventMusicGroupById(int $id_event)
    {
        $query = "SELECT events.*, venue.*, GROUP_CONCAT(musicgroup.name_musicGroup SEPARATOR ', ') 
        as musicGroups FROM l_event_musicgroup 
        JOIN events ON events.id_event = l_event_musicgroup.id_event 
        JOIN venue ON events.id_venue = venue.id_venue 
        JOIN musicgroup ON musicgroup.id_musicGroup = l_event_musicgroup.id_musicGroup  
        WHERE events.id_event = :id_event";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'id_event' => $id_event,
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function newEvent(string $name_event, int $date_event, string $img_event, int $price_event, int $id_venue)
    {
        $query = "INSERT INTO events
            VALUES (:name_event,:date_event, :img_event, :price_event,:id_venue);";

        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'name_event' => $name_event,
            'date_event' => $date_event,
            'img_event' => $img_event,
            'price_event' => $price_event,
            'id_venue' => $id_venue
        ]);
    }

    public function newLEventMusicGroup(int $id_musicGroup, int $headline_event)
    {
        // $query = "SELECT max(id_event) FROM Events;

        $query = "INSERT INTO l_event_musicgroup
            -- last insert id = recupère le dernier id de la dernière requète --
            VALUES (:id_musicGroup,LAST_INSERT_ID(),:headline_event);";

        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'id_musicGroup' => $id_musicGroup,
            'headline_event' => $headline_event,

        ]);
    }

    public function updateEvents(
        $id_event, string $name_event, int $date_event, string $img_event, int $price_event, int $id_venue)
    {
        $query = "UPDATE events SET name_event = :name_event , date_event = :date_event, img_event = :img_event, price_event = :price_event; id_venue = :ed_venue WHERE id_event = :id_event;
        UPDATE l_event_musicgroup SET id_musicGroup = :id_musicGroup WHERE id_event = :id_event;";
        
        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'id_event' => $id_event,
            'name_event' => $name_event,
            'date-event' => $date_event,
            'img_event' => $img_event,
            'price_event' => $price_event,
            'id_venue' => $id_venue
        ]);
    }



    public function delete(int $id_event)
    {
        $query = "DELETE FROM l_event_musicgroup WHERE id_event = :id_event";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'id_event' => $id_event
        ]);

        $query = "DELETE FROM events WHERE id_event = :id_event";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'id_event' => $id_event
        ]);
    } 

}
