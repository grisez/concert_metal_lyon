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
            'id_musicGroup' => $id_musicGroup,
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function new(string $name_musicGroup, $id_country, int $id_style)
    {
        $query = "INSERT INTO musicgroup (name_musicGroup, id_country)
            VALUES (:name_musicGroup,:id_country);

            INSERT INTO l_musicgroup_style
            VALUES (LAST_INSERT_ID(), :id_style);";

        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'name_musicGroup' => $name_musicGroup,
            'id_country' => $id_country,
            'id_style' => $id_style
        ]);
    }

    public function update(int $id_musicGroup, string $name_musicGroup, int $id_country, int $id_style)
    {
        $query = "UPDATE musicgroup SET name_musicGroup = :name_musicGroup , id_country = :id_country WHERE id_musicGroup = :id_musicGroup;
        UPDATE l_musicgroup_style SET id_style = :id_style WHERE id_musicGroup = :id_musicGroup;";
        
        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'id_musicGroup' => $id_musicGroup,
            'name_musicGroup' => $name_musicGroup,
            'id_country' => $id_country,
            'id_style' => $id_style
        ]);
    }

    public function delete(int $id_musicGroup)
    {
        $query = "DELETE FROM l_musicgroup_style WHERE id_musicgroup = :id_musicGroup";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'id_musicGroup' => $id_musicGroup
        ]);

        $query = "DELETE FROM musicgroup WHERE id_musicgroup = :id_musicGroup";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'id_musicGroup' => $id_musicGroup
        ]);
    } 
}

