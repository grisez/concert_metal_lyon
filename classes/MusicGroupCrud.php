<?php

class MusicGroupCrud
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function list()
    {
        $query = "SELECT musicgroup.*, style.*, country.id_country, country.name_country
        FROM l_musicgroup_style 
        JOIN musicgroup ON l_musicgroup_style.id_musicGroup = musicgroup.id_musicGroup
        JOIN style ON l_musicgroup_style.id_style = style.id_style
        JOIN country ON musicgroup.id_country = country.id_country  
        ORDER BY name_musicgroup ASC";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowMusicGroupById(int $id_musicGroup)
{
    $query = "SELECT musicgroup.*, style.*, country.id_country, country.name_country
        FROM l_musicgroup_style 
        JOIN musicgroup ON l_musicgroup_style.id_musicGroup = musicgroup.id_musicGroup
        JOIN style ON l_musicgroup_style.id_style = style.id_style
        JOIN country ON musicgroup.id_country = country.id_country  
        WHERE musicgroup.id_musicGroup = :id_musicGroup";

    $stmt = $this->pdo->prepare($query);
    $stmt->execute([
        'id_musicGroup'=> $id_musicGroup,
        ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function new(string $name_musicgroup, string $name_country, string $name_style)
    {
        $query = "INSERT INTO musicgroup (name_musicGroup, id_country)
            VALUES (:name_musicGroup, (SELECT id_country FROM country WHERE name_country = :name_country));

            INSERT INTO l_musicgroup_style (id_musicGroup, id_style)
            -- last insert id = recupère le dernier id de la dernière requète --
            VALUES (LAST_INSERT_ID(), (SELECT id_style FROM style WHERE name_style = :name_style));";
        
        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'name_musicGroup' => $name_musicgroup,
            'name_country' => $name_country,
            'name_style' => $name_style
        ]);
    }

    public function update(int $id_musicGroup, string $name_musicGroup, string $name_country, string $name_style)
    {
        $query = "UPDATE musicgroup
            SET";
        $paramsStmt = [];

        if (!empty($name_musicGroup)) {
            $query .= " name_musicGroup = :name_musicGroup,";
            $paramsStmt['name_musicGroup'] = $name_musicGroup;
        }
        if (!empty($name_country)) {
            $query .= " id_country = (SELECT id_country FROM country WHERE name_country = :name_country),";
            $paramsStmt['name_country'] = $name_country;
        }

        $query .= " WHERE id_musicgroup = :id_musicGroup";
        $paramsStmt['id_musicGroup'] = $id_musicGroup;

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($paramsStmt);

        if (!empty($name_style)) {
            $query = "INSERT INTO l_musicgroup_style (id_musicGroup, id_style)
                VALUES (:id_musicGroup, (SELECT id_style FROM style WHERE name_style = :name_style))";
            $paramsStmt = [
                'id_musicGroup' => $id_musicGroup,
                'name_style' => $name_style
            ];
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($paramsStmt);
        }
    }



    public function delete(int $selectId): int
    {
        $query = "DELETE FROM Venue WHERE id_venue=:id";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'id' => $selectId
        ]);
        return $stmt->rowCount();
    }
}
