<?php $title = 'Modification d\'article'; ?>

<?php ob_start(); ?>

<section>
    
    <div class='containerChangeArticle'>
        <h2> Modifier l'article </h2>
        <div class='messageError' id='messageError'>
        <?php if (isset($_SESSION['error'])){ echo 'Tous les champs ne sont pas remplis';}
                unset($_SESSION['error']);
                ?>
        </div>  
        
        <form action="index.php?action=changeArticle&amp;id=<?= $article->id() ?>#messageError" method="post">
            <div class="inputFormArticle">
                <label for="title">Titre</label><br />
                <input type="text" id="title" name="title" size="80" value="<?= $article->title() ?>"/>
            </div>
            <div class="inputFormArticle">
                <label for="content">Contenu</label><br />
                <textarea id="mytextarea" name="content" rows="40"><?= $article->content() ?></textarea>
            </div>
            <div class="inputFormArticle">
                <input type="submit" value="Envoyer les modifications"/>
            </div>
        </form>
    </div>
    
</section>
<p class='returnListArticles'><a href="index.php" >Retour à la page d'accueil</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>