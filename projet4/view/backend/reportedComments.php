<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

       <h2>Commentaires signalés</h2>
        
        <?php
        while ($data = $reportedComments->fetch())
        {
        ?>
            <p><strong><?= htmlspecialchars($data['author']) ?></strong> le <?= $data['comment_date_fr'] ?>
                <a href='index.php?action=allowComment&amp;id=<?= $data['id'] ?>'>Autoriser </a> /
                <a href='index.php?action=deleteComment&amp;id=<?= $data['id'] ?>'>Supprimer</a>
             </p>
            <p><?= nl2br(htmlspecialchars($data['comment'])) ?></p>
            
        <?php
        }
        $reportedComments->closeCursor();
        ?>
        <p><a href="index.php">Retour à la liste des billets</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>