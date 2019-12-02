<?php

/**
 * 2. Connexion à la base de données avec PDO
 * Attention, on précise ici deux options :
 * - Le mode d'erreur : le mode exception permet à PDO de nous prévenir violament quand on fait une connerie ;-)
 * - Le mode d'exploitation : FETCH_ASSOC veut dire qu'on exploitera les données sous la forme de tableaux associatifs
 */

/**
 * Retourne la variable pdo pour la connexion à la BDD
 * @return $pdo
 */
function getPdo()
{

    $pdo = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', 'online@2017', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    return $pdo;
}

/**
 * Retourn la liste des articles classés par date de création
 * 
 * @return $articles
 */
function findAllArticles(): array
{

    $pdo = getPdo();
    $resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
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
function findArticle(int $id)
{
    $pdo = getPdo();
    $query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");

    // On exécute la requête en précisant le paramètre :article_id 
    $query->execute(['article_id' => $id]);

    // On fouille le résultat pour en extraire les données réelles de l'article
    $article = $query->fetch();

    return $article;
}

/**
 * Revoies la liste des commentaires de l'article en question
 * 
 * @param integer $id
 * @return array $comments
 */
function findAllComments(int $article_id): array
{

    $pdo = getPdo();

    $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id  ORDER BY created_at DESC");
    $query->execute(['article_id' => $article_id]);
    $commentaires = $query->fetchAll();

    return $commentaires;
}

/**
 * Supprime un article de la BDD
 * 
 * @param integer $id
 * @return void 
 */
function deleteArticle(int $id): void
{
    $pdo = getPdo();
    $query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
    $query->execute(['id' => $id]);
}

/**
 * Récupère un commentaire gr^race à son identifiant
 * 
 * @param integer 
 */
function findComment(int $id)
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
function deleteComment(int $id): void
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
function insertComment(string $author, string $content, int $article_id): void
{
    $pdo = getPdo();
    $query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
    $query->execute(compact('author', 'content', 'article_id'));
}
