<?php

require_once('libraries/database.php');

class Comment
{

    /**
     * Revoies la liste des commentaires de l'article en question
     * 
     * @param integer $id
     * @return array $comments
     */
    public function findAllWithArticle(int $article_id): array
    {

        $pdo = getPdo();

        $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id  ORDER BY created_at DESC");
        $query->execute(['article_id' => $article_id]);
        $commentaires = $query->fetchAll();

        return $commentaires;
    }

    /**
     * Récupère un commentaire gr^race à son identifiant
     * 
     * @param integer 
     */
    public function find(int $id)
    {
        $pdo = getPdo();
        $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
        $comment = $query->fetch();

        return $comment;
    }

    /**
     * Supprime un commentaire
     * 
     * @param integer 
     */
    public function delete(int $id): void
    {
        $pdo = getPdo();
        $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
    }

    /**
     * Permet d'enregistrer un commentaire
     * 
     * @param integer $id
     * 
     * @return void
     */
    public function insert(string $author, string $content, int $article_id): void
    {
        $pdo = getPdo();
        $query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}
