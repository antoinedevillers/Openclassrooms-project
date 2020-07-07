<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> </p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>

<h2> Modifier le commentaire </h2>

<form action="index.php?action=changeComment&amp;id=<?= $comment['id']?>" method="post">
    
    <div>
        <input id="postId" name="postId" type="hidden" value="<?= $comment['post_id'] ?>">
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>