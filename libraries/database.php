<?php

class Database
{
    /**
     * 2. Connexion à la base de données avec PDO
     * Attention, on précise ici deux options :
     * - Le mode d'erreur : le mode exception permet à PDO de nous prévenir violament quand on fait une connerie ;-)
     * - Le mode d'exploitation : FETCH_ASSOC veut dire qu'on exploitera les données sous la forme de tableaux associatifs
     */

    /**
     * Retourne la variable pdo pour la connexion à la BDD
     * @return PDO
     */
    public static function getPdo()
    {

        $pdo = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', 'online@2017', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        return $pdo;
    }
}
