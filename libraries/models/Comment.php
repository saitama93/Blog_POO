<?php

require_once('libraries/models/Model.php');

class Comment extends Model
{
    protected $table = "comments";
    /**
     * Revoies la liste des commentaires de l'article en question
     * 
     * @param integer $id
     * @return array $comments
     */
    public function findAllWithArticle(int $article_id): array
    {

        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id  ORDER BY created_at DESC");
        $query->execute(['article_id' => $article_id]);
        $commentaires = $query->fetchAll();

        return $commentaires;
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
        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}
