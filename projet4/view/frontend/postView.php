<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

    <section id='postView'>    
        <div class="post">
            <h2>
                <?= $post['title'] ?>
                <em> (mis à jour le <?= $post['creation_date_fr'] ?>)</em>
            </h2>
            
            <p>
                <?= $post['content']?>
            </p>
        </div>
        <div class='containerCommentsAndFormAddComment'>
            <div class='comments'>
                <h2>Commentaires</h2>
                
                <?php
                while ($comment = $comments->fetch())
                {
                ?><div class='containerReportedComment'>
                    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> (<a href='index.php?action=formReport&amp;id=<?= $comment['id'] ?>' title ='signaler le commentaire'> /!\ </a>) </p>
                    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                </div>

                    
                <?php
                }
                $comments->closeCursor();
                ?>
            </div>
            <div class='formAddComments'>
                <h2> Ajouter un commentaire </h2>
                <?php if (isset($errorMessage)){ echo $errorMessage; }?>
                <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                    <div>
                        <label for="author">Auteur</label><br />
                        <input type="text" id="author" class='inputAddComments' name="author" size="35"/>
                    </div>
                    <div>
                        <label for="comment">Commentaire</label><br />
                        <textarea id="comment" class='inputAddComments' name="comment" rows="10" cols="30"></textarea>
                    </div>
                    <div>
                        <input type="submit" />
                    </div>
                </form>
            </div>
        </div>    
    </section>
        <p class='returnListPosts'><a href="index.php">Retour à la liste des billets</a></p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>