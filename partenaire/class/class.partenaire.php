<?php

class Partenaire
{

    /**
     * Ajout d'un partenaire avec vérification unicité sur nom et logo
     * @param string $nom
     * @param string $logo
     * @param string $reponse
     * @return bool
     */
    public static function ajouter(string $nom, string $logo, string &$reponse): bool
    {
        $ok = false;
        $sql = <<<EOD
            Select id
            From partenaire
            Where nom = :nom
            and logo = :logo
EOD;
        $db = Database::getInstance();
        $curseur = $db->prepare($sql);
        $curseur->bindParam('nom', $nom);
        $curseur->bindParam('logo', $logo);
        $curseur->execute();
        $ligne = $curseur->fetch();
        $curseur->closeCursor();
        if ($ligne)
            $reponse = "Ce partenaire existe déjà";
        else {

            // ajout dans la table partenaire

            $sql = <<<EOD
        insert into partenaire(nom, logo)
        values (:nom, :logo);
EOD;

            $curseur = $db->prepare($sql);
            $curseur->bindParam('nom', $nom);
            $curseur->bindParam('logo', $logo);
            try {
                $curseur->execute();
                $ok = true;
            } catch (Exception $e) {
                $reponse = substr($e->getMessage(), strrpos($e->getMessage(), '#') + 1);
            }
        }
        return $ok;
    }

    /**
     * Retourne la liste des partenaires
     * @return array
     */
    public static function getLesPartenaires(): array
    {
        $db = Database::getInstance();
        $sql = <<<EOD
            Select id, nom, logo, actif
            From partenaire
            Order by nom;
EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;
    }


    public static function modifierActif(int $id, string &$reponse): bool
    {

    }

}