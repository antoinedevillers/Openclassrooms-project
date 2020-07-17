<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<section>
    
   <h2>Commentaires signalés</h2>
    
    <?php
    while ($data = $reportedComments->fetch())
    {
    ?>
    <div class='containerReportedComment'>
        <p><strong><?= htmlspecialchars($data['author']) ?></strong> le <?= $data['comment_date_fr'] ?>
            <a href='index.php?action=allowComment&amp;id=<?= $data['id'] ?>' onclick="return confirm('Etes vous sûre de vouloir autoriser ce commentaire ?');">Autoriser </a> /
            <a href='index.php?action=deleteComment&amp;id=<?= $data['id'] ?>' onclick="return confirm('Etes vous sûre de vouloir supprimer ce commentaire ?');">Supprimer</a>
        </p>
        <p><?= nl2br(htmlspecialchars($data['comment'])) ?></p>
    </div>
    <?php
    }
    $reportedComments->closeCursor();
    ?>

</section>
<p class='returnListPosts'><a href="index.php">Retour à la liste des billets</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>