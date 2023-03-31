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

    public function update(string $modifyName , string $selectName)
    {
        $query = "UPDATE venue SET name_venue= :modify_name WHERE name_venue= :select_name ";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'modify_name' => $modifyName,
            'select_name' => $selectName
        ]);
    }

    public function delete(){

    }
}

