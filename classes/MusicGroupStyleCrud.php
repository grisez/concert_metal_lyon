<?php

class VenueCrud 
{
    private PDO $pdo;

    public function __construct(PDO $pdo) 
    {
        $this->pdo = $pdo;
    }


    
    public function list(){
        $query = "SELECT * FROM venue ORDER BY id_venue ASC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function new(string $name)
    {
    $query = "INSERT INTO venue VALUES (null, :name_venue)";
    $stmt = $this->pdo->prepare($query);

    $stmt->execute([
        'name_venue'=>$name
    ]);
    }

    public function update(string $modifyName , int $selectId) : int
    {
        $query = "UPDATE venue SET name_venue=:modify_name WHERE id_venue=:select_id ";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'modify_name' => $modifyName,
            'select_id' => $selectId
        ]);
        return $stmt->rowCount() > 0;
    }

    public function delete(int $selectId) : int
    {
        $query = "DELETE FROM Venue WHERE id_venue=:id";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'id' => $selectId
        ]);
        return $stmt->rowCount();
    }
}

