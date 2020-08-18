<?php $title = 'Création d\'article'; ?>

<?php ob_start(); ?>
<section id='formCreateArticle'>
    
    <h2> Ajouter un nouvel article </h2>
    <div class='messageError'>
        <?php if (isset($_SESSION['error'])){ echo 'Tous les champs ne sont pas remplis';}
                unset($_SESSION['error']);
                ?>
    </div>   
    <form action="index.php?action=addArticle" method="post">
        <div class="inputFormArticle">
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="title" size="80" />
        </div>
        <div class="inputFormArticle">
            <label for="content">Contenu</label><br />
            <textarea id="mytextarea" name="content" rows="40" cols="80"></textarea>
        </div>
        <div class="inputFormArticle">
            <input type="submit" value="Ajouter"/>
        </div>
    </form>
</section>
<p class='returnListArticles'><a href="index.php" >Retour à la page d'accueil</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>