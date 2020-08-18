<?php $title = 'Article Développement Web'; ?>

<?php ob_start(); ?>

<section>    
    <div class="article">
        <h2>
            <?= $article->title() ?>      
        </h2>
        <i> (mis à jour le <?= $article->creation_date_fr() ?>)</i>
        <p>
            <?= $article->content()?>
        </p>
    </div>
    <div class='containerCommentsAndFormAddComment'>
        <div class='comments'>
            <h2>Commentaires</h2>
            
            <?php
            if (isset ($_SESSION['message_confirmation_reported_comment'])){ echo 'Le commentaire a bien été signalé!';}
                unset($_SESSION['message_confirmation_reported_comment']);

            foreach ($comments as $comment)
            {
            
            ?>
            <div class='containerReportedComment'>

                <p><strong><?= htmlspecialchars($comment->author()) ?></strong> le <?= $comment->comment_date_fr() ?> (<a href='index.php?action=formReport&amp;id=<?= $comment->id() ?>' title ='signaler le commentaire'> /!\ </a>) </p>
                <p class='comment'><?= nl2br(htmlspecialchars($comment->com())) ?></p>
            </div>                    
            <?php
            }

            $pageComment = (!empty($_GET['pageComment']) ? $_GET['pageComment'] : 1);
            if ($pageComment > 1):
                ?><a href="?action=post&amp;id=<?= $post->id()?>&amp;pageComment=<?php echo $pageComment - 1; ?>#comment">Page précédente</a> — <?php
            endif;

            /* On va effectuer une boucle autant de fois que l'on a de pages */
            for ($i = 1; $i <= $countComments; $i++):
                ?><a href="?action=post&amp;id=<?= $post->id()?>&amp;pageComment=<?php echo $i; ?>#comment"><?php echo $i; ?></a> <?php
            endfor;

            /* Avec le nombre total de pages, on peut aussi masquer le lien
             * vers la page suivante quand on est sur la dernière */
            if ($pageComment < $countComments):
                ?>— <a href="?action=post&amp;id=<?= $post->id()?>&amp;pageComment=<?php echo $pageComment + 1; ?>#comment">Page suivante</a><?php
            endif;  
        
            ?>
        </div>
        <div class='formAddComments'>
            <h2> Ajouter un commentaire </h2>
            <div class='messageError' id='comment'>
                <?php if (isset($_SESSION['error'])){ echo 'Tous les champs ne sont pas remplis';}
                        unset($_SESSION['error']);
                        ?>
            </div>
            <form action="index.php?action=addComment&amp;id=<?= $post->id() ?>#comment" method="post">
                <div>
                    <label for="author">Auteur</label><br />
                    <input type="text" id="author" class='inputAddComments' name="author" size="35"/>
                </div>
                <div>
                    <label for="comment">Commentaire</label><br />
                    <textarea id="comment" class='inputAddComments' name="com" rows="10" cols="30"></textarea>
                </div>
                <div>
                    <input type="submit" />
                </div>
            </form>
        </div>
    </div>    
</section>
<p class='returnListPosts'><a href="index.php#derniersbillets">Retour à la liste des articles</a></p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>