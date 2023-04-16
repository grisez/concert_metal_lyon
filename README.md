#Projet concert de metal Lyon 

##Introduction :

Je vais vous expliquer mon projet ( réalisation en langages PHP et JS)

Le but c'est de pouvoir trouver un concert de metal sur lyon, en fonction du lieu, du style ou groupe de musique. Nous avons la possibilité de nous connecter  pour avoir accès à notre agenda , sur celui ci, nous retrouvons les concerts que l'on a selectionné, regrouper en deux parties "j'y vais" et "peux être que j'y vais", une personnes connecté peux supprimer un concert , ou modifier son status "j'y vais peut être" en "j'y vais" ou l'inverse dans sont agenda. Quand la date de concert est à J-2 la personnes reçois un mail récapitulatif du concert pour ne pas oublier d'y aller. 

Malheureusement je n'ai pas terminé mais je compte le faire plus tard, pour le moment vous pouvez vous inscrire , vous connecter en t'en que user mais aussi en t'en que Admin , les codes pour l'administrateur sont : admin@gmail.com et le mot de passe est : admin , j'ai ajouter directement l'adresse mail de l'utilisateur dans le code "dans la navbar" pour avoir accès à la page admin , norlement j'aurais du ajouter une colonne en plus pour dire que cette utilisateur est admin ou pas avec un système de boulean mais je n'ai pas eu me temps, je sais que cette pratique n'est pas du tout bonne car tout le monde peux avoir accès à l'adresse mail de l'admin .

Sur cette page Admin vous pouvez éffectuer un crud sur un groupe de musique mais aussi pour un concert 

##BDD
Voici ma première version de ma BDD 
![image de ma base de donnée](assets/img/bdd%20first.png)

Voici ma deuxième version de ma BDD 
j'ai ajouté une table country
![image de ma base de donnée](assets/img/bdd%20second.PNG)


##Changement de mon code :

crud musicGroup :

Pour la méthode update je suis partie sur le choix de pouvoir modifier qu'une choses à la foix ou changer tout : mais ce choix est trop avancé pour une méthode plutôt simple : voici mon code avant et après 

```php
public function update(int $id_musicGroup, string $name_musicGroup, mixed $name_country, mixed $name_style)
    {
        $query = "UPDATE musicgroup SET ";
        $paramsStmt = [];
    
        if (!empty($name_musicGroup)) {
            $query .= "name_musicGroup = :name_musicGroup, ";
            $paramsStmt['name_musicGroup'] = $name_musicGroup;
        }
        if (!empty($name_country)) {
            $query .= "id_country = (SELECT id_country FROM country WHERE name_country = :name_country), ";
            $paramsStmt['name_country'] = $name_country;
        }
    
        $query = rtrim($query, ", ");
        $query .= " WHERE id_musicgroup = :id_musicGroup";
        $paramsStmt['id_musicGroup'] = $id_musicGroup;
    
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($paramsStmt);
    
        if (!empty($name_style)) {
            $query = "UPDATE l_musicgroup_style SET id_style = (SELECT id_style FROM style WHERE name_style = :name_style) WHERE id_musicGroup = :id_musicGroup";
            $paramsStmt2 = [
                'id_musicGroup' => $id_musicGroup,
                'name_style' => $name_style
            ];
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($paramsStmt2);
        }
    }
```

nouveau code : 
```php
  public function update(int $id_musicGroup, string $name_musicGroup, int $id_country, int $id_style):void
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
```


##problématique 

L'affichage de mon crud pour mes concert : je souhaitais avoir un colonne avec la liste de tout les groupes en fonction d'un évenement : j'ai cherché sur internet : https://sql.sh/fonctions/group_concat

```php
SELECT events.*, venue.*, GROUP_CONCAT(musicgroup.name_musicGroup SEPARATOR ', ')
as musicGroups FROM l_event_musicgroup JOIN events ON events.id_event = l_event_musicgroup.id_event 
JOIN venue ON events.id_venue = venue.id_venue JOIN musicgroup ON musicgroup.id_musicGroup = l_event_musicgroup.id_musicGroup 
GROUP BY events.id_event ORDER BY events.date_event ASC;
```

##Amélioration de mon code 

Je n'ai pas eu le temps de finir que je le souhaitais, voici les axes d'amélioratin : 
Fonction : ajouter un type de retour comme j'ai réalisé pour les méthodes de classes
ajouter une fonction pour changer le nom de la date car pour le moment elle est en anglais, je n'ai pas pu la changer directement sous sql.

je souhaite ajouter un outil de recherche, j'ai mis de coté ce code : 

```php
$query = "DELETE FROM musicgroup WHERE id_musicgroup = :search";
function Search( PDO $pdo, string $search, string $query): array
{
$stmt = $pdo->prepare($query);
$stmt->execute([
    'search' => '%' . $search . '%'
]);
return $stmt->fetchall();
}
```

je pourrais encore mieux factoriser mon code , il y a encore trop de lignes dans les fichiers, et revoir le nomage de mes variables.

##Finalité 

j'ai eu pas mal de problèmes sur ce projet , mais je suis assez fière de moi, je pense que le crud des concerts à été le plus difficile pour moi, surtout pour créer un évenement car on ne sais pas à l'avance combien de groupes de musique nous allons avoir pour un concert donc j'ai du faire cette requète en deux méthodes. 








