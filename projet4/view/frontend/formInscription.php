<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<h2> Formulaire d'inscription</h2>

    <form method="post" action="index.php?action=addAdmin">

        <p><label for="pseudo"> Pseudo</label> : <input type="pseudo" name="pseudo_Subscription" id="pseudo_Subscription" /></p>
        <p><label for = "mot de passe"> Mot de passe </label> : <input type="password" name="pass_Subscription1" id="pass_Subscription1"/></p>
        <p><label for = "mot de passe"> Retapez le mot de passe</label> : <input type="password" name="pass_Subscription2" id="pass_Subscription2"/></p>
        <p><input type="submit" value="Envoyer"/></p>

    </form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>