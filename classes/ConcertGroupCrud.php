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
        $query = "SELECT events.*,DATE_FORMAT(events.date_event, '%d %M %Y') 
        as NewDate_event, venue.*, GROUP_CONCAT(musicgroup.name_musicGroup SEPARATOR ', ') 
        as musicGroups FROM l_event_musicgroup 
        JOIN events ON events.id_event = l_event_musicgroup.id_event 
        JOIN venue ON events.id_venue = venue.id_venue 
        JOIN musicgroup ON musicgroup.id_musicGroup = l_event_musicgroup.id_musicGroup 
        GROUP BY events.id_event ORDER BY events.date_event ASC;";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function rowEventGroupById(int $id_event)
    {
        $query = "SELECT events.*, venue.*, GROUP_CONCAT(musicgroup.name_musicGroup SEPARATOR ', ') 
        as musicGroups FROM l_event_musicgroup 
        JOIN events ON events.id_event = l_event_musicgroup.id_event 
        JOIN venue ON events.id_venue = venue.id_venue 
        JOIN musicgroup ON musicgroup.id_musicGroup = l_event_musicgroup.id_musicGroup  
        WHERE events.id_event = :id_event;";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'id_event' => $id_event,
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //faire un tableau pour les paramètres de la méthode
    public function newEvent(mixed $name_event, string $date_event, mixed $img_event, mixed $price_event, int $id_venue)
    {
        $query = "INSERT INTO events
            VALUES (null,:name_event,:date_event, :img_event, :price_event,:id_venue);";

        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'name_event' => $name_event,
            'date_event' => $date_event,
            'img_event' => $img_event,
            'price_event' => $price_event,
            'id_venue' => $id_venue
        ]);

    }

    public function newLEventMusicgroups(array $musicGroups)
        {
            $stmt = $this->pdo->query("SELECT LAST_INSERT_ID()");
            $last_id_event = $stmt->fetchColumn();
            // var_dump($last_id_event);
            foreach ($musicGroups as $musicGroup){
                
            $query = "INSERT INTO l_event_musicgroup
                    -- last insert id = recupère le dernier id de la dernière requète --
                    VALUES (:id_musicGroup, :id_event,:headline_event);";
    
            $stmt = $this->pdo->prepare($query);
    
            $stmt->execute([
                'id_musicGroup' => $musicGroup['id_musicGroup'],
                'id_event' =>$last_id_event,
                'headline_event' => $musicGroup['headline_event']
            ]);
            }
        }

    public function updateEvents(int $id_event,string $name_event,int $date_event,string $img_event,int $price_event,int $id_venue) {
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
