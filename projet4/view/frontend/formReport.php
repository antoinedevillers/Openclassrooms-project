<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h2> Signaler ce commentaire </h2>
<p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> </p>
<p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
<form action="index.php?action=reportComment&amp;id=<?= $comment['id'] ?>" method="post">
	<input id="postId" name="postId" type="hidden" value="<?= $comment['post_id'] ?>">
   <p>Je souhaite signaler un commentaire ne respectant pas les règles </p>
    <div>
        <input type="submit" value="Signaler ce commentaire" />
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>