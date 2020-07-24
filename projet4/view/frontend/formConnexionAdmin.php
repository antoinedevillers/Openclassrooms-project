<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<section id='sectionConnexionAdmin'>
	<div id="formulaireAdministrateur">
		<h2> Connexion en tant qu'administrateur </h2>
		<div class='messageError'>
		<?php if (isset($_SESSION['error'])){ echo 'Tous les champs ne sont pas remplis';}
                unset($_SESSION['error']);
                ?>
        <?php if (isset($_SESSION['errorId'])){ echo 'Mauvais identifiant ou mot de passe !';}
                unset($_SESSION['errorId']);
                ?>
        </div>
	    <form method="post" action="index.php?action=connexionAdmin">
	        <p><label for="pseudo"> Pseudo</label> : <input type="pseudo" name="pseudo_Connexion" id="pseudo_Connexion" /></p>
	        <p><label for = "mot de passe"> Mot de passe </label> : <input type="password" name="pass_Connexion" id="pass_Connexion"/></p>
	        <p><input type="submit" name="Se connecter"></p>
	    </form>
	</div>
</section>
<p class='returnListPosts'><a href="index.php#derniersbillets">Retour à la liste des billets</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>