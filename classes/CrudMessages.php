<?php

class CrudMessages
{
    public const ADD_IS_VALID = 1;
    public const REMOVE_IS_VALID = 2;
    public const MODIFY_IS_VALID = 3;
    public const INVALID_FORM = 4;
    public const INVALID_FORM_DATE = 5;
    public const INVALID_DUPLICATE = 6;
    public const INVALID_GROUP = 7;
    public const INVALID_NAME = 8;

    public static function getCrudMessage(int $code): string
    {
        switch ($code) {
            case CrudMessages::ADD_IS_VALID:
                return "Ajouter avec succès !";
                break;
            case CrudMessages::REMOVE_IS_VALID:
                return "Suppression pris en compte";
                break;
            case CrudMessages::MODIFY_IS_VALID:
                return "Modification pris en compte";
                break;
            case CrudMessages::INVALID_FORM:
                return "Veuillez remplir tout les champs";
                break;
            case CrudMessages::INVALID_FORM_DATE:
                return "Date obligatoire";
                break;
            case CrudMessages::INVALID_DUPLICATE:
                return "Un groupe est déja sélectionné dans tête d'affiche";
                break;
            case CrudMessages::INVALID_GROUP:
                return "impossible de valider cette requête un ou plusieurs groupe(s) est (sont) déja mentionné(s) à cette date";
                break;
            case CrudMessages::INVALID_NAME:
                return "Nom déja enregistré , veuillez changer de nom ou modifier celui déja inscrit";
                break;
            default:
                return "Erreur veuillez contacter l'administrateur";
        }
    }
}
