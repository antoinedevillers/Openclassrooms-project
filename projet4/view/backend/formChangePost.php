<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<section>
    <div class="news">
        <h3>
            <?= $post->title() ?>
            <em>le <?= $post->creation_date_fr() ?></em>
        </h3>
        
        <p>
            <?= $post->content() ?>
        </p>
    </div>
    <div class='containerChangePost'>
        <h2> Modifier le billet </h2>
        <div class='messageError' id='messageError'>
        <?php if (isset($_SESSION['error'])){ echo 'Tous les champs ne sont pas remplis';}
                unset($_SESSION['error']);
                ?>
        </div>  
        
        <form action="index.php?action=changePost&amp;id=<?= $post->id() ?>#messageError" method="post">
            <div class="inputFormPost">
                <label for="title">Titre</label><br />
                <input type="text" id="title" name="title" size="80" />
            </div>
            <div class="inputFormPost">
                <label for="content">Contenu</label><br />
                <textarea id="mytextarea" name="content"></textarea>
            </div>
            <div class="inputFormPost">
                <input type="submit" value="Envoyer les modifications"/>
            </div>
        </form>
    </div>
    
</section>
<p class='returnListPosts'><a href="index.php" >Retour à la liste des billets</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>