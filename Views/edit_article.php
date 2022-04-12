<?php
require 'layouts/header.php';
require '../connec.php';
require '../Model/ArticleModel.php';

if (isset($_GET['id'])) {
    $article = getOneArticle($_GET['id']);
}

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $article = array_map('trim', $_POST);

    if (!empty($_POST['title']) && !empty($_POST['img']) && !empty($_POST['content'])) {
        createArticle($article);
    } else {
        echo "Tous les champs sont requis";
    }
}

if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    if (!empty($_GET['title']) && !empty($_GET['img']) && !empty($_GET['content'])) {
        $article = array_map('trim', $_GET);
        updateArticle($article);
    } else {
        echo "Tous les champs sont requis";
    }
}
// Récupérer les infos de l'article à updater si il y en a un
// S'inspirer de la logique pour le delete

// Récupérer les données du formulaire et les traiter en fonction de si 
// le form est en create ou en update 
// Traiter les erreurs => tous les champs doivent être rempli
?>
<div class="container">
    <div class="row">
        <!-- FORMULAIRE CREATE & UPDATE -->
        <div class="col-12">
            <!-- CONDITION D'AFFICHAGE ERREUR FORM -->
            <div class="alert alert-danger" role="alert">
                A simple danger alert—check it out!
            </div>

            <form method="POST">
                <div class="form-group">
                    <label for="title">Titre *</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= isset($article['id']) ? $article['title'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="img">Image * ( https://www.placecage.com/640/360 )</label>
                    <input type="text" class="form-control" id="img" name="img" value="<?= isset($article['id']) ? $article['img'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="content">Texte *</label>
                    <textarea class="form-control" id="content" name="content" value=""><?= isset($article['id']) ? $article['content'] : '' ?></textarea>
                </div>
                <div class="form-group">
                    <small>Tous les champs sont obligatoires *</small>
                </div>
                <input type="text" class="d-none" id="id" name="id" value="">
                <div class="text-center mt-5">
                    <?php if (isset($_GET['id'])) { ?>
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                    <?php } else { ?>
                        <button type="submit" class="btn btn-primary" name="create">Create</button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require 'layouts/footer.php'; ?>