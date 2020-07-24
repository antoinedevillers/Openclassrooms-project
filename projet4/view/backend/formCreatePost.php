<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<section id='formCreatePost'>
    
    <h2> Ajouter un nouveau billet </h2>
    <div class='messageError'>
        <?php if (isset($_SESSION['error'])){ echo 'Tous les champs ne sont pas remplis';}
                unset($_SESSION['error']);
                ?>
    </div>   
    <form action="index.php?action=addPost" method="post">
        <div class="inputFormPost">
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="title" size="80" />
        </div>
        <div class="inputFormPost">
            <label for="content">Contenu</label><br />
            <textarea id="mytextarea" name="content" rows="20" cols="80"></textarea>
        </div>
        <div class="inputFormPost">
            <input type="submit" value="Ajouter"/>
        </div>
    </form>
</section>
<p class='returnListPosts'><a href="index.php" >Retour à la liste des billets</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>