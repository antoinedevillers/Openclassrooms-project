<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

       <h2>Commentaires signalés</h2>
        
        <?php
        while ($data = $reportedComments->fetch())
        {
        ?>
            <p><strong><?= htmlspecialchars($data['author']) ?></strong> le <?= $data['comment_date_fr'] ?> </p>
            <p><?= nl2br(htmlspecialchars($data['comment'])) ?></p>
            
        <?php
        }
        $reportedComments->closeCursor();
        ?>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>