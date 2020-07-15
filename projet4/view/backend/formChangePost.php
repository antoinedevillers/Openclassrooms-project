<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>


<section>
    <div class="news">
        <h3>
            <?= htmlspecialchars($post['title']) ?>
            <em>le <?= $post['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </p>
    </div>
    <div class='messageError'>
        <?php if (isset($errorMessage)){ echo $errorMessage; }?>
    </div>
    <h2> Modifier le billet </h2>
        <form action="index.php?action=changePost&amp;id=<?= $post['id'] ?>" method="post">
            <div class="inputFormPost">
                <label for="title">Titre</label><br />
                <input type="text" id="title" name="title" size="80" />
            </div>
            <div class="inputFormPost">
                <label for="content">Contenu</label><br />
                <textarea id="mytextarea" name="content"></textarea>
            </div>
            <div class="inputFormPost">
                <input type="submit" value="Envoyer les modifications"/>
            </div>
        </form>
    <p><a href="index.php">Retour à la liste des billets</a></p>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>