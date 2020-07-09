<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>



    <div class="news">
        <h3>
            <?= htmlspecialchars($post['title']) ?>
            <em>le <?= $post['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </p>
    </div>

<h2> Modifier le billet </h2>
    <form action="index.php?action=changePost&amp;id=<?= $post['id'] ?>" method="post">
        <div>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="title" />
        </div>
        <div>
            <label for="post">Contenu</label><br />
            <textarea id="content" name="content"></textarea>
        </div>
        <div>
            <input type="submit" value="Envoyer les modifications"/>
        </div>
    </form>
<p><a href="index.php">Retour à la liste des billets</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>