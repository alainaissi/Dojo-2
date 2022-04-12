<?php
// CRUD FOR ARTICLE
// -----------------------------------------------------------------------------------------------------------------------

// READ ALL
function getAllArticles()
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $querySql = "SELECT * FROM article";
    try {
        $sendRequest = $pdo->query($querySql);
        $articles = $sendRequest->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        return $error;
    }
}

// -----------------------------------------------------------------------------------------------------------------------
// READ ONE
function getOneArticle(int $id)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    try {
        $query = "SELECT * FROM article WHERE id=:id";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $article = $statement->fetch(PDO::FETCH_ASSOC);
        return $article;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        return $error;
    }
}

// -----------------------------------------------------------------------------------------------------------------------
// CREATE
function createArticle(array $data)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    try {
        $query = 'INSERT INTO article (title, img, content) VALUES (:title, :img, :content)';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $statement->bindValue(':img', $data['img'], PDO::PARAM_STR);
        $statement->bindValue(':content', $data['content'], PDO::PARAM_STR);
        $statement->execute();
        // After action redirect to index
        header('Location: http://localhost:8000/index.php');
    } catch (PDOException $e) {
        $error = $e->getMessage();
        return $error;
    }
}

// -----------------------------------------------------------------------------------------------------------------------
// UPDATE
function updateArticle(array $data)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    try {
        $query = "UPDATE article SET title = ':title', img = ':img', content = ':content' WHERE id=:id";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $statement->bindValue(':img', $data['img'], PDO::PARAM_STR);
        $statement->bindValue(':content', $data['content'], PDO::PARAM_STR);
        $statement->bindValue(':id', $data['id'], PDO::PARAM_INT);
        $statement->execute();
        // After action redirect to index
        header('Location: http://localhost:8000/index.php');
    } catch (PDOException $e) {
        $error = $e->getMessage();
        return $error;
    }
}

// -----------------------------------------------------------------------------------------------------------------------
// DELETE
function deleteArticle(int $id)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    try {
        // CODE ICI
        $deleteArticle = $pdo->prepare('DELETE FROM article WHERE id=:id');
        $deleteArticle->execute(['id' => $id]);
        // After action redirect to index
        header('Location: http://localhost:8000/index.php');
    } catch (PDOException $e) {
        $error = $e->getMessage();
        return $error;
    }
}

// BONUS-----------------------------------------------------------------------------------------------------------------
// SEARCH
function search(string $term)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        try {
        // CODE ICI
        $value = '%' . $term . '%';
        var_dump($value);
        $query = "SELECT * FROM article WHERE title LIKE :term ORDER BY title";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':term', $value, PDO::PARAM_STR);
        $statement->execute();
        $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
        var_dump($articles);
        return $articles;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        return $error;
    }
}
