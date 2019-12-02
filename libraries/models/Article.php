<?php
require_once('libraries/models/Model.php');

class Article extends Model
{
    /**
     * Retourn la liste des articles classés par date de création
     * 
     * @return $articles
     */
    public function findAll(): array
    {

        // $pdo = getPdo();
        $resultats = $this->pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
        // On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();

        return $articles;
    }

    /**
     * Retourne un article grâce à son id
     * 
     * @param integer $id
     * @return array $article
     */
    public function find(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM articles WHERE id = :article_id");

        // On exécute la requête en précisant le paramètre :article_id 
        $query->execute(['article_id' => $id]);

        // On fouille le résultat pour en extraire les données réelles de l'article
        $article = $query->fetch();

        return $article;
    }

    /**
     * Supprime un article de la BDD
     * 
     * @param integer $id
     * @return void 
     */
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare('DELETE FROM articles WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}
