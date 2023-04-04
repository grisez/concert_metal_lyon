<?php

class CrudMessages
{
    public const ADD_IS_VALID = 1;
    public const REMOVE_IS_VALID = 2;
    public const MODIFY_IS_VALID = 3;
    public const INVALID_FORM = 4;

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
            default:
                return "Erreur veuillez contacter l'administrateur";
        }
    }
}
