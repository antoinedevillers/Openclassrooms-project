<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<section>
	<div class='messageError'>
		<?php echo 'Erreur : ' .  $errorMessage ?>
	</div>
</section>
<p><a href="index.php">Revenir à l'accueil</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>