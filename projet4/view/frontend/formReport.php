<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<section>
	<div class='formReport'>
		<h2> Signaler ce commentaire </h2>
		<p>(Je souhaite signaler un commentaire ne respectant pas les règles de ce blog)</p>
		<div class='comment'>
			<p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> </p>
			<p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
		</div>
		<form action="index.php?action=reportComment&amp;id=<?= $comment['id'] ?>" method="post">
			<input id="postId" name="postId" type="hidden" value="<?= $comment['post_id'] ?>">
		   
		    <div>
		        <input type="submit" value="Signaler ce commentaire" />
		    </div>
		</form>
	</div>
</section>
<p class='returnListPosts'><a href="index.php?action=post&amp;id=<?= $comment['id'] ?>" >Retour au billet</a></p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>