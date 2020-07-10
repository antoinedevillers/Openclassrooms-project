<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

    <div>    
        <div class="news">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em> mis à jour le <?= $post['creation_date_fr'] ?></em>
            </h3>
            
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </div>
        <div class='containerCommentsAndFormAddComment'>
            <div class='comments'>
                <h2>Commentaires</h2>
                
                <?php
                while ($comment = $comments->fetch())
                {
                ?>
                    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> (<a href='index.php?action=formReport&amp;id=<?= $comment['id'] ?>' title ='signaler le commentaire'> /!\ </a>) </p>
                    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>


                    
                <?php
                }
                $comments->closeCursor();
                ?>
            </div>
            <div class='formAddComments'>
                <h2> Ajouter un commentaire </h2>
                <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                    <div>
                        <label for="author">Auteur</label><br />
                        <input type="text" id="author" name="author" />
                    </div>
                    <div>
                        <label for="comment">Commentaire</label><br />
                        <textarea id="comment" name="comment"></textarea>
                    </div>
                    <div>
                        <input type="submit" />
                    </div>
                </form>
            </div>
        </div>    
    </div>
        <p><a href="index.php">Retour à la liste des billets</a></p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>