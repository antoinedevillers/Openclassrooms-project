<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<p>
<?php echo 'Erreur : ' .  $errorMessage ?>
</p>
<p><a href="index.php?action=post&amp;id=<?= $_GET['id'] ?>">Revenir au billet</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>