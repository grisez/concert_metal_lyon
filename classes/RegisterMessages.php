<?php

class RegisterMessages
{
    public const REGISTER_IS_VALID = 1;
    public const INVALID_FORM = 2;
    public const INVALID_EMAIL = 3;
    public const INVALID_PASSWORD = 4;

    public static function getRegisterMessage(int $code): string
    {
        switch ($code) {
            case RegisterMessages::REGISTER_IS_VALID:
                return "Enregistré avec succès !";
                break;
            case RegisterMessages::INVALID_FORM:
                return "Veuillez remplir tout les champs";
                break;
            case RegisterMessages::INVALID_EMAIL:
                return "Email déja enregistrer veuillez vous connecter";
                break;
            case RegisterMessages::INVALID_PASSWORD:
                return "Le mot de passe doit être supérieur à 8 caractères";
                break;
            default:
                return "Erreur veuillez contacter l'administrateur";
        }
    }
}
