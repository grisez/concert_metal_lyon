<?php
class ConnexionMessages
{
    public const CONNEXION_IS_VALID = 1;
    public const INVALID_EMAIL = 2;
    public const INVALID_PASSWORD = 3;
    public const DECONNEXION =4;


    public static function getConnexionMessage(int $code): string
{
    switch ($code) {
        case ConnexionMessages::CONNEXION_IS_VALID:
            return "Connecté avec succès !";
            break;
        case ConnexionMessages::INVALID_EMAIL:
            return "Erreur sur l'adresse mail";
            break;
        case ConnexionMessages::INVALID_PASSWORD:
            return "Erreur sur le mot de passe";
            break;
            case ConnexionMessages::DECONNEXION:
                return "Déconnexion avec succès !";
                break;
        default:
            return "Erreur veuillez contacter l'administrateur";
    }
}
}