<?php $title = 'Article Développement Web'; ?>

<?php ob_start(); ?>

<section>   
	<div class='messageError' id='comment'>
                <?php if (isset($_SESSION['error'])){ echo 'Tous les champs ne sont pas remplis';}
                        unset($_SESSION['error']);
                        ?>
            </div>
            <form action="" method="post">
                <div>
                    <label for="author">Votre nom</label><br />
                    <input type="text" id="author" class='inputAddComments' name="author" size="35"/>
                </div>
                <div>
                    <label for="comment">Message</label><br />
                    <textarea id="comment" class='inputAddComments' name="com" rows="10" cols="30"></textarea>
                </div>
                <div>
                    <input type="submit" />
                </div>
</section>
<p class='returnHome'><a href="index.php">Retour à la liste des articles</a></p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>