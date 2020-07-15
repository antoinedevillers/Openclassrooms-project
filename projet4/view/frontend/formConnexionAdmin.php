<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<section id='sectionConnexionAdmin'>
	<div class='messageError'>
		<?php if (isset($errorMessage)){ echo $errorMessage; }?>
	</div>
	<div id="formulaireAdministrateur">
		<h2> Connexion en tant qu'administrateur </h2>
		    <form method="post" action="index.php?action=connexionAdmin">
		        <p><label for="pseudo"> Pseudo</label> : <input type="pseudo" name="pseudo_Connexion" id="pseudo_Connexion" /></p>
		        <p><label for = "mot de passe"> Mot de passe </label> : <input type="password" name="pass_Connexion" id="pass_Connexion"/></p>
		        <p><input type="submit" name="Se connecter"></p>
		    </form>
	</div>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>